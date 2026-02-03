<?php
require 'app/config.php';
require 'app/core/Database.php';
$db = new Database();
$db->query('SELECT * FROM gi_videos');
$results = $db->resultSet();
echo json_encode($results, JSON_PRETTY_PRINT);
