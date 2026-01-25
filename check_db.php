<?php
require_once 'app/core/Database.php';
require_once 'app/config/config.php';

$db = new Database();
$db->query("DESCRIBE articles");
$result = $db->resultSet();

echo "<pre>";
print_r($result);
echo "</pre>";
unlink(__FILE__);
