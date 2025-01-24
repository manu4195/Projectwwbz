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
            <form id="loginForm" action="php/login_progress.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" class="button">Login</button>
            </form>
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<div id="login-error" class="error-popup">
                        <p>' . $_SESSION['login_error'] . '</p>
                        <button onclick="closeErrorPopup()">Close</button>
                      </div>';
                unset($_SESSION['login_error']);
            }
            ?>
        </div>
        <div id="signup" class="form-container">
            <h2>Sign Up</h2>
            <form id="signupForm" action="php/signup-process.php" method="post" onsubmit="return validateSignup()">
                <input type="text" name="username" placeholder="Username" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" id="signup_password" name="password" placeholder="Password" required>
                <input type="password" id="confirm_signup_password" placeholder="Confirm Password" required>
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

        function validateSignup() {
            const password = document.getElementById('signup_password').value;
            const confirmPassword = document.getElementById('confirm_signup_password').value;

            if (password !== confirmPassword) {
                alert('Passwords do not match. Please try again.');
                return false;
            }
            return true;
        }

        function closeErrorPopup() {
            document.getElementById('login-error').style.display = 'none';
        }
    </script>
</body>
</html>
