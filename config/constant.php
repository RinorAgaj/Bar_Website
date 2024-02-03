<?php
    session_start();

    define('SITEURL', 'http://localhost:8008/Bar_Website/');
    define('LOCALHOST', '127.0.0.1');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'default');
    define('DB_NAME', 'bar_web');

    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>