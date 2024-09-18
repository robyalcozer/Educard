<?php
include "shared/connect.php";

if (isset($_POST['subject'])) {
    $subject = $_POST['subject'];

    $sql_flashcard = "SELECT lesson_number FROM ";

    switch ($subject) {
        case 'science':
            $sql_flashcard .= "science_teacher";
            break;
        case 'filipino':
            $sql_flashcard .= "filipino_teacher";
            break;
        case 'english':
            $sql_flashcard .= "english_teacher";
            break;
        case 'math':
            $sql_flashcard .= "math_teacher";
            break;
        default:
            $sql_flashcard .= "science_teacher"; 
    }

    $result_flashcard = mysqli_query($conn, $sql_flashcard);
    $flashcard_numbers = mysqli_fetch_all($result_flashcard, MYSQLI_ASSOC);

    echo json_encode($flashcard_numbers);
} else {
    echo json_encode(['error' => 'Invalid request']);
}

