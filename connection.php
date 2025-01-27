<?php
// connection.php

$servername = "localhost"; // Typically 'localhost'
$dbname = "fitness_app";
$db_username = "root"; // Replace with your DB username
$db_password = ""; // Replace with your DB password

try {
    // Create a new PDO instance
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8mb4", $db_username, $db_password);
    // Set PDO error mode to exception for better error handling
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // If connection fails, display the error
    die("Connection failed: " . $e->getMessage());
}
?>
