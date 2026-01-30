<?php

class GiService_model {
    private $table = 'gi_services';
    private $db;

    public function __construct() {
        $this->db = new Database;
        $this->createTable();
    }

    private function createTable() {
        $query = "CREATE TABLE IF NOT EXISTS " . $this->table . " (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title_id VARCHAR(255) NOT NULL,
            title_en VARCHAR(255) NOT NULL,
            category VARCHAR(100) NOT NULL,
            description_id TEXT,
            description_en TEXT,
            image VARCHAR(255),
            program_points_en LONGTEXT,
            highlights LONGTEXT,
            location_id VARCHAR(255),
            location_en VARCHAR(255),
            service_type_id VARCHAR(255),
            service_type_en VARCHAR(255),
            slug VARCHAR(255) UNIQUE NOT NULL,
            detail_content_id LONGTEXT,
            detail_content_en LONGTEXT,
            order_priority INT DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
        $this->db->query($query);
        $this->db->execute();
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY order_priority ASC, id DESC');
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function getBySlug($slug) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE slug = :slug');
        $this->db->bind(':slug', $slug);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " (
                    title_id, title_en, category, description_id, description_en, 
                    image, 
                    program_points_id, program_points_en, highlights,
                    location_id, location_en, service_type_id, service_type_en,
                    slug, detail_content_id, detail_content_en, order_priority
                  ) VALUES (
                    :title_id, :title_en, :category, :description_id, :description_en, 
                    :image, 
                    :program_points_id, :program_points_en, :highlights,
                    :location_id, :location_en, :service_type_id, :service_type_en,
                    :slug, :detail_content_id, :detail_content_en, :order_priority
                  )";
        $this->db->query($query);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);
        $this->db->bind(':image', $data['image']);

        $this->db->bind(':program_points_id', $data['program_points_id']);
        $this->db->bind(':program_points_en', $data['program_points_en']);
        $this->db->bind(':highlights', $data['highlights']);
        $this->db->bind(':location_id', $data['location_id']);
        $this->db->bind(':location_en', $data['location_en']);
        $this->db->bind(':service_type_id', $data['service_type_id']);
        $this->db->bind(':service_type_en', $data['service_type_en']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':detail_content_id', $data['detail_content_id']);
        $this->db->bind(':detail_content_en', $data['detail_content_en']);
        $this->db->bind(':order_priority', $data['order_priority']);
        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                    title_id = :title_id, 
                    title_en = :title_en, 
                    category = :category, 
                    description_id = :description_id, 
                    description_en = :description_en, 
                    image = :image, 
                    program_points_id = :program_points_id,
                    program_points_en = :program_points_en,
                    highlights = :highlights,
                    location_id = :location_id,
                    location_en = :location_en,
                    service_type_id = :service_type_id,
                    service_type_en = :service_type_en,
                    slug = :slug, 
                    detail_content_id = :detail_content_id, 
                    detail_content_en = :detail_content_en, 
                    order_priority = :order_priority
                  WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);

        $this->db->bind(':image', $data['image']);
        $this->db->bind(':program_points_id', $data['program_points_id']);
        $this->db->bind(':program_points_en', $data['program_points_en']);
        $this->db->bind(':highlights', $data['highlights']);
        $this->db->bind(':location_id', $data['location_id']);
        $this->db->bind(':location_en', $data['location_en']);
        $this->db->bind(':service_type_id', $data['service_type_id']);
        $this->db->bind(':service_type_en', $data['service_type_en']);
        $this->db->bind(':slug', $data['slug']);
        $this->db->bind(':detail_content_id', $data['detail_content_id']);
        $this->db->bind(':detail_content_en', $data['detail_content_en']);
        $this->db->bind(':order_priority', $data['order_priority']);
        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
