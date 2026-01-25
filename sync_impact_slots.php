<?php
require_once 'app/core/Database.php';
require_once 'app/config.php';

$db = new Database();
$pages = ['home', 'gi', 'ggc', 'partnership', 'implementasi', 'konsultan'];

foreach ($pages as $page) {
    // Check how many records exist for this page
    $db->query("SELECT COUNT(*) as total FROM impact_data WHERE page = :page");
    $db->bind(':page', $page);
    $result = $db->single();
    $count = $result->total;

    if ($count < 4) {
        $needed = 4 - $count;
        echo "Page $page: Adding $needed placeholder(s)...\n";
        for ($i = 0; $i < $needed; $i++) {
            $db->query("INSERT INTO impact_data (label_id, label_en, value, unit, icon, page) 
                        VALUES (:label, :label, '0', '', 'fas fa-info-circle', :page)");
            $db->bind(':label', 'Slot Kosong');
            $db->bind(':page', $page);
            $db->execute();
        }
    } else if ($count > 4) {
        $extra = $count - 4;
        echo "Page $page: Removing $extra extra record(s)...\n";
        // Get extra IDs
        $db->query("SELECT id FROM impact_data WHERE page = :page ORDER BY id DESC LIMIT $extra");
        $db->bind(':page', $page);
        $extras = $db->resultSet();
        foreach ($extras as $ex) {
            $db->query("DELETE FROM impact_data WHERE id = :id");
            $db->bind(':id', $ex->id);
            $db->execute();
        }
    } else {
        echo "Page $page: Already has 4 slots.\n";
    }
}

echo "Synchronization complete.";
?>
