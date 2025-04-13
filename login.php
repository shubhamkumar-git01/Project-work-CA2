<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate password (at least 8 characters)
    if (strlen($password) < 8) {
        echo "Password must be at least 8 characters!";
        exit;
    }

    // Simulate database user validation (since no database)
    // Assuming 'user@example.com' and 'password123' is a valid user
    $valid_email = 'user@example.com';
    $valid_password = 'password123';

    if ($email === $valid_email && $password === $valid_password) {
        echo "Login successful!";
        // Redirect to a protected page (like a dashboard) here
    } else {
        echo "Invalid credentials!";
    }
}
?>
