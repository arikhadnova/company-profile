<?php
// app/models/Publication_model.php

class Publication_model {
    private $table = 'publications';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getByType($type) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE type = :type ORDER BY created_at DESC');
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (title_id, title_en, type, file_path, preview_path, external_link, thumbnail, description_id, description_en, is_paid, price) 
                  VALUES 
                  (:title_id, :title_en, :type, :file_path, :preview_path, :external_link, :thumbnail, :description_id, :description_en, :is_paid, :price)";
        
        $this->db->query($query);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':preview_path', $data['preview_path']);
        $this->db->bind(':external_link', $data['external_link']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);
        $this->db->bind(':is_paid', $data['is_paid']);
        $this->db->bind(':price', $data['price']);

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  title_id = :title_id, 
                  title_en = :title_en, 
                  type = :type, 
                  file_path = :file_path, 
                  preview_path = :preview_path, 
                  external_link = :external_link, 
                  thumbnail = :thumbnail, 
                  description_id = :description_id, 
                  description_en = :description_en,
                  is_paid = :is_paid,
                  price = :price
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':preview_path', $data['preview_path']);
        $this->db->bind(':external_link', $data['external_link']);
        $this->db->bind(':thumbnail', $data['thumbnail']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);
        $this->db->bind(':is_paid', $data['is_paid']);
        $this->db->bind(':price', $data['price']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
