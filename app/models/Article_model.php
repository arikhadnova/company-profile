<?php
// app/models/Article_model.php

class Article_model {
    private $table = 'articles';
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

    public function getByCategory($category, $type = 'blog', $limit = null) {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE category = :category AND type = :type ORDER BY created_at DESC';
        if ($limit) {
            $query .= ' LIMIT ' . $limit;
        }
        $this->db->query($query);
        $this->db->bind(':category', $category);
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
                  (title_id, title_en, content_id, content_en, image, type, category, slug, author, status) 
                  VALUES 
                  (:title_id, :title_en, :content_id, :content_en, :image, :type, :category, :slug, :author, :status)";
        
        $this->db->query($query);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':content_id', $data['content_id']);
        $this->db->bind(':content_en', $data['content_en']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':type', $data['type'] ?? 'blog');
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':author', $data['author'] ?? 'Admin');
        $this->db->bind(':status', $data['status'] ?? 'draft');

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  title_id = :title_id, 
                  title_en = :title_en, 
                  content_id = :content_id, 
                  content_en = :content_en, 
                  image = :image, 
                  type = :type,
                  category = :category, 
                  slug = :slug, 
                  author = :author, 
                  status = :status 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':content_id', $data['content_id']);
        $this->db->bind(':content_en', $data['content_en']);
        $this->db->bind(':image', $data['image']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
