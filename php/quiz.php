<?php
session_start();
require 'db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login_signup.html');
    exit();
}

if (isset($_GET['quiz_id'])) {
    $quiz_id = $_GET['quiz_id'];
    $question_index = isset($_GET['question_index']) ? (int)$_GET['question_index'] : 0;

    $stmt = $pdo->prepare('SELECT * FROM questions WHERE quiz_id = ?');
    $stmt->execute([$quiz_id]);
    $questions = $stmt->fetchAll();

    if (!$questions) {
        echo "<p>No questions found for this quiz.</p>";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $user_id = $_SESSION['user_id'];
        $current_question_id = $_POST['question_id'];
        $user_answer = $_POST['answer'];

        if (!isset($_SESSION['user_responses'])) {
            $_SESSION['user_responses'] = [];
        }

        $_SESSION['user_responses'][$current_question_id] = $user_answer;

        if ($question_index < count($questions) - 1) {
            header('Location: quiz.php?quiz_id=' . $quiz_id . '&question_index=' . ($question_index + 1));
        } else {
            $correct_answers = 0;
            $incorrect_answers = 0;

            foreach ($questions as $question) {
                $question_id = $question['question_id'];
                $correct_answer = $question['answer'];
                $user_response = $_SESSION['user_responses'][$question_id];

                if ($user_response === $correct_answer) {
                    $correct_answers++;
                } else {
                    $incorrect_answers++;
                }
            }

            $score = ($correct_answers / count($questions)) * 100;

            $stmt = $pdo->prepare('INSERT INTO results (user_id, quiz_id, score, correct_answers, incorrect_answers) VALUES (?, ?, ?, ?, ?)');
            $stmt->execute([$user_id, $quiz_id, $score, $correct_answers, $incorrect_answers]);

            unset($_SESSION['user_responses']);
            header('Location: results_page.php?quiz_id=' . $quiz_id);
            exit();
        }
    }

    $current_question = $questions[$question_index];
    $choices = explode('|', $current_question['choices']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link rel="stylesheet" href="../css/gameShow.css">
    <link rel="stylesheet" href="../css/quizStyles.css">
    <link rel="stylesheet" href="path/to/global.css">

</head>
<body>
    <div class="quiz-container">
        <h1>Quiz Time</h1>
        <form method="post" id="quizForm">
            <div class="question">
                <p><?php echo htmlspecialchars($current_question['question_text']); ?></p>
                <div class="choices">
                    <?php foreach ($choices as $choice): ?>
                        <button type="submit" name="answer" value="<?php echo htmlspecialchars(substr($choice, 0, 1)); ?>" class="quiz-button">
                            <?php echo htmlspecialchars($choice); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" name="question_id" value="<?php echo htmlspecialchars($current_question['question_id']); ?>">
            </div>
        </form>
    </div>
</body>
</html>

