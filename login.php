<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        die("Please fill all fields.");
    }

    try {
        // Fetch user from database
        $stmt = $pdo->prepare("SELECT id, name, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Password is correct, start session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                
                header("Location: afterlogin.html");
                exit;
            } else {
                echo "<script>alert('Invalid email or password.'); window.location.href='login.html';</script>";
            }
        } else {
            echo "<script>alert('Invalid email or password.'); window.location.href='login.html';</script>";
        }

    } catch (PDOException $e) {
        die("Database Error: " . $e->getMessage());
    }
}
?>
