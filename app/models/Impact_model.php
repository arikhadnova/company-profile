<?php
// app/models/Impact_model.php

class Impact_model {
    private $table = 'impact_data';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getByPage($page) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE page = :page');
        $this->db->bind(':page', $page);
        return $this->db->resultSet();
    }

    public function getAllByPage($page) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE page = :page ORDER BY id ASC');
        $this->db->bind(':page', $page);
        return $this->db->resultSet();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " (label_id, label_en, value, unit, icon, page) 
                  VALUES (:label_id, :label_en, :value, :unit, :icon, :page)";
        
        $this->db->query($query);
        $this->db->bind(':label_id', $data['label_id']);
        $this->db->bind(':label_en', $data['label_en']);
        $this->db->bind(':value', $data['value']);
        $this->db->bind(':unit', $data['unit']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':page', $data['page']);

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  label_id = :label_id, 
                  label_en = :label_en, 
                  value = :value, 
                  unit = :unit, 
                  icon = :icon,
                  page = :page
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':label_id', $data['label_id']);
        $this->db->bind(':label_en', $data['label_en']);
        $this->db->bind(':value', $data['value']);
        $this->db->bind(':unit', $data['unit']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':page', $data['page']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
