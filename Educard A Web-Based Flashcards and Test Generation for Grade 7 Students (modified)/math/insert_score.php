<?php

include "../shared/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $quiz_number = $_POST['quiz_number'];
    $score = $_POST['score'];
    $subject = "Math";
    
    $stmt = $conn->prepare("INSERT INTO score (full_name, quiz_number, score, subject) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siss", $full_name, $quiz_number, $score, $subject);
    
    
    if ($stmt->execute()) {
        echo "Score inserted successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}

?>