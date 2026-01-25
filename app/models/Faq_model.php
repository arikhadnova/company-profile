<?php
// app/models/Faq_model.php

class Faq_model {
    private $table = 'faqs';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAll() {
        $this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY sort_order ASC, created_at DESC');
        return $this->db->resultSet();
    }

    public function getActive() {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE status = "active" ORDER BY sort_order ASC, created_at DESC');
        return $this->db->resultSet();
    }

    public function getByPage($page, $onlyActive = true) {
        $sql = 'SELECT * FROM ' . $this->table . ' WHERE page = :page';
        if ($onlyActive) {
            $sql .= ' AND status = "active"';
        }
        $sql .= ' ORDER BY sort_order ASC, created_at DESC';
        
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
                  (question_id, question_en, answer_id, answer_en, page, status, sort_order) 
                  VALUES 
                  (:question_id, :question_en, :answer_id, :answer_en, :page, :status, :sort_order)";
        
        $this->db->query($query);
        $this->db->bind(':question_id', $data['question_id']);
        $this->db->bind(':question_en', $data['question_en']);
        $this->db->bind(':answer_id', $data['answer_id']);
        $this->db->bind(':answer_en', $data['answer_en']);
        $this->db->bind(':page', $data['page']);
        $this->db->bind(':status', $data['status'] ?? 'active');
        $this->db->bind(':sort_order', $data['sort_order'] ?? 0);

        return $this->db->execute();
    }

    public function update($data) {
        $query = "UPDATE " . $this->table . " SET 
                  question_id = :question_id, 
                  question_en = :question_en, 
                  answer_id = :answer_id, 
                  answer_en = :answer_en, 
                  page = :page, 
                  status = :status,
                  sort_order = :sort_order 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':question_id', $data['question_id']);
        $this->db->bind(':question_en', $data['question_en']);
        $this->db->bind(':answer_id', $data['answer_id']);
        $this->db->bind(':answer_en', $data['answer_en']);
        $this->db->bind(':page', $data['page']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':sort_order', $data['sort_order']);

        return $this->db->execute();
    }

    public function delete($id) {
        $this->db->query('DELETE FROM ' . $this->table . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }
}
