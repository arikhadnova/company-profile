<?php
// app/models/Contact_model.php

class Contact_model {
    private $table = 'contacts';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, email, message) 
                  VALUES 
                  (:name, :email, :message)";
        
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':message', $data['message']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function markAsRead($id) {
        $this->db->query('UPDATE ' . $this->table . ' SET is_read = 1 WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function getUnreadCount() {
        $this->db->query('SELECT COUNT(*) as total FROM ' . $this->table . ' WHERE is_read = 0');
        $result = $this->db->single();
        return $result->total;
    }
}
