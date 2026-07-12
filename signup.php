<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($password)) {
        die("Please fill all fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    if (strlen($password) < 8) {
        die("Password must be at least 8 characters long.");
    }

    try {
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            die("Email is already registered. Please login.");
        }

        // Hash the password securely
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert new user
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashed_password);

        if ($stmt->execute()) {
            // Log the user in immediately after signup
            $_SESSION['user_id'] = $pdo->lastInsertId();
            $_SESSION['user_name'] = $name;
            header("Location: afterlogin.html");
            exit;
        } else {
            die("Something went wrong. Please try again later.");
        }

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>
