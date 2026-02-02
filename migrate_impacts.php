<?php
require_once 'app/config.php';
require_once 'app/core/Database.php';

$db = new Database();

$queries = [
    "ALTER TABLE impact_data ADD COLUMN section VARCHAR(100) DEFAULT 'Main' AFTER page",
    "ALTER TABLE impact_data ADD COLUMN section_title_id VARCHAR(255) DEFAULT '' AFTER section",
    "ALTER TABLE impact_data ADD COLUMN section_title_en VARCHAR(255) DEFAULT '' AFTER section_title_id",
    "ALTER TABLE impact_data ADD COLUMN note_id TEXT AFTER unit",
    "ALTER TABLE impact_data ADD COLUMN note_en TEXT AFTER note_id",
    "ALTER TABLE impact_data ADD COLUMN order_num INT DEFAULT 0 AFTER note_en"
];

foreach ($queries as $query) {
    try {
        $db->query($query);
        $db->execute();
        echo "Executed: $query\n";
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
}
