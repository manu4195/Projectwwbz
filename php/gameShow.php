
<?php 
//  Create the gameshow_db database
//    Create tables:
//        - Users: id, username, password, user_type
//        - Quizzes: quiz_id, title, description
//        - Questions: question_id, quiz_id, question_text, answer_options, correct_answer
//        - Results: result_id, user_id, quiz_id, score, timestamp */

//  Connect to the database using PDO
//    Create table statements: Prepare to insert a user into the Users table
//    Bind parameters (username, password, user_type)
//    Execute the statement to insert the user record 



//  When the user clicks 'Login', display the login form
//  On form submission, connect to the database using PDO
//  Prepare a query to select the user where the username and password match
//  Execute the query and fetch the user type
//  If the user is a 'Player', authenticate them and redirect to the start page
//  If the user is an 'Admin', authenticate and redirect to the admin dashboard

// Display a list of available quizzes
//    Connect to the database using PDO
//    Prepare a query to select all quizzes
//    Execute the query and fetch the list of quizzes
//    For each quiz, show the title and description
//    Add a 'Start Quiz' button for each quiz 

//  Display the quiz questions
//    Connect to the database using PDO
//    Prepare a query to select questions where quiz_id matches
//    Execute the query and fetch the questions
//    For each question:
//        - Show the question text
//        - Display the answer options
//        - If the user selects an answer, validate it and move to the next question
//    End of quiz, display the 'Submit' button 



?>

