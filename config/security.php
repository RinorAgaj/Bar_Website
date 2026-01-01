<?php
/**
 * Security Helper Functions
 * This file contains functions to prevent common security vulnerabilities
 */

// CSRF Token Management
function generateCSRFToken() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function validateCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $token)) {
        return false;
    }
    return true;
}

function csrfTokenField() {
    $token = generateCSRFToken();
    return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token) . '">';
}

// Input Sanitization
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// Output Escaping (XSS Prevention)
function escapeOutput($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Alias for escapeOutput
function e($data) {
    return escapeOutput($data);
}

// Secure Password Hashing
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Session Security
function secureSession() {
    // Set secure session parameters
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        ini_set('session.cookie_secure', 1);
    }
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_name']) && !empty($_SESSION['user_name']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
}

// Require login - redirect if not logged in
function requireLogin($redirectUrl = null) {
    if (!isLoggedIn()) {
        $redirect = $redirectUrl ?? SITEURL;
        header('Location: ' . $redirect);
        exit();
    }
}

// Require admin - redirect if not admin
function requireAdmin() {
    if (!isLoggedIn() || !isAdmin()) {
        header('Location: ' . SITEURL);
        exit();
    }
}

// Validate integer ID (for preventing SQL injection on ID parameters)
function validateId($id) {
    $id = filter_var($id, FILTER_VALIDATE_INT);
    if ($id === false || $id < 1) {
        return false;
    }
    return $id;
}

// File upload security
function validateImageUpload($file, $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp']) {
    if (!isset($file['tmp_name']) || empty($file['tmp_name'])) {
        return ['success' => false, 'error' => 'No file uploaded'];
    }

    // Check file size (max 5MB)
    if ($file['size'] > 5 * 1024 * 1024) {
        return ['success' => false, 'error' => 'File too large (max 5MB)'];
    }

    // Check MIME type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, $allowedTypes)) {
        return ['success' => false, 'error' => 'Invalid file type'];
    }

    return ['success' => true, 'mime_type' => $mimeType];
}

// Generate safe filename
function generateSafeFilename($prefix, $extension) {
    $extension = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $extension));
    return $prefix . '-' . bin2hex(random_bytes(8)) . '.' . $extension;
}
?>
