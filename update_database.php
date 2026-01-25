<?php
// Script sederhana untuk menambahkan kolom tags via browser
require_once 'app/config/config.php';
require_once 'app/core/Database.php';

$db = new Database();
try {
    // Cek apakah kolom sudah ada
    $db->query("SHOW COLUMNS FROM articles LIKE 'tags'");
    $exists = $db->single();
    
    if (!$exists) {
        $db->query("ALTER TABLE articles ADD COLUMN tags VARCHAR(255) DEFAULT NULL AFTER category");
        $db->execute();
        echo "<h1>Berhasil!</h1><p>Kolom 'tags' telah ditambahkan ke tabel 'articles'.</p>";
    } else {
        echo "<h1>Informasi</h1><p>Kolom 'tags' sudah ada di database.</p>";
    }
} catch (Exception $e) {
    echo "<h1>Error</h1><p>" . $e->getMessage() . "</p>";
}
echo '<br><a href="admin/articles">Kembali ke Admin</a>';
