<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Insert user into the database
    $stmt = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
    if ($stmt->execute([$username, $email, $password])) {
        header('Location: login_signup.html');
        exit();
    } else {
        echo 'Error signing up';
    }
}
?>
