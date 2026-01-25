<?php
require 'C:/laragon/www/gosirk_website/app/init.php';
$db = new Database();
$db->query("SELECT * FROM collaboration_documents");
$res = $db->resultSet();
echo "TOTAL_DOCS=" . count($res) . "\n";
foreach($res as $row) {
    echo "ID: " . $row->id . " | TYPE: " . $row->type . " | STATUS: " . $row->status . " | TITLE: " . $row->title_id . "\n";
}
?>
