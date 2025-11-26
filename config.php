<?php
// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'kickzone');

// Connect to MySQL first (without database)
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create database if it doesn't exist
$create_db = "CREATE DATABASE IF NOT EXISTS " . DB_NAME;
mysqli_query($conn, $create_db);

// Select the database
mysqli_select_db($conn, DB_NAME);

// Check if tables exist, if not create them
$check_tables = "SHOW TABLES FROM " . DB_NAME;
$result = mysqli_query($conn, $check_tables);

if (mysqli_num_rows($result) == 0) {
    // Tables don't exist, create them
    $sql = file_get_contents(__DIR__ . '/database.sql');
    
    // Remove CREATE DATABASE commands as we already created it
    $sql = preg_replace('/CREATE DATABASE.*?;/i', '', $sql);
    $sql = preg_replace('/USE .*?;/i', '', $sql);
    
    // Execute multiple queries
    mysqli_multi_query($conn, $sql);
    
    // Clear results
    while (mysqli_next_result($conn)) {
        if ($res = mysqli_store_result($conn)) {
            mysqli_free_result($res);
        }
    }
}

// Start session
session_start();

// Initialize cart and wishlist in session
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if (!isset($_SESSION['wishlist'])) {
    $_SESSION['wishlist'] = array();
}

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Get current user ID
function getUserId() {
    return isLoggedIn() ? $_SESSION['user_id'] : null;
}

// Get username
function getUsername() {
    return isset($_SESSION['username']) ? $_SESSION['username'] : null;
}
?>
