<?php
require_once 'app/init.php';
$db = new Database();
$db->query("SHOW TABLES");
$tables = $db->resultSet();
$output = "";
foreach($tables as $t) {
    $table = array_values((array)$t)[0];
    $output .= "Table: $table\n";
    $db->query("DESCRIBE $table");
    $cols = $db->resultSet();
    foreach($cols as $c) {
        $output .= " - " . $c->Field . "\n";
    }
    $output .= "\n";
}
file_put_contents('schema_output.txt', $output);
echo "Schema written to schema_output.txt\n";
