<?php
require_once 'app/config.php';
require_once 'app/core/Database.php';

$db = new Database();
$db->query("SELECT * FROM settings WHERE setting_value LIKE '%gocircularindonesia.com%'");
$results = $db->resultSet();

if (empty($results)) {
    echo "No hardcoded live URLs found in settings table.";
} else {
    echo "Found hardcoded live URLs in settings:\n";
    foreach ($results as $row) {
        echo "Setting: " . $row->setting_key . " = " . $row->setting_value . "\n";
    }
}
