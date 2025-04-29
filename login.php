<?php
session_start();

// Define the admin password
$admin_password = 'your_secure_password';

// Check if form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'];
    if ($password === $admin_password) {
        $_SESSION['logged_in'] = true;
        header('Location: admin.html');
        exit();
    } else {
        echo 'Invalid password. Please try again.';
    }
}
?>