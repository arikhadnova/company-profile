<?php
// app/models/Collaboration_model.php

class Collaboration_model {
    private $table_docs = 'collaboration_documents';
    private $table_requests = 'collaboration_requests';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    // --- Document Methods ---

    public function getAllDocuments() {
        $this->db->query('SELECT * FROM ' . $this->table_docs . ' ORDER BY created_at DESC');
        return $this->db->resultSet();
    }

    public function getActiveDocumentsByType($type) {
        $this->db->query('SELECT * FROM ' . $this->table_docs . ' WHERE type = :type AND status = "active" ORDER BY created_at DESC');
        $this->db->bind(':type', $type);
        return $this->db->resultSet();
    }

    public function getDocumentById($id) {
        $this->db->query('SELECT * FROM ' . $this->table_docs . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    public function addDocument($data) {
        $query = "INSERT INTO " . $this->table_docs . " 
                  (title_id, title_en, type, file_path, status) 
                  VALUES 
                  (:title_id, :title_en, :type, :file_path, :status)";
        
        $this->db->query($query);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    public function updateDocument($data) {
        $query = "UPDATE " . $this->table_docs . " SET 
                  title_id = :title_id, 
                  title_en = :title_en, 
                  type = :type, 
                  file_path = :file_path, 
                  status = :status 
                  WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title_id', $data['title_id']);
        $this->db->bind(':title_en', $data['title_en']);
        $this->db->bind(':type', $data['type']);
        $this->db->bind(':file_path', $data['file_path']);
        $this->db->bind(':status', $data['status']);

        return $this->db->execute();
    }

    public function deleteDocument($id) {
        $this->db->query('DELETE FROM ' . $this->table_docs . ' WHERE id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    // --- Request Logging Methods ---

    public function logRequest($data) {
        $query = "INSERT INTO " . $this->table_requests . " 
                  (doc_id, name, email, organization, jabatan) 
                  VALUES 
                  (:doc_id, :name, :email, :organization, :jabatan)";
        
        $this->db->query($query);
        $this->db->bind(':doc_id', $data['doc_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':organization', $data['organization']);
        $this->db->bind(':jabatan', $data['jabatan']);

        return $this->db->execute();
    }

    public function getAllRequests() {
        $this->db->query('SELECT r.*, d.title_id as doc_title 
                          FROM ' . $this->table_requests . ' r 
                          LEFT JOIN ' . $this->table_docs . ' d ON r.doc_id = d.id 
                          ORDER BY r.requested_at DESC');
        return $this->db->resultSet();
    }
}
