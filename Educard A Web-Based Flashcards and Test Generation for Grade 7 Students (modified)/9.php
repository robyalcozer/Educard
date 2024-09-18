<?php
session_start();
include "shared/string_functions.php";
include "shared/connect.php";

if (!isset($_SESSION['username'])) {
    
    header("Location: 4.php");
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
    
    header("Location: 5.php");
    exit();
}

if (isset($_POST['logout'])) {
    
    $_SESSION = array();

    
    session_destroy();

    
    header("Location: 3 teacher portal or student portal.php");
    exit();
}

$subject = isset($_POST['subject']) ? $_POST['subject'] : 'science';  // Default to science if not set

$sql_quiz = "SELECT quiz_number, quiz_title FROM ";

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
<link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">
    <title>Dashboard: Student</title>
</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Playfair+Display:wght@500&family=Roboto+Condensed&family=Roboto:wght@400;500&display=swap');

        body {
            margin: 0;
            overflow-x: hidden;
            background: url(https://i.imgur.com/LgMxVxd.png) no-repeat center center fixed;
            background-size: cover;
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
            color: black;
            font-size: 40px;
            margin: 10px 60px;
            text-shadow: 2px 1px 0px rgba(255, 255, 255, 1);
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
            height: 300px;
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

        .box {
            width: 195px;
            height: 140px;
            border-radius: 45px;
            float: left;
            margin: -1px -30px 40px;
            margin-left: 100px;
            overflow-y: hidden;
            overflow-x: hidden;
            color: black;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 10);
        }

        .container {
            max-width: 100%;
            float: left;
        }

        .container2 {
            max-width: 45%;
            float: right;
        }

        .addclass {
            width: 300px;
            height: 80px;
            border-radius: 45px;
            float: right;
            margin: 1px 72px 40px;
            color: black;
            font-size: 15px;
            border: none;
            display: flex;
            align-items: center;
        }

        .addclass i {
            margin-left: 10px;
        }

        .activities {
            width: 300px;
            height: 500px;
            border-radius: 45px;
            float: right;
            margin: 1px 67px 40px;
            color: black;
            font-size: 30px;
            background-color: #143a6d;
            flex-direction: column;
        }

        .acticon {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
            width: 50px;
            height: 50px;
            border-radius: 60px;
            background-color: aqua;
            margin-left: 20px;
            cursor: pointer;

        }

        .acticon button {
            margin-left: 35px;
            font-size: 20px;
            color: white;
            width: 300px;
            background-color: #143a6d;
            border: none;
            cursor: pointer;
        }




        .popup-content {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
        }

        .popup-contents {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-bottom: 60px;
        }

        .popup:before {
            content: "";
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-width: 10px;
            border-style: solid;
            border-color: transparent transparent #F0F0F0 transparent;
        }


        .flash {
            border-radius: 35px;
            width: 120px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            background-color: #143a6d;
            border: none;
            font-size: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 25px;
        }

        .test {
            border-radius: 35px;
            width: 120px;
            height: 100px;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            background-color: #143a6d;
            border: none;
            font-size: 20px;
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-top: 25px;
        }

        .icon {
            width: 35px;
            height: 43px;
        }

        .learn {
            width: 150px;
            height: 50px;
            margin: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            border: none;
            border-radius: 15px;
            color: #ffffff;
            background-color: #143a6d;
            cursor: pointer;
            font-size: 18px;
        }

        .popup {
            position: absolute;
            display: none;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 10);
            bottom: 40px;
            transform: translateX(-50%);
            height: 160px;
            width: 340px !important;
            opacity: 1;
            top: 105%;
            transform: none;
            font-size: 20px;
            z-index: 1000;
            margin-left: -80px;
        }

        .tests-popup {
            position: absolute;
            display: none;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 10);
            bottom: 40px;
            left: -.1%;
            transform: translateX(-50%);
            width: 340px !important;
            opacity: 1;
            top: 105%;
            transform: none;
            font-size: 20px;
            z-index: 1000;
        }

        .flash-popup {
            position: absolute;
            display: none;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 3);
            bottom: 40px;
            transform: translateX(-50%);
            height: 160px;
            width: 340px !important;
            opacity: 1;
            top: 105%;
            transform: none;
            font-size: 20px;
            z-index: 1000;
            margin-left: -10px;
        }

        header .iconz {
            display: none;
        }

        .popup-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            font-size: 30px;
            margin-left: -30px;
            margin-top: 310px;
            background-color: #052249;
        }

        /* Style for each menu item */
        .popup-menu a {
            color: white;
            padding: 12px 16px;
            display: none;
            text-decoration: none;
        }


        @media only screen and (max-width: 480px) {

            /* Style for the icon */
            .iconz {
                margin-left: auto;
                margin-right: -20px;
                cursor: pointer;
            }


            .popup-menu a {
                display: block;
            }

            .popup {
                margin-left: -12% !important;
            }

        }

        @media only screen and (max-width: 600px) {

            header img {
                margin-top: 2px;
            }

            header a {
                font-size: 25px;
            }

            header .navbar-icons {
                display: none;
            }

            header {
                height: 35px;
            }

            h1 {
                text-align: center;
                font-size: 40px;
            }

            .fa-house {
                display: none;
            }

            .dropdown {
                margin-top: 27px;
            }

            .popup {
                width: 300px !important;
                height: 150px;
                margin-left: -60px !important;
            }

            .tests-popup {
                width: 300px !important;
            }

            .flash-popup {
                width: 300px !important;
            }

            .container {
                max-width: 100%;
                margin: 0 auto;
                margin-left: -20px;
            }



            header .iconz {
                display: block;

            }

            .iconz {
                margin-left: auto;
                margin-right: -20px;
                cursor: pointer;
            }

            .popup-menu a {
                display: block;
                font-size: 19px;
            }
        }
    </style>

<body>
    <header id="mainHeader">
        <img src="https://i.imgur.com/FQdzZM0.png" style="width: 50px; height: 65px;">
        <a href="#">EduCard</a>

        <div class="navbar-icons">
            <a href="#" style="font-size: 16px; margin-right:-20px;"><i class="fa-solid fa-house fa-2x"></i></a>
            <a href="recent.php" style="font-size: 16px; margin-right: 6px;"><i class="fa-solid fa-file fa-2x"></i></a>
            <div class="profile-icon">
                <i class="fa-solid fa-user fa-2x" id="profile" style=" margin-top:2px;"></i>



                <div class="dropdown">
                    <?php
                    if ($row_student) {
                        echo '<a href="13_profilepagestudent.php" style="font-size: 18px;" id="profileLink">';
                        echo '<img src="' . $row_student["pic"] . '" id="dp" alt="Profile Image" />';
                        echo $row_student["full_name"];
                        echo '</a>';

                    }
                    ?>
                    <a href="14_editprofile.php" style="margin-bottom: 30px; font-size: 20px;">Settings</a>
                    <a href="#" style="font-size: 20px;" id="logout">Logout</a>
                </div>
            </div>
        </div>

        
        <a href="javascript:void(0);" class="iconz" onclick="togglePopup()" id="menuIcon">
            <i class="fa-solid fa-bars"></i>
        </a>

        <div id="myPopups" class="popup-menu">
            <a href="9.php">Dashboard</a>
            <a href="recent.php">Subject Lessons</a>
            <a href="13_profilepagestudent.php">Profile</a>
            <a href="3 teacher portal or student portal">Logout</a>

        </div>
    </header>

    <h1 style="margin: 30px 30px 20px;">LIBRARY</h1>
    <div class="container2">

    </div>

    <div class="container">
        <div class="box" style="background-color:#D4FF9C;" id="science">
            <h2 style="padding: 5px 20px;">Science</h2>
            <img src="https://i.imgur.com/LVPvnQc.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#EEC781;" id="filipino">
            <h2 style="padding: 5px 20px;">Filipino</h2>
            <img src="https://i.imgur.com/69OCIwu.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#C68CE1;" id="english">
            <h2 style="padding: 5px 20px;">English</h2>
            <img src="https://i.imgur.com/xInMmdw.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#EE8080;" id="math">
            <h2 style="padding: 5px 20px;">Math</h2>
            <img src="https://i.imgur.com/CvV73H4.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>








    </div>

    <div class="popup">
        <div class="popup-content">
            <button class="flash"><img src="https://i.imgur.com/ifqDDg6.png" class="icon">Flashcards</button>
            <button class="test"><img src="https://i.imgur.com/2CveZhZ.jpg" class="icon">Test</button>
        </div>

        <div class="flash-popup">
            <div class="popup-content">
                <button class="flash" onclick="createFlashcard()">Create</button>
                <button class="test" onclick="learnFlashcard()">Learn</button>
            </div>
        </div>

        <!-- di ko na kaya yung dalawang tab ::))-->
        <!-- dito yung mga quizzes-->
        <div class="tests-popup" style="height: 300px">
            <div class="popup-contents" id="quizButtonsContainer">
                <!-- Quiz buttons will be dynamically added here by JavaScript -->
            </div>
        </div>
    </div>







    <script>
document.addEventListener("DOMContentLoaded", function () {
            var popupMenu = document.querySelector(".popup-menu");
            var header = document.getElementById("mainHeader");


            
            var deductionAmount = 20; // Adjust this value as needed

            function adjustPopupMenuWidth() {
                
                popupMenu.style.width = header.offsetWidth - deductionAmount + "px";
            }

            
            adjustPopupMenuWidth();

            
            window.addEventListener("resize", adjustPopupMenuWidth);

            
        });

        function togglePopup() {
            var popup = document.getElementById("myPopups");
            if (popup) {
                
                popup.style.display = (popup.style.display === "block") ? "none" : "block";
            }
        }

        
        window.onclick = function (event) {
            var popup = document.getElementById("myPopup");
            if (event.target !== popup && !popup.contains(event.target)) {
                popup.style.display = "none";
            }
        }




        document.addEventListener("DOMContentLoaded", function () {
            var boxes = document.querySelectorAll(".box");
            var popup = document.querySelector(".popup");
            var flashButton = document.querySelector(".flash");
            var testButton = document.querySelector(".test");
            var flashPopup = document.querySelector(".flash-popup");
            var testPopup = document.querySelector(".test-popup");
            var testsPopup = document.querySelector(".tests-popup");

            var boxButtons = document.querySelectorAll(".box button");


            function updateQuizNumbers(subject) {
                fetch('update_quiz_numbers.php', {
                    method: 'POST',
                    body: new URLSearchParams({ subject: subject }),
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        var quizButtonsContainer = document.querySelector("#quizButtonsContainer");
                        quizButtonsContainer.innerHTML = ""; 

                        if (data.length > 0) {
                            
                            data.forEach(quiz => {
                                var button = document.createElement("button");
                                button.className = "learn";
                                button.textContent = "Quiz: " + quiz.quiz_title; 
                                button.addEventListener("click", function () {
                                    redirectToQuiz(quiz.quiz_number);
                                });
                                quizButtonsContainer.appendChild(button);
                                quizButtonsContainer.appendChild(document.createElement("br"));
                            });
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }





            boxes.forEach(function (box) {
                box.addEventListener("click", function (event) {
                    var boxRect = box.getBoundingClientRect();
                    var boxTop = boxRect.top + window.pageYOffset;
                    var boxLeft = boxRect.left + window.pageXOffset;
                    var boxWidth = boxRect.width;

                    popup.style.top = boxTop + box.offsetHeight + "px";
                    popup.style.left = boxLeft + "px";
                    popup.style.width = boxWidth + "px";
                    popup.style.display = "block";

                    var subject = box.querySelector("h2").textContent.trim().toLowerCase();

                    updateQuizNumbers(subject);
                    customizePopup(subject);

                    var formData = new FormData();
                    formData.append('subject', subject);

                    fetch('update_quiz_numbers.php', {
                        method: 'POST',
                        body: formData
                    })
                        .then(response => response.json())
                        .then(data => {
                            
                        })
                        .catch(error => console.error('Error:', error));

                    event.stopPropagation();
                });
            });

            
            document.addEventListener("click", function () {
                
                popup.style.display = "none";
                flashPopup.style.display = "none";
                testPopup.style.display = "none";
                testsPopup.style.display = "none";
            });

            // for flashcard button
            flashButton.addEventListener("click", function (event) {
                // shows the flashcard box
                flashPopup.style.display = "block";
                testsPopup.style.display = "none"; // Hide the tests popup

                event.stopPropagation();
            });

            // for test button
            testButton.addEventListener("click", function (event) {
                // shows the tests popup
                testsPopup.style.display = "block";
                flashPopup.style.display = "none"; // Hide the flashcard popup

                event.stopPropagation();
            });

            // for learn button inside flash popup


            // for learn button inside tests popup
            var learnButtonTests = testsPopup.querySelector(".learn");
            learnButtonTests.addEventListener("click", function (event) {
                // shows the learn popup
                var learnPopup = document.querySelector(".test-popup");

                learnPopup.style.display = "block";
                event.stopPropagation();
            });
        });



        function customizePopup(subject) {


            var createFlashcardButton = document.querySelector(".flash-popup .flash");
            createFlashcardButton.setAttribute("onclick", "createFlashcard('" + subject.toLowerCase() + "')");

            var learnFlashcardButton = document.querySelector(".flash-popup .test");
            learnFlashcardButton.setAttribute("onclick", "learnFlashcard('" + subject.toLowerCase() + "')");
        }

        function createFlashcard(subject) {
            var pageMapping = {
                'science': 'science/science create.php',
                'filipino': 'filipino/filipino create.php',
                'english': 'english/english create.php',
                'math': 'math/math create.php',
            };
            var subjectFile = pageMapping[subject.toLowerCase()];

            if (subjectFile) {
                window.location.href = subjectFile;
            } else {
                console.error('Page not found for subject: ' + subject);
            }
        }

        function learnFlashcard(subject) {
            var pageMapping = {
                'science': 'science/10 flashcard prev.php',
                'filipino': 'filipino/10 flashcard prev.php',
                'english': 'english/10 flashcard prev.php',
                'math': 'math/10 flashcard prev.php',
            };
            var subjectFile = pageMapping[subject.toLowerCase()];

            if (subjectFile) {
                window.location.href = subjectFile;
            } else {
                console.error('Page not found for subject: ' + subject);
            }
        }

        document.getElementById("logout").addEventListener("click", function () {
            window.location.href = "3 teacher portal or student portal.php";
        });



        function redirectToQuiz(quizNumber) {
            
            var subject;
            if (quizNumber <= 9) {
                subject = 'science';
            } else if (quizNumber <= 19) {
                subject = 'filipino';
            } else if (quizNumber <= 29) {
                subject = 'english';
            } else {
                subject = 'math';
            }

            
            var pageMapping = {
                'science': 'science/science_quiz.php',
                'english': 'english/english_quiz.php',
                'math': 'math/math_quiz.php',
                'filipino': 'filipino/filipino_quiz.php',
            };
            var quizPage = pageMapping[subject];

            if (quizPage) {
                window.location.href = quizPage + '?quiz_number=' + quizNumber;
            } else {
                console.error('Page not found for subject: ' + subject);
            }
        }

    </script>
</body>

</html>