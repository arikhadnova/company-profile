<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
try {
    $db->query("ALTER TABLE portfolios ADD COLUMN project_logos TEXT DEFAULT NULL AFTER highlights");
    if ($db->execute()) {
        echo "Column project_logos added successfully.";
    } else {
        echo "Failed to execute column addition.";
    }
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column project_logos already exists.";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
unlink(__FILE__); // Self-delete
