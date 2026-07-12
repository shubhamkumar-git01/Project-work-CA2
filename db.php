<?php
$host = "localhost";
$username = "root";
$password = ""; // Default XAMPP password is empty
$dbname = "helpmefy_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("ERROR: Could not connect to the database. " . $e->getMessage());
}
?>
