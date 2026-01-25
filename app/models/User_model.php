<?php

class User_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getUserByUsername($username) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE username = :username");
        $this->db->bind('username', $username);
        return $this->db->single();
    }

    public function getUserByEmail($email) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE email = :email");
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function getUserById($id) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function getAllUsers() {
        $this->db->query("SELECT * FROM " . $this->table . " ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    public function createUser($data) {
        $query = "INSERT INTO " . $this->table . " (name, username, password, role) VALUES (:name, :username, :password, :role)";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('role', $data['role']);
        return $this->db->execute();
    }

    public function updateProfile($id, $data) {
        $query = "UPDATE users SET 
                    name = :name,
                    username = :username";
        
        if (!empty($data['password'])) {
            $query .= ", password = :password";
        }

        if (array_key_exists('photo', $data)) {
            $query .= ", photo = :photo";
        }
        
        $query .= " WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        if (!empty($data['password'])) {
            $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }
        if (array_key_exists('photo', $data)) {
            $this->db->bind('photo', $data['photo']);
        }
        $this->db->bind('id', $id);
        
        return $this->db->execute();
    }

    public function updateUser($id, $data) {
        $query = "UPDATE users SET 
                    name = :name,
                    username = :username,
                    role = :role";
        
        if (!empty($data['password'])) {
            $query .= ", password = :password";
        }
        
        $query .= " WHERE id = :id";
        
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['role']);
        if (!empty($data['password'])) {
            $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        }
        $this->db->bind('id', $id);
        
        return $this->db->execute();
    }

    public function deleteUser($id) {
        $this->db->query("DELETE FROM " . $this->table . " WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function setResetToken($id, $token, $expiry) {
        $this->db->query("UPDATE " . $this->table . " SET reset_token = :token, reset_expiry = :expiry WHERE id = :id");
        $this->db->bind('token', $token);
        $this->db->bind('expiry', $expiry);
        $this->db->bind('id', $id);
        return $this->db->execute();
    }

    public function getUserByResetToken($token) {
        $this->db->query("SELECT * FROM " . $this->table . " WHERE reset_token = :token AND reset_expiry > NOW()");
        $this->db->bind('token', $token);
        return $this->db->single();
    }

    public function resetPassword($id, $new_password) {
        $this->db->query("UPDATE " . $this->table . " SET password = :password, reset_token = NULL, reset_expiry = NULL WHERE id = :id");
        $this->db->bind('password', password_hash($new_password, PASSWORD_DEFAULT));
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
