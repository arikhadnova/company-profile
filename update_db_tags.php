<?php
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
try {
    $db->query("ALTER TABLE articles ADD COLUMN IF NOT EXISTS tags VARCHAR(255) DEFAULT NULL AFTER category");
    $db->execute();
    echo "Success: Column 'tags' added to 'articles' table.\n";
} catch (Exception $e) {
    if (strpos($e->getMessage(), "Duplicate column name") !== false) {
        echo "Note: Column 'tags' already exists.\n";
    } else {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
