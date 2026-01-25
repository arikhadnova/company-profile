<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'gosirk_db';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $sql = "ALTER TABLE impact_data ADD COLUMN page VARCHAR(50) DEFAULT 'home'";
    $pdo->exec($sql);
    echo "Migration successful: Column 'page' added to 'impact_data'.\n";
} catch (PDOException $e) {
    if ($e->getCode() == '42S21') {
        echo "Migration skipped: Column 'page' already exists.\n";
    } else {
        echo "Migration failed: " . $e->getMessage() . "\n";
    }
}
?>
