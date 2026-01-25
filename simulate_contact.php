<?php
require_once 'app/core/Database.php';
require_once 'app/config.php';
require_once 'app/core/Controller.php';
require_once 'app/models/Contact_model.php';

$data = [
    'name' => 'Test Robot',
    'email' => 'robot@test.com',
    'message' => 'This is a test message from simulation script.'
];

try {
    echo "Attempting to save test contact...\n";
    $model = new Contact_model();
    if ($model->add($data)) {
        echo "SUCCESS: Test contact saved.\n";
    } else {
        echo "FAILURE: Model returned false.\n";
    }

    // Verify
    $db = new Database();
    $db->query("SELECT * FROM contacts WHERE name = 'Test Robot'");
    $result = $db->single();
    if ($result) {
        echo "Verification: Found contact in DB! ID: " . $result->id . "\n";
    } else {
        echo "Verification: Contact NOT found in DB after 'success'.\n";
    }

} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
