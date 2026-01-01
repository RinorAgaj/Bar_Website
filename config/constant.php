<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    define('SITEURL', 'http://localhost:8008/Bar_Website/');
    define('LOCALHOST', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'bar_web');

    // Database connection with error handling
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
    if (!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

    // Set charset to prevent encoding issues
    mysqli_set_charset($conn, 'utf8mb4');

    // Include security helper functions
    require_once __DIR__ . '/security.php';

    // Apply secure session settings
    secureSession();
?>