<?php

session_start();
include "../shared/string_functions.php";
include "../shared/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../4.php");
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


if (isset($_GET['quiz_number']) && $_GET['quiz_number'] >= 20 && $_GET['quiz_number'] <= 29) {
    $quiz_number = $_GET['quiz_number'];

    $stmt = $conn->prepare("SELECT question, choice1, choice2, choice3, choice4, correct_answer, quiz_title, timer FROM english_quiz WHERE quiz_number = ? ORDER BY RAND()");
    $stmt->bind_param("i", $quiz_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        $questions = $result->fetch_all(MYSQLI_ASSOC);

        if (!empty($questions)) {
            $quiz_title = $questions[0]['quiz_title'];
            $timer = $questions[0]['timer'];
        } else {
            echo "Error: No questions found in the database for quiz number $quiz_number.";
            exit();
        }
    } else {
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    function secondsToMinutes($seconds)
    {
        $minutes = floor($seconds / 60);
        $remainingSeconds = $seconds % 60;
        return "$minutes:$remainingSeconds";
    }

}

$stmt = $conn->prepare("SELECT question, choice1, choice2, choice3, choice4, correct_answer, quiz_title, timer FROM english_quiz ORDER BY RAND()");
$stmt->execute();
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html>



<head>




    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">

    <title>Quiz: english</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Playfair+Display:wght@500&family=Roboto+Condensed&family=Roboto:wght@400;500&display=swap');

        body {
            margin: 0;
            background: url(https://i.imgur.com/LgMxVxd.png) no-repeat center center fixed;
            background-size: cover;
        }


        header {
            display: flex;
            margin: 0;
            padding: 16px 40px;
            width: 93%;
            height: 49px;
            border-bottom: black 2px solid;
            background-color: #052249;
            align-items: center;
        }

        h1 {
            color: #143a6d;
            font-size: 50px;
            margin: 5px;
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
            margin-left: 65%;
            display: flex;
            gap: 50px;
            cursor: pointer;
        }

        .navbar-icons i {
            color: white;
        }

        .question {
            color: #143a6d;
            font-size: 20px;
            margin: 15px 50px;
            margin-bottom: 120px;
        }

        .persbox {
            width: 65%;
            height: 450px;
            margin-left: auto;
            margin-right: auto;
            background-color: #F5F5F5;
            padding: 50px;
        }

        .sikandbox {
            width: 80%;
            height: 420px;
            margin-left: auto;
            margin-right: auto;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            background-color: white;
            border-radius: 50px;
            padding: 20px;
        }

        .sikandbox h1 {
            color: black;
            font-size: 30px;
        }

        .sikandbox p {
            color: black;
            font-size: 20px;
            margin-top: 10px;
        }

        .question {
            color: #143a6d;
            font-size: 20px;

        }



        .btn:hover:not([disabled]) {
            background: rgb(2, 0, 36);
            background: linear-gradient(90deg, rgba(30, 144, 255, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }

        .btn:hover:disabled {
            cursor: no-drop;
        }

        .btn:active {
            transform: translate(0em, 0.2em);
        }

        .quiz-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: left;
            margin-top: 30px;
        }

        .forms {
            display: grid;
            grid-template-columns: repeat(2, .5fr);
            gap: 30px;
            justify-content: center;
            align-items: center;
        }

        .sikandbox i {
            color: black;
            font-size: 2vw;
            position: absolute;
            top: 50%;
            transform: translateY(-30%);
            cursor: pointer;
            border: solid 5px;
            border-radius: 80px;
            color: #2169AC;
            overflow: hidden;
            padding: 8px;
        }

        #prev {
            left: 240px;
        }

        .btn {
            width: 80%;
            height: 55px;
            color: white;
            background-color: #326CB9;
            cursor: pointer;
            border-radius: 20px;
            border: none;
            margin: 1px 0;
            margin-top: -25px;
            text-align: left;
            font-size: 20px;
            font-weight: 600;
            margin-right: 200px;
            margin-left: 30px;
            margin-bottom: 10px;
        }

        .btn.shadow {
            box-shadow: 0px 0px 10px 5px rgba(0, 0, 0, 0.3);
        }


        #next-btn {
            width: 100px;
            height: 45px;
            border-radius: 20px;
            border: 0;
            display: block;
            background-color: #326CB9;
            cursor: pointer;
            margin-left: 30px;
            color: white;
            font-weight: 600;
        }

        #next-btn:hover {
            background: #223;
        }

        .correct {
            background: #9aeabc;
        }

        .incorrect {
            background: #ff9393;
        }


        .score-container {
            width: 80%;
            height: 600px;
            margin: auto;
            margin-top: 60px;
            border-radius: 50px;
            background-color: #F5F5F5;
            text-align: center;
            padding: 30px;
        }

        .score-container img {
            width: 30%;
            height: 350px;
            display: block;
            margin: 0 auto;
            margin-top: 20px;
        }

        p {
            color: #143a6d;
            font-size: 40px;
            margin-top: 20px;
            margin-bottom: -2px;
        }

        .scorebtn {
            border-radius: 12px;
            background-color: #F5F5F5;
            margin-top: 3px;

        }



        @media only screen and (max-width: 767px) {

            header {
                width: 100%;
            }

            .persbox {
                height: 500px;
                padding: 20px;
                width: 80%;
            }

            .sikandbox {
                width: 87%;
                height: 460px;
            }

            form {
                grid-template-columns: 1fr;
                margin-right: 0;
            }

            #prev {
                display: none;
            }

            .btn {
                width: 62%;

            }

            #next-btn {
                margin-top: 2px;
            }

            .forms {
                grid-template-columns: 1fr;
                margin-right: 0;
                margin-left: 40px;
            }

            .question {
                margin: 15px 0 60px;
            }

            h1 {
                font-size: 25px;
                margin: 10px 0;
            }
        }

        @media only screen and (max-width: 480px) {
            .forms {
                display: flex;
                flex-direction: column;
                align-items: center;
                margin-right: 0;
                margin-left: 15%;
                margin-top: -5%;
            }

            .btn {
                width: 50% !important;
                margin-bottom: 10px;
                font-size: 16px;
            }

            #next-btn {
                margin-top: -10%;
                height: 45px;
                margin-left: -45%;
            }

            #questionNumber {
                font-size: 20px;
            }

            .question {
                font-size: 15px;
            }

            .trophy {
                height: 65% !important;
                width: 80% !important;
            }

            .grats {
                font-size: 20px;
            }

            #score-text {
                font-size: 18px;
            }

            .score-container {
                height: 460px !important;
                margin-top: 10px;
            }
        }
    </style>
</head>


<body>
    <header>
        <img src="https://i.imgur.com/FQdzZM0.png" style="width: 50px; height: 65px;">
        <a href="#">EduCard</a>

    </header>

    <div class="quiz-container" id="quiz-container">
        <h1>Quiz:
            <?php echo $quiz_title; ?>
        </h1>
        <div id="timer">Remaining Time: <span id="timer-value"><?php echo $timer; ?></span></div>



        <div class="persbox" id="persbox">
            <div class="sikandbox" id="sikandbox">
                <!--<i class="fas fa-chevron-left" id="prev"></i>-->
                <h1 id="questionNumber">Question #1</h1>
                <div class="question" id="question">Question</div>

                <div class="forms" id="answer-btns">
                    <button class="btn">1</button>
                    <button class="btn">2</button>
                    <button class="btn">3</button>
                    <button class="btn">4</button>
                    <button id="next-btn">Next</button>
                </div>


            </div>
        </div>

    </div>

    <div class="score-container" id="score-container" style="display: none;">
        <h1>YOUR SCORE</h1>
        <img src="https://i.imgur.com/1Fd1mBy.png" alt="Score Image" class="trophy">
        <p style="font-weight: 600;" class="grats">Congratulations!</p>
        <p id="score-text"></p>
        <button class="scorebtn" onclick="scoreBTN()">View scores</button>
    </div>
    </div>

    <script>
        $(document).ready(function () {
            const questions = <?php echo json_encode($questions); ?>;
            let currentQuestionIndex = 0;
            let userAnswers = [];
            let timeLeft = <?php echo $timer; ?>;
            let timer;

            function startTimer() {
                timer = setInterval(function () {
                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        alert('Time is up!');
                        displayScore();
                    } else {
                        $('#timer-value').text(formatTime(timeLeft));
                        timeLeft--;
                    }
                }, 1000);
            }

            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const remainingSeconds = seconds % 60;
                return `${minutes}:${remainingSeconds < 10 ? '0' : ''}${remainingSeconds}`;
            }

            function displayQuestion(index) {
                const question = questions[index];
                $('#questionNumber').text(`Question #${index + 1}`);
                $('#question').text(question.question);

                $('.btn').removeClass('correct incorrect btn-active shadow');
                $('#next-btn').prop('disabled', true);

                for (let i = 1; i <= 4; i++) {
                    $(`.btn:eq(${i - 1})`).text(question[`choice${i}`]);

                    $(`.btn:eq(${i - 1})`).off('click').on('click', function () {
                        $('.btn').removeClass('selected btn-active shadow');
                        $(this).addClass('selected btn-active shadow');
                        $('#next-btn').prop('disabled', false);
                    });
                }
                startTimer();
            }

            function checkAnswer() {
                const question = questions[currentQuestionIndex];
                const selectedAnswer = $('.btn.selected').text();
                const correctAnswer = question.correct_answer.toString();

                if (selectedAnswer === correctAnswer) {
                    $('.btn.selected').addClass('correct');
                } else {
                    $('.btn.selected').addClass('incorrect');
                }

                userAnswers.push(selectedAnswer);
            }

            function displayScore() {
                let score = 0;
                for (let i = 0; i < questions.length; i++) {
                    if (userAnswers[i] === questions[i].correct_answer.toString()) {
                        score++;
                    }
                }

                $.ajax({
                    type: 'POST',
                    url: 'insert_score.php',
                    data: {
                        full_name: '<?php echo $row_student['full_name']; ?>',
                        quiz_number: <?php echo $quiz_number; ?>,
                        score: score,
                    },
                    success: function (response) {
                        console.log(response);
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                    complete: function () {
                        clearInterval(timer);
                    }
                });

                $('#quiz-container').hide();
                $('#score-container').show();
                $('#score-text').text(`Your Score: ${score} out of ${questions.length}`);
            }

            $('#next-btn').on('click', function () {
                checkAnswer();
                currentQuestionIndex++;

                if (currentQuestionIndex < questions.length) {
                    setTimeout(function () {
                        displayQuestion(currentQuestionIndex);
                    }, 2000);
                } else {
                    displayScore();
                }
            });

            displayQuestion(currentQuestionIndex);
        });


        document.querySelector(".scorebtn").addEventListener("click", function () {
            window.location.href = "../13_profilepagestudent.php";
        });


    </script>

</body>

</html>