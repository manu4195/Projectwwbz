<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login_signup.php');
    exit();
}

if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the most recent quiz results for the user
    $stmt = $pdo->prepare('SELECT * FROM results WHERE user_id = ? AND quiz_id = ? ORDER BY created_at DESC LIMIT 1');
    $stmt->execute([$user_id, $quiz_id]);
    $result = $stmt->fetch();

    // Fetch the total points for the user
    $stmt = $pdo->prepare('SELECT total_points FROM users WHERE user_id = ?');
    $stmt->execute([$user_id]);
    $user = $stmt->fetch();
}

// Destroy the session but stay on the page
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../css/gameShow.css">
    <link rel="stylesheet" href="../css/global.css">
</head>
<body>
    <div class="container">
        <h1>Your Quiz Results</h1>
        <?php if ($result): ?>
            <p>Correct Answers: <?php echo htmlspecialchars($result['correct_answers']); ?></p>
            <p>Incorrect Answers: <?php echo htmlspecialchars($result['incorrect_answers']); ?></p>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
        <p>Total Points: <?php echo htmlspecialchars($user['total_points']); ?></p>
        <button onclick="window.location.href='../login_signup.php'" class="button">Logout</button>
    </div>
</body>
</html>
