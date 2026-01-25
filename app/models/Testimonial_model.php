<?php
// app/models/Testimonial_model.php

class Testimonial_model {
    private $table = 'testimonials';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getActive() {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = "active" ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getByPage($page, $onlyActive = true) {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE page = :page';
        if ($onlyActive) {
            $sql .= ' AND status = "active"';
        }
        $sql .= ' ORDER BY created_at DESC';
        
        $this->db->query($sql);
        $this->db->bind(':page', $page);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (name, role_id, role_en, content_id, content_en, image, status, page) 
                  VALUES 
                  (:name, :role_id, :role_en, :content_id, :content_en, :image, :status, :page)";
        
        $this->db->query($query);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':role_en', $data['role_en']);
        $this->db->bind(':content_id', $data['content_id']);
        $this->db->bind(':content_en', $data['content_en']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':page', $data['page'] ?? 'gi');

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  name = :name, 
                  role_id = :role_id, 
                  role_en = :role_en, 
                  content_id = :content_id, 
                  content_en = :content_en, 
                  image = :image, 
                  status = :status,
                  page = :page 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':role_id', $data['role_id']);
        $this->db->bind(':role_en', $data['role_en']);
        $this->db->bind(':content_id', $data['content_id']);
        $this->db->bind(':content_en', $data['content_en']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':page', $data['page'] ?? 'gi');

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
