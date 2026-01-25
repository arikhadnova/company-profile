<?php

class Hero_model {
    private $table = 'heroes';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query("SELECT * FROM " . $this->table);
        return $this->db->resultSet();
    }

    public function getByPage($page) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE page_name = :page");
        $this->db->bind(':page', $page);
        return $this->db->single();
    }

    public function update($page, $data) {
        $query = "UPDATE " . $this->table . " SET 
                    tag_id = :tag_id, 
                    tag_en = :tag_en, 
                    title_id = :title_id, 
                    title_en = :title_en, 
                    subtitle_id = :subtitle_id, 
                    subtitle_en = :subtitle_en";
        
        if (isset($data['image'])) {
            $query .= ", image = :image";
        }

        $query .= " WHERE page_name = :page";

        $this->db->query($query);
        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':tag_en', $data['tag_en']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':subtitle_id', $data['subtitle_id']);
        $this->db->bind(':subtitle_en', $data['subtitle_en']);
        $this->db->bind(':page', $page);

        if (isset($data['image'])) {
            $this->db->bind(':image', $data['image']);
        }

        return $this->db->execute();
    }

    public function insert($data) {
        $this->db->query("INSERT INTO " . $this->table . " (page_name, tag_id, tag_en, title_id, title_en, subtitle_id, subtitle_en, image) 
                          VALUES (:page, :tag_id, :tag_en, :title_id, :title_en, :subtitle_id, :subtitle_en, :image)");
        $this->db->bind(':page', $data['page_name']);
        $this->db->bind(':tag_id', $data['tag_id']);
        $this->db->bind(':tag_en', $data['tag_en']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':subtitle_id', $data['subtitle_id']);
        $this->db->bind(':subtitle_en', $data['subtitle_en']);
        $this->db->bind(':image', $data['image']);
        return $this->db->execute();
    }
}
