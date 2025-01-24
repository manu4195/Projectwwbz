<?php
session_start();
if (isset($_SESSION['user_id'])) {
    // Destroy the session if it is active
    session_destroy();
    header('Location: login_signup.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Sign Up</title>
    <link rel="stylesheet" href="css/signup_login.css">
</head>
<body>
    <div class="container">
        <div class="buttons">
            <button onclick="showForm('login')">Login</button>
            <button onclick="showForm('signup')">Sign Up</button>
        </div>
        <div id="login" class="form-container" style="display: none;">
            <h2>Login</h2>
            <form action="php/login_progress.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="button">Login</button>
            </form>
        </div>
        <div id="signup" class="form-container">
            <h2>Sign Up</h2>
            <form id="signupForm" action="php/signup-process.php" method="post" onsubmit="return validatePassword()">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="password" id="confirm_password" placeholder="Confirm Password" required>
                <button type="submit" class="button">Sign Up</button>
            </form>
        </div>
    </div>

    <script>
        function showForm(formId) {
            document.getElementById('login').style.display = 'none';
            document.getElementById('signup').style.display = 'none';
            document.getElementById(formId).style.display = 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            showForm('signup');
        });

        function validatePassword() {
            const password = document.getElementById('password').value;
            const confirm_password = document.getElementById('confirm_password').value;

            if (password !== confirm_password) {
                alert('dumbass password is wrong. try again');
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

