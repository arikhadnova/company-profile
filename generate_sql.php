<?php
require_once 'app/init.php';
require_once 'app/core/Translator.php';

$db = new Database();

$configs = [
    'portfolios' => ['title_id' => 'title_en', 'subtitle_id' => 'subtitle_en', 'description_id' => 'description_en'],
    'articles' => ['title_id' => 'title_en', 'content_id' => 'content_en'],
    'publications' => ['title_id' => 'title_en', 'description_id' => 'description_en'],
    'services' => ['name_id' => 'name_en', 'description_id' => 'description_en'],
    'service_items' => ['title_id' => 'title_en', 'description_id' => 'description_en'],
    'testimonials' => ['content_id' => 'content_en', 'role_id' => 'role_en'],
    'faqs' => ['question_id' => 'question_en', 'answer_id' => 'answer_en'],
    'gi_services' => ['small_subtitle_id' => 'small_subtitle_en', 'title_id' => 'title_en', 'description_id' => 'description_en', 'outputs_id' => 'outputs_en', 'detail_content_id' => 'detail_content_en'],
    'impact_data' => ['label_id' => 'label_en'],
    'collaboration_documents' => ['title_id' => 'title_en'],
    'heroes' => ['tag_id' => 'tag_en', 'title_id' => 'title_en', 'subtitle_id' => 'subtitle_en']
];

$output = "-- Database Translation SQL\n";
$output .= "-- Generated at: " . date('Y-m-d H:i:s') . "\n\n";

foreach ($configs as $table => $columns) {
    $output .= "-- Table: $table\n";
    $query_str = "SELECT id";
    foreach ($columns as $id_col => $en_col) {
        $query_str .= ", $id_col, $en_col";
    }
    $query_str .= " FROM $table";
    
    try {
        $db->query($query_str);
        $records = $db->resultSet();
    } catch (Exception $e) {
        $output .= "-- Error querying $table: " . $e->getMessage() . "\n\n";
        continue;
    }
    
    if (empty($records)) {
        $output .= "-- No records found in $table\n\n";
        continue;
    }
    
    $found_updates = false;
    foreach ($records as $row) {
        $updates = [];
        foreach ($columns as $id_col => $en_col) {
            $id_val = trim($row->$id_col ?? '');
            $en_val = trim($row->$en_col ?? '');
            
            if ($id_val !== '' && (empty($en_val) || $en_val === $id_val)) {
                $translated = Translator::translate($id_val);
                $safe_translated = str_replace("'", "''", $translated);
                $updates[] = "$en_col = '$safe_translated'";
            }
        }
        
        if (!empty($updates)) {
            $output .= "UPDATE $table SET " . implode(', ', $updates) . " WHERE id = {$row->id};\n";
            $found_updates = true;
        }
    }
    
    if (!$found_updates) {
        $output .= "-- No updates needed for $table\n";
    }
    $output .= "\n";
}
$output .= "-- End of SQL\n";

file_put_contents('translation_updates.sql', $output);
echo "SQL generated to translation_updates.sql\n";
