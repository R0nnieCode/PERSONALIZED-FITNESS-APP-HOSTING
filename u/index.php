<?php


// Enable error reporting for debugging (Development Only)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// index.php
session_start();
require '../connection.php';

// If admin is already logged in, redirect to upload page
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: upload.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Please enter both username and password.";
    } else {
        try {
            // Prepare a SELECT statement to fetch the admin user
            $stmt = $conn->prepare("SELECT * FROM admins WHERE username = :username LIMIT 1");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Check if user exists
            if ($stmt->rowCount() == 1) {
                $admin = $stmt->fetch(PDO::FETCH_ASSOC);
                // Verify the password
                if (password_verify($password, $admin['password'])) {
                    // Password is correct, start a new session
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $admin['username'];
                    header("Location: upload.php");
                    exit;
                } else {
                    $error = "Invalid username or password.";
                }
            } else {
                $error = "Invalid username or password.";
            }
        } catch(PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Personalized Fitness and Nutrition Coaching</title>
    <link rel="icon" href="../img/logo.png" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Light Gray */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
        }
        .login-container {
            background-color: #ffffff; /* White */
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 1.5rem;
            color: #8B0000; /* Dark Red */
        }
        .error {
            color: red;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>Admin Login</h2>
        
        <?php
        if (!empty($error)) {
            echo '<div class="error">' . htmlspecialchars($error) . '</div>';
        }
        ?>

        <form method="POST" action="index.php">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required 
                       value="admin" readonly>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required 
                       placeholder="Enter your password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS and dependencies (Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
