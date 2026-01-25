<?php
// app/models/ServiceItem_model.php

class ServiceItem_model {
    private $table = 'service_items';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY category, order_priority ASC');
        return $this->db->resultSet();
    }

    public function getByCategory($category) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE category = :category ORDER BY order_priority ASC');
        $this->db->bind(':category', $category);
        return $this->db->resultSet();
    }

    public function getById($id) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function add($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (category, title_id, title_en, description_id, description_en, icon, link_url, partner_name, order_priority) 
                  VALUES 
                  (:category, :title_id, :title_en, :description_id, :description_en, :icon, :link_url, :partner_name, :order_priority)";
        
        $this->db->query($query);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':link_url', $data['link_url']);
        $this->db->bind(':partner_name', $data['partner_name']);
        $this->db->bind(':order_priority', $data['order_priority']);

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  category = :category, 
                  title_id = :title_id, 
                  title_en = :title_en, 
                  description_id = :description_id, 
                  description_en = :description_en, 
                  icon = :icon, 
                  link_url = :link_url, 
                  partner_name = :partner_name, 
                  order_priority = :order_priority 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':description_id', $data['description_id']);
        $this->db->bind(':description_en', $data['description_en']);
        $this->db->bind(':icon', $data['icon']);
        $this->db->bind(':link_url', $data['link_url']);
        $this->db->bind(':partner_name', $data['partner_name']);
        $this->db->bind(':order_priority', $data['order_priority']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
