<?php
require_once 'app/config.php';
require_once 'app/core/Database.php';

$db = new Database();
$db->query("DESCRIBE impact_data");
$result = $db->resultSet();

echo json_encode($result, JSON_PRETTY_PRINT);
