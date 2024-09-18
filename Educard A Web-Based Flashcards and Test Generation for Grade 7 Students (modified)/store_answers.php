<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['userAnswers'])) {
        $_SESSION['user_answers'] = $data['userAnswers'];
    }
}
