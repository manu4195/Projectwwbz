<?php
require 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_id = $_POST['quiz_id'];
    $user_id = $_SESSION['user_id']; // Assuming you have user session management
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    $stmt = $pdo->prepare('INSERT INTO reviews (quiz_id, user_id, review_text, rating) VALUES (?, ?, ?, ?)');
    if ($stmt->execute([$quiz_id, $user_id, $review_text, $rating])) {
        header('Location: ../php/gameShow.php');
        exit();
    } else {
        echo 'Error submitting review';
    }
}
?>
