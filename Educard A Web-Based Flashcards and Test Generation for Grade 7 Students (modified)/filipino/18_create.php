<?php
session_start();
include "../shared/string_functions.php";
include "../shared/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../5.php");
    exit();
}


$username = $_SESSION['username'];

$sql_student = "SELECT full_name, pic FROM student_acc WHERE username = '$username'";
$result_student = mysqli_query($conn, $sql_student);
$row_student = mysqli_fetch_assoc($result_student);

$sql_teacher = "SELECT full_name, pic FROM teacher_acc WHERE username = '$username'";
$result_teacher = mysqli_query($conn, $sql_teacher);
$row_teacher = mysqli_fetch_assoc($result_teacher);

if (!$row_student && !$row_teacher) {
    header("Location: ../5.php");
    exit();
}

if (isset($_POST['logout'])) {
    $_SESSION = array();

    session_destroy();

    header("Location: ../3 teacher portal or student portal.php");
    exit();
}
?>


<?php
if (isset($_POST["question_count"])) {
    $quiz_number = $_POST["subject"];
    $quiz_title = $_POST["quiz_title"];

    $selected_timer = isset($_POST["timer"]) ? $_POST["timer"] : null;


    if ($selected_timer !== null && is_numeric($selected_timer)) {
        $timer = $selected_timer * 60;
    } else {

        $timer = 0;
    }

    for ($i = 1; $i <= $_POST["question_count"]; $i++) {
        $question = $_POST["question_" . $i];
        $choice1 = $_POST["choice1_" . $i];
        $choice2 = $_POST["choice2_" . $i];
        $choice3 = $_POST["choice3_" . $i];
        $choice4 = $_POST["choice4_" . $i];
        $correct_answer = $_POST["correct_answer_" . $i];

        $insertquery = $conn->prepare("
            INSERT INTO filipino_quiz (correct_answer, question, choice1, choice2, choice3, choice4, quiz_number, quiz_title, timer)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");

        $insertquery->bind_param("sssssssss", $correct_answer, $question, $choice1, $choice2, $choice3, $choice4, $quiz_number, $quiz_title, $timer);

        if ($insertquery->execute()) {
        } else {

            echo "Error: " . $insertquery->error;
        }
    }

    header("Location: 18_create.php?quiz_number=" . mysqli_insert_id($conn));
    exit();
}

$sql_fetch_quiz = "SELECT quiz_number, subject, quiz_title FROM filipino_quiz GROUP BY quiz_number";
$result_fetch_quiz = mysqli_query($conn, $sql_fetch_quiz);
?>




<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
        <title>Create: filipino Quiz</title>
        <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Mooli&family=Roboto+Condensed&family=Roboto:wght@500&display=swap');

            a>button {
                float: left;
                width: 55px;
                height: 30px;
                border-radius: 29px;
                border: none;
                cursor: pointer;
                background-color: #375E8C;
                font-size: 15px;
                color: #ffffff;
                margin: 15px 50px 5px;
            }

            body {
                margin: 0;
                overflow-x: hidden;
                overflow-y: none;
                height: 100vh;
            }


            header {
                display: flex;
                margin: 0;
                padding: 16px 40px;
                height: 49px;
                border-bottom: black 2px solid;
                background-color: #052249;
                align-items: center;
            }

            h1 {
                font-size: 35px;
                margin: 10px 60px;
            }

            header img {
                cursor: pointer;
                margin: -6px -20px 5px;
            }

            a {
                margin: 4px 25px 1px;
                color: #ffffff;
                text-decoration: none;
                font-size: 35px;
            }

            .navbar-icons {
                margin-left: auto;
                display: flex;
                gap: 50px;
                cursor: pointer;
                display: none;
            }

            .navbar-icons i {
                color: white;
                cursor: pointer;
            }


            .profile-icon {
                position: relative;
            }

            .profile-icon .dropdown {
                position: absolute;
                width: 300px;
                height: 200px;
                top: 27px;
                right: -10px;
                display: none;
                flex-direction: column;
                align-items: center;
                border: 0;
                background-color: #4982B7;
                border-radius: 40px;
                min-width: 160px;
                box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
                z-index: 1;
            }

            .profile-icon:hover .dropdown {
                display: flex;
            }

            .profile-icon .dropdown img {
                height: auto;
                width: 50px;
                margin: 10px;
                border-radius: 50%;
            }

            .profile-info {
                display: flex;
                align-items: center;
                margin: 10px;
            }

            .profile-info img {
                width: 50px;
                border-radius: 50%;
                margin-right: 10px;
            }

            .profile-icon .dropdown a {
                color: white;
                text-decoration: none;
                padding: 12px 16px;
                display: flex;

                align-items: center;

            }

            .profile-icon .dropdown a img {
                width: 50px;

                height: 50px;
                border-radius: 50%;
                ;
            }

            .profile-icon .dropdown a:hover {
                background-color: #143a6d;
                border-radius: 40px;
            }

            .profile-info a {
                display: flex;
                flex-direction: row;
                margin-right: 20px;
            }

            .profile-info a img {
                width: 50px;
                height: 50px;
                border-radius: 50%;
                margin-right: 10px;
            }

            input {
                width: 280px;
                height: 30px;
                background-color: #375E8C;
                border: none;
                margin: 10px 65px 5px;
                box-shadow: inset 2px 5px 10px rgba(0, 0, 0, 0.3);
                transition: 300ms ease-in-out;
                color: white;
                font-size: 18px;
            }


            .input:focus {
                background-color: white;
                transform: scale(1.05);
                box-shadow: 13px 13px 100px #969696,
                    -13px -13px 100px #ffffff;
            }

            label {
                margin: 10px 80px 5px;
                font-size: 26px;
            }

            form button {
                float: left;
                margin: 20px 65px;
                width: 120px;
                height: 45px;
                border-radius: 29px;
                border: none;
                cursor: pointer;
                background-color: #375E8C;
                font-size: 25px;
                color: #ffffff;
            }

            .container {
                display: flex;
                flex-wrap: wrap;
            }

            form {
                margin: 20px 0;
            }



            p {
                position: absolute;
                bottom: 65%;
                font-size: 25px;
                color: black;
                text-align: left;
            }



            .containers {
                max-width: 1000px;
                margin-left: auto;
                margin-right: auto;
                padding-left: 10px;
                padding-right: 10px;
            }

            .responsive-table {
                li {
                    border-radius: 3px;
                    padding: 25px 30px;
                    display: flex;
                    justify-content: space-between;
                    margin-bottom: 25px;
                }

                .table-header {
                    background-color: #95A5A6;
                    font-size: 14px;
                    text-transform: uppercase;
                    letter-spacing: 0.03em;
                }

                .table-row {
                    background-color: #ffffff;
                    box-shadow: 0px 0px 9px 0px rgba(0, 0, 0, 0.1);
                }

                .col-1 {
                    flex-basis: 10%;
                }

                .col-2 {
                    flex-basis: 40%;
                }

                .col-3 {
                    flex-basis: 25%;
                }

                .col-4 {
                    flex-basis: 25%;
                }



                .buttonz {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    background-color: rgb(20, 20, 20);
                    border: none;
                    font-weight: 600;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.164);
                    cursor: pointer;
                    transition-duration: .3s;
                    overflow: hidden;
                    position: relative;
                }

                .svgIcon {
                    width: 12px;
                    transition-duration: .3s;
                }

                .svgIcon path {
                    fill: white;
                }

                .buttonz:hover {
                    width: 140px;
                    border-radius: 50px;
                    transition-duration: .3s;
                    background-color: rgb(255, 69, 69);
                    align-items: center;
                }

                .buttonz:hover .svgIcon {
                    width: 50px;
                    transition-duration: .3s;
                    transform: translateY(60%);
                }

                .buttonz::before {
                    position: absolute;
                    top: -20px;
                    content: "Delete";
                    color: white;
                    transition-duration: .3s;
                    font-size: 2px;
                }

                .buttonz:hover::before {
                    font-size: 13px;
                    opacity: 1;
                    transform: translateY(30px);
                    transition-duration: .3s;
                }





                @media all and (max-width: 767px) {

                    .navbar-icons {
                        display: none;
                    }

                    a>button {
                        display: block;
                    }

                    .table-header {
                        display: none;
                    }

                    .table-row {}

                    li {
                        display: block;
                    }

                    .col {

                        flex-basis: 100%;

                    }

                    .col {
                        display: flex;
                        padding: 10px 0;

                        &:before {
                            color: #6C7A89;
                            padding-right: 10px;
                            content: attr(data-label);
                            flex-basis: 50%;
                            text-align: right;
                        }
                    }
                }
            }

            @media all and (max-width: 600px) {
                .navbar-icons {
                    display: none;
                }

                header img {
                    margin-top: 2px;
                }

                header a {
                    font-size: 25px;
                }

                header {
                    height: 35px;
                }

                h1 {
                    text-align: center;
                    font-size: 30px;
                }

                label {
                    font-size: 16px !important;
                }

                .table-row {
                    width: 250px;
                }

                a>button {
                    display: block;
                }

                input#subject {
                    font-size: 12px;
                }
            }
        </style>
    </head>

<body>

    <header>

        <img src="https://i.imgur.com/FQdzZM0.png" style="width: 50px; height: 65px;">
        <a href="../15_teacherlanding.php">EduCard</a>

        <div class="navbar-icons">
            <a href="../15_teacherlanding.php" style="font-size: 16px; margin-right:-20px;"><i
                    class="fa-solid fa-house fa-2x"></i></a>
            <a href="../19_flashcardpage.php" style="font-size: 16px; "><i class="fa-solid fa-file fa-2x"></i></a>
            <div class="profile-icon">
                <i class="fa-solid fa-user fa-2x" id="profile" style="margin-top: 3px; margin-left:-20px;"></i>
                <div class="dropdown">
                    <?php
                    if ($row_student) {
                        echo '<a href="../16_profilepageteacher.php" style="font-size: 18px;" id="profileLink">';
                        echo '<img src="' . $row_student["pic"] . '" id="dp" alt="Profile Image" />';
                        echo $row_student["full_name"];
                        echo '</a>';

                    } elseif ($row_teacher) {
                        echo '<a href="../16_profilepageteacher.php" style="font-size: 18px;" id="profileLink">';
                        echo '<img src="' . $row_teacher["pic"] . '" id="dp" alt="Profile Image" />';
                        echo $row_teacher["full_name"];
                        echo '</a>';

                    }
                    ?>

                    <a href="../16_profilepageteacher.php" style="margin-bottom: 30px; font-size: 20px;">Settings</a>
                    <a href="#" style="font-size: 20px;" id="logout">Logout</a>
                </div>
            </div>
        </div>
    </header>

    <a href="../15_teacherlanding.php"><button>Back?</button></a>

    <h1 style="margin: 10px; color: #41618F; margin: 10px 35px 5px;">Create your own quiz</h1>



    <div class="container">
        <form method="POST" id="quiz-form">

            <label for="quiz_title">Quiz Title</label><br>
            <input type="text" id="quiz_title" name="quiz_title" required style="width: 68%; height: 45px;"><br>

            <label for="timer">Quiz Timer (in minutes)</label><br>
            <input type="number" name="timer" id="timer" style="width: 68%; height: 45px;"><br>


            <label for="quiz_number">Quiz Number</label><br>
            <input type="number" id="subject" name="subject" placeholder="Please enter a quiz number between 10 and 19."
                required style="width: 68%; height: 45px;" min="10" max="19"> <br>

            <label for="question_count">Number of Questions</label><br>
            <input type="number" id="question_count" name="question_count" required style="width: 68%; height: 45px;">
            <button type="button" style="display:block;" id="submitButton"
                onclick="validateAndGenerateQuestions()">Submit</button><br>

            <div id="questions-container"></div>

            <button type="submit" id="createBtn" name="create" style="display:none;">Create</button>

        </form>
    </div>


    <div class="containers">
        <ul class="responsive-table">
            <li class="table-header">
                <div class="col col-1">Quiz #</div>
                <div class="col col-2">Subject</div>
                <div class="col col-3">Quiz Title</div>
                <div class="col col-4">Delete Quiz</div>
            </li>

            <?php
            while ($row_quiz = mysqli_fetch_assoc($result_fetch_quiz)) {
                echo '<li class="table-row" data-quiz-id="' . $row_quiz['quiz_number'] . '">';
                echo '<div class="col col-1" data-label="Quiz Number">' . $row_quiz['quiz_number'] . '</div>';
                echo '<div class="col col-2" data-label="Subject">' . $row_quiz['subject'] . '</div>';
                echo '<div class="col col-3" data-label="Quiz Title">' . $row_quiz['quiz_title'] . '</div>';
                echo '<div class="col col-4" data-label="Delete Quiz">';
                echo '<button class="buttonz delete-btn">';
                echo '<svg viewBox="0 0 448 512" class="svgIcon">';
                echo '<path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>';
                echo '</svg>';
                echo '</button>';
                echo '</div>';
                echo '</li>';
            }
            ?>
        </ul>
    </div>


    <script>

        function validateAndGenerateQuestions() {
            if (validateQuizNumber()) {
                generateQuestions();
            }
        }

        function validateQuizNumber() {
            var quizNumberInput = document.getElementById("subject");
            var quizNumber = parseInt(quizNumberInput.value);

            var isValid = quizNumber >= 10 && quizNumber <= 19;

            if (!isValid) {
                alert("Please enter a quiz number between 10 and 19.");
            }

            document.getElementById("createBtn").disabled = !isValid;

            quizNumberInput.setCustomValidity(isValid ? "" : "Please enter a quiz number between 10 and 19.");

            return isValid;
        }


        function generateQuestions() {
            var questionCount = document.getElementById("question_count").value;
            var questionsContainer = document.getElementById("questions-container");
            questionsContainer.innerHTML = "";

            for (var i = 1; i <= questionCount; i++) {
                var questionHtml = `
                    <label for="question_${i}">Question ${i}</label><br>
                    <input type="text" id="question_${i}" name="question_${i}" required
                        style=" width: 1000px; height: 45px;"><br>

                    <label for="choice1_${i}">Choice 1</label><br>
                    <input type="text" id="choice1_${i}" name="choice1_${i}" required
                        style="width: 60%; height: 45px;"><br>

                    <label for="choice2_${i}">Choice 2</label><br>
                    <input type="text" id="choice2_${i}" name="choice2_${i}" required
                        style="width: 60%; height: 45px;"><br>

                    <label for="choice3_${i}">Choice 3</label><br>
                    <input type="text" id="choice3_${i}" name="choice3_${i}" required
                        style="width: 60%; height: 45px;"><br>

                    <label for="choice4_${i}">Choice4</label><br>
                    <input type="text" id="choice 4_${i}" name="choice4_${i}" required
                        style="width: 60%; height: 45px;"><br>

                    <label for="correct_answer_${i}">Correct Answer</label><br>
                    <input type="text" id="correct_answer_${i}" name="correct_answer_${i}" required
                        style="width: 60%; height: 45px;"><br><br>
                `;

                questionsContainer.innerHTML += questionHtml;
            }
            document.getElementById("submitButton").style.display = "none";

            document.getElementById("createBtn").style.display = "block";
        }

        document.getElementById("quiz-form").addEventListener("submit", function () {
            document.getElementById("createBtn").style.display = "none";
        });



        document.getElementById("logout").addEventListener("click", function () {
            window.location.href = "../3 teacher portal or student portal.php";
        });

        document.getElementById("profileLink").addEventListener("click", function () {
            window.location.href = "../16_profilepageteacher.php";
        });


        document.addEventListener("DOMContentLoaded", function () {
            document.querySelectorAll('.delete-btn').forEach(function (button) {
                button.addEventListener('click', function () {
                    var quizId = this.closest('.table-row').getAttribute('data-quiz-id');

                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'delete_quiz.php', true);
                    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState == 4 && xhr.status == 200) {
                            console.log(xhr.responseText);

                            location.reload();
                        }
                    };
                    xhr.send('quiz_number=' + quizId);
                });
            });
        });
    </script>
</body>

</html>