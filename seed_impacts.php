<?php
require_once 'app/config.php';
require_once 'app/core/Database.php';

$db = new Database();

// Clear existing impact_data for these pages to avoid duplicates during seeding
// $db->query("DELETE FROM impact_data WHERE page IN ('home', 'gi', 'partner', 'ggc')");
// $db->execute();

$jsonPath = 'impacts_seed.json';
if (!file_exists($jsonPath)) {
    die("Seed file not found");
}

$data = json_decode(file_get_contents($jsonPath), true);

foreach ($data as $row) {
    $db->query("INSERT INTO impact_data 
                (page, section, section_title_id, section_title_en, label_id, label_en, value, unit, note_id, note_en, icon, order_num) 
                VALUES 
                (:page, :section, :section_title_id, :section_title_en, :label_id, :label_en, :value, :unit, :note_id, :note_en, :icon, :order_num)");
    
    $db->bind(':page', $row['page']);
    $db->bind(':section', $row['section']);
    $db->bind(':section_title_id', $row['section_title_id']);
    $db->bind(':section_title_en', $row['section_title_en']);
    $db->bind(':label_id', $row['label_id']);
    $db->bind(':label_en', $row['label_en']);
    $db->bind(':value', $row['value']);
    $db->bind(':unit', $row['unit']);
    $db->bind(':note_id', $row['note_id']);
    $db->bind(':note_en', $row['note_en']);
    $db->bind(':icon', $row['icon']);
    $db->bind(':order_num', $row['order_num']);
    
    if ($db->execute()) {
        echo "Seeded: " . $row['label_id'] . " for " . $row['page'] . "\n";
    } else {
        echo "Failed: " . $row['label_id'] . " for " . $row['page'] . "\n";
    }
}
