<?php
// app/models/Visitor_model.php

class Visitor_model {
    private $table = 'visitors';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function logHit() {
        // Simple hit logging
        // To prevent over-counting, we could check session or last hit from this IP
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $ua = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';

        // Check if this IP has visited in the last hour to prevent spamming
        $this->db->query("SELECT id FROM " . $this->table . " WHERE ip_address = :ip AND created_at > DATE_SUB(NOW(), INTERVAL 1 HOUR)");
        $this->db->bind(':ip', $ip);
        if ($this->db->single()) {
            return false; // Already logged recently
        }

        $query = "INSERT INTO " . $this->table . " (ip_address, user_agent) VALUES (:ip, :ua)";
        $this->db->query($query);
        $this->db->bind(':ip', $ip);
        $this->db->bind(':ua', $ua);
        return $this->db->execute();
    }

    public function getTotalCount() {
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table);
        $result = $this->db->single();
        return $result ? $result->total : 0;
    }

    public function getMonthlyStats() {
        // Return stats for the current month vs previous month
        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE MONTH(created_at) = MONTH(CURRENT_DATE()) AND YEAR(created_at) = YEAR(CURRENT_DATE())");
        $current = $this->db->single()->total;

        $this->db->query("SELECT COUNT(*) as total FROM " . $this->table . " WHERE MONTH(created_at) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(created_at) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
        $previous = $this->db->single()->total;

        return [
            'current' => $current,
            'previous' => $previous,
            'increase' => ($previous > 0) ? (($current - $previous) / $previous) * 100 : 0
        ];
    }
}
