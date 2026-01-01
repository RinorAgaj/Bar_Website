<?php
include "config/constant.php";

if (isset($_POST['uname']) && isset($_POST['password']) && isset($_POST['name']) && isset($_POST['re_password'])) {

    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        header("Location: signup.php?error=" . urlencode("Invalid request. Please try again."));
        exit();
    }

    $uname = sanitizeInput($_POST['uname']);
    $pass = $_POST['password']; // Don't modify password before hashing
    $re_pass = $_POST['re_password'];
    $name = sanitizeInput($_POST['name']);

    $user_data = 'uname=' . urlencode($uname) . '&name=' . urlencode($name);

    if (empty($uname) || empty($pass) || empty($re_pass) || empty($name)) {
        header("Location: signup.php?error=" . urlencode("All fields are required") . "&$user_data");
        exit();
    } elseif ($pass !== $re_pass) {
        header("Location: signup.php?error=" . urlencode("The confirmation password does not match") . "&$user_data");
        exit();
    } elseif (strlen($pass) < 8) {
        header("Location: signup.php?error=" . urlencode("Password must be at least 8 characters") . "&$user_data");
        exit();
    } else {
        // Check if username exists using prepared statement
        $stmt = mysqli_prepare($conn, "SELECT id FROM tbl_users WHERE user_name = ?");
        mysqli_stmt_bind_param($stmt, "s", $uname);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            mysqli_stmt_close($stmt);
            header("Location: signup.php?error=" . urlencode("The username is taken, try another") . "&$user_data");
            exit();
        }
        mysqli_stmt_close($stmt);

        // Hash password securely using bcrypt
        $hashed_password = hashPassword($pass);

        // Insert new user using prepared statement
        $stmt2 = mysqli_prepare($conn, "INSERT INTO tbl_users (user_name, password, name) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt2, "sss", $uname, $hashed_password, $name);
        $result2 = mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        if ($result2) {
            header("Location: index.php?success=" . urlencode("Your account has been created successfully. Please login."));
            exit();
        } else {
            header("Location: signup.php?error=" . urlencode("Unknown error occurred") . "&$user_data");
            exit();
        }
    }
} else {
    header("Location: signup.php");
    exit();
}
?>
