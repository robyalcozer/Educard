<?php
session_start();
include "shared/connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    $sql_quiz = "SELECT DISTINCT quiz_number, quiz_title FROM ";

switch ($subject) {
    case 'science':
        $sql_quiz .= "science_quiz";
        break;
    case 'filipino':
        $sql_quiz .= "filipino_quiz";
        break;
    case 'english':
        $sql_quiz .= "english_quiz";
        break;
    case 'math':
        $sql_quiz .= "math_quiz";
        break;
    default:
        $sql_quiz .= "science_quiz";  
}

$result_quiz = mysqli_query($conn, $sql_quiz);
$quiz_numbers = mysqli_fetch_all($result_quiz, MYSQLI_ASSOC);


    echo json_encode($quiz_numbers);
} else {
    
    echo json_encode([]);
}
