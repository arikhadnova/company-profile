<?php
require_once 'app/core/Database.php';
require_once 'app/config.php';

try {
    $db = new Database();
    $db->query("SELECT * FROM contacts");
    $result = $db->resultSet();
    
    echo "Total contacts: " . count($result) . "\n";
    if (count($result) > 0) {
        foreach ($result as $row) {
            echo "ID: {$row->id}, Name: {$row->name}, Email: {$row->email}, Date: {$row->created_at}\n";
        }
    } else {
        echo "No contacts found.\n";
    }

    // Also check table structure
    $db->query("DESCRIBE contacts");
    $struct = $db->resultSet();
    echo "\nTable structure:\n";
    foreach ($struct as $col) {
        echo "Field: {$col->Field}, Type: {$col->Type}, Null: {$col->Null}\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
