<?php
require 'app/config.php';
require 'app/core/Database.php';
$db = new Database();
$db->query('SELECT title_id, title_en FROM gi_services');
$results = $db->resultSet();
echo json_encode($results, JSON_PRETTY_PRINT);
