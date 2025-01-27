<?php
// logout.php

// Enable error reporting for debugging (Development Only)
// You can remove or comment out these lines in production
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// If you want to destroy the session cookie as well (optional but recommended)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Redirect to the login page with a logout message (optional)
header("Location: index.php?logout=success");
exit;
?>
