<?php

require_once('shared/connect.php');

$subject = isset($_POST['subject']) ? $_POST['subject'] : '';

if (empty($subject)) {
    echo json_encode(['error' => 'Subject not specified']);
    exit;
}

$query = "SELECT quiz_number, quiz_title FROM {$subject}_quiz";
$result = mysqli_query($conn, $query);

if (!$result) {
    echo json_encode(['error' => 'MySQL Error: ' . mysqli_error($conn)]);
    exit;
}

$quizzes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $attempted = false;
    
    $quizzes[] = [
        'quiz_number' => $row['quiz_number'],
        'quiz_title' => $row['quiz_title'],
        'attempted' => $attempted,
    ];
}

echo json_encode(['quizzes' => $quizzes]);
mysqli_close($conn);
