<?php
// create_admin.php

// Include the database connection
require 'connection.php';

// Define admin credentials
$username = 'admin';
$password = 'admin123';

// Function to sanitize input (optional but recommended)
function sanitize_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

try {
    // Sanitize inputs
    $username = sanitize_input($username);
    $password = sanitize_input($password);

    // Check if the admin already exists
    $check_stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username LIMIT 1");
    $check_stmt->bindParam(':username', $username);
    $check_stmt->execute();

    if ($check_stmt->rowCount() > 0) {
        echo "<h3>Admin user '<strong>" . htmlspecialchars($username) . "</strong>' already exists.</h3>";
    } else {
        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the INSERT statement
        $insert_stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (:username, :password)");
        $insert_stmt->bindParam(':username', $username);
        $insert_stmt->bindParam(':password', $hashed_password);

        // Execute the statement
        if ($insert_stmt->execute()) {
            echo "<h3>Admin user '<strong>" . htmlspecialchars($username) . "</strong>' created successfully.</h3>";
            echo "<p><strong>Password:</strong> " . htmlspecialchars($password) . "</p>";
            echo "<p>Please <a href='index.php'>login here</a> using these credentials.</p>";
        } else {
            echo "<h3>Failed to create admin user. Please try again.</h3>";
        }
    }
} catch(PDOException $e) {
    echo "<h3>Error: " . htmlspecialchars($e->getMessage()) . "</h3>";
}
?>
