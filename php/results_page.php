<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login_signup.html');
    exit();
}

if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];
    $user_id = $_SESSION['user_id'];

    // Fetch the most recent quiz results for the user
    $stmt = $pdo->prepare('SELECT * FROM results WHERE user_id = ? AND quiz_id = ? ORDER BY created_at DESC LIMIT 1');
    $stmt->execute([$user_id, $quiz_id]);
    $result = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <link rel="stylesheet" href="../css/gameShow.css">
</head>
<body>
    <div class="container">
        <h1>Your Quiz Results</h1>
        <?php if ($result): ?>
            <p>Score: <?php echo $result['score']; ?>%</p>
            <p>Correct Answers: <?php echo $result['correct_answers']; ?></p>
            <p>Incorrect Answers: <?php echo $result['incorrect_answers']; ?></p>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
