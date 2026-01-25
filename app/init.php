<?php
if (!session_id()) session_start();

// Set Timezone
date_default_timezone_set('Asia/Jakarta');

// Enable error display for development (remove or disable in production)
error_reporting(E_ALL);
ini_set('display_errors', '1');

// Load config constants
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/core/Database.php';


// Load core framework
require_once __DIR__ . '/core/app.php';
require_once __DIR__ . '/core/Controller.php';
require_once __DIR__ . '/core/Flasher.php';
require_once __DIR__ . '/core/Validator.php';
require_once __DIR__ . '/core/Upload.php';
require_once __DIR__ . '/core/Mail.php';