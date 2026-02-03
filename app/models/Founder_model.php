<?php
// app/models/Founder_model.php

class Founder_model {
    private $table = 'founders';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY display_order ASC, id ASC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " (name, role_id, role_en, quote_id, quote_en, image, linkedin_url, display_order) VALUES (:name, :role_id, :role_en, :quote_id, :quote_en, :image, :linkedin_url, :display_order)";
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':role_en', $data['role_en']);
        $this->db->bind(':quote_id', $data['quote_id']);
        $this->db->bind(':quote_en', $data['quote_en']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':linkedin_url', $data['linkedin_url']);
        $this->db->bind(':display_order', $data['display_order']);
        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  name = :name, 
                  role_id = :role_id, 
                  role_en = :role_en,
                  quote_id = :quote_id,
                  quote_en = :quote_en,
                  linkedin_url = :linkedin_url,
                  display_order = :display_order";
        
        if (!empty($data['image'])) {
            $query .= ", image = :image";
        }

        $query .= " WHERE id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':role_en', $data['role_en']);
        $this->db->bind(':quote_id', $data['quote_id']);
        $this->db->bind(':quote_en', $data['quote_en']);
        $this->db->bind(':linkedin_url', $data['linkedin_url']);
        $this->db->bind(':display_order', $data['display_order']);

        if (!empty($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }
        
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
