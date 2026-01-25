<?php

class Setting_model {
    private $table = 'settings';
    private $db;
    private static $cache = null;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        if (self::$cache !== null) {
            return self::$cache;
        }

        $this->db->query("SELECT * FROM " . $this->table);
        $settings = $this->db->resultSet();
        $data = [];
        foreach ($settings as $setting) {
            $data[$setting->setting_key] = $setting->setting_value;
        }
        self::$cache = $data;
        return $data;
    }

    public function getByKey($key) {
        $this->db->query("SELECT setting_value FROM " . $this->table . " WHERE setting_key = :key");
        $this->db->bind('key', $key);
        $result = $this->db->single();
        return $result ? $result->setting_value : null;
    }

    public function update($key, $value) {
        $this->db->query("INSERT INTO " . $this->table . " (setting_key, setting_value) 
                        VALUES (:key, :value) 
                        ON DUPLICATE KEY UPDATE setting_value = :value_update");
        $this->db->bind('key', $key);
        $this->db->bind('value', $value);
        $this->db->bind('value_update', $value);
        return $this->db->execute();
    }

    public function updateMultiple($data) {
        foreach ($data as $key => $value) {
            $this->update($key, $value);
        }
        return true;
    }
}
