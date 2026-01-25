<?php
// app/models/Partner_model.php

class Partner_model {
    private $table = 'partners';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        try {
            $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY category ASC, id DESC');
            return $this->db->resultSet();
        } catch (Exception $e) {
            // Fallback if category column doesn't exist yet
            $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
            return $this->db->resultSet();
        }
    }

    public function getByCategory($category) {
        try {
            $this->db->query('SELECT * FROM ' . $this->table . ' WHERE category = :category');
            $this->db->bind(':category', $category);
            return $this->db->resultSet();
        } catch (Exception $e) {
            return [];
        }
    }

    public function add($data) {
        $category = !empty($data['category']) ? $data['category'] : 'network';
        $query = "INSERT INTO " . $this->table . " (name, logo, type, category) VALUES (:name, :logo, :type, :category)";
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':category', $category);
        return $this->db->execute();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  name = :name, 
                  logo = :logo, 
                  type = :type,
                  category = :category
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':logo', $data['logo']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':category', $data['category']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
