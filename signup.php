<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate name (only letters and spaces)
    if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
        echo "Name should only contain letters and spaces!";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate password length (must be at least 8 characters)
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters!";
        exit;
    }

    // Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Simulate user registration (since no database)
    // In a real scenario, you would store this data in a database.

    // Redirect to new page
    header("Location: afterlogin.html");
    exit();
}
?>
