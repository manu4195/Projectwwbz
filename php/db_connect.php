<?php
$dsn = 'mysql:host=localhost;dbname=projectwwbz';
$username = 'root'; // Default XAMPP username
$password = ''; // Default XAMPP password is empty

try {
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!-- //  Create the gameshow_db database
//    Create tables:
//        - Users: id, username, password, user_type
//        - Quizzes: quiz_id, title, description
//        - Questions: question_id, quiz_id, question_text, answer_options, correct_answer
//        - Results: result_id, user_id, quiz_id, score, timestamp */

//  Connect to the database using PDO
//    Create table statements: Prepare to insert a user into the Users table
//    Bind parameters (username, password, user_type)
//    Execute the statement to insert the user record  -->
