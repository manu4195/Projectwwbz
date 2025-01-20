<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login_signup.html');
    exit();
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: ../login_signup.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game Show</title>
    <link rel="stylesheet" href="../css/gameShow.css">
</head>
<body>
    <div class="container">
        <div class="logout-container">
            <a href="?logout=true" class="button logout-button">Logout</a>
        </div>
        <h1>Welcome to the Game Show!</h1>
        <div class="topics">
            <a href="quiz.php?quiz_id=1" class="button topic-button">General Knowledge Quiz</a>
            <a href="quiz.php?quiz_id=2" class="button topic-button">Science Quiz</a>
            <a href="quiz.php?quiz_id=3" class="button topic-button">History Quiz</a>
        </div>
        <div class="review-container">
            <button onclick="openReviewModal()" class="button review-button">Leave a Review</button>
        </div>
    </div>

    <div id="reviewModal" class="modal">
        <div class="modal-content">
            <span onclick="closeReviewModal()" class="close-btn">&times;</span>
            <form action="php/submit_review.php" method="post">
                <h2>Submit Your Review</h2>
                <textarea name="review_text" placeholder="Write your review here..." required></textarea>
                <input type="number" name="rating" min="1" max="5" placeholder="Rating (1-5)" required>
                <input type="hidden" name="quiz_id" value="1"> <!-- example value, adjust as needed -->
                <button type="submit" class="button submit-review-button">Submit</button>
            </form>
        </div>
    </div>

    <script>
        function openReviewModal() {
            document.getElementById('reviewModal').style.display = 'block';
        }

        function closeReviewModal() {
            document.getElementById('reviewModal').style.display = 'none';
        }
    </script>
</body>
</html>
