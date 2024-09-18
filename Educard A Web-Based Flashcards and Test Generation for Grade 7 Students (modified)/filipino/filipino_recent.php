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


$teacher_name = "";

if ($row_teacher) {
    $sql_teacher_info = "SELECT full_name FROM teacher_acc WHERE username = '$username'";
    $result_teacher_info = mysqli_query($conn, $sql_teacher_info);
    $row_teacher_info = mysqli_fetch_assoc($result_teacher_info);

    $teacher_name = $row_teacher_info['full_name'];
}


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

    <title>Lessons: Filipino</title>
    <style>

    </style>
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

    .term {
        width: 123px;
        height: 35px;
        background-color: #1A3C6B;
        color: white;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 15px;
        border-radius: 20px;
        margin: 20px;
    }

    .box {
        cursor: pointer;
        margin: 20px;
        padding: 10px;
        border: 0;
        background-color: #D1D8F7;
        border-radius: 14px;
        display: flex;
        flex-direction: column;
        width: 30%;
        box-sizing: border-box;
    }

    .content-container {
        display: flex;
        align-items: center;
    }

    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .box img {
        width: 40px;
        height: 40px;
        border-radius: 65px;
        margin-bottom: 5px;
        margin-right: 10px;
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

    .popup-menu a {
        color: white;
        padding: 12px 16px;
        display: none;
        text-decoration: none;
    }

    @media only screen and (max-width: 480px) {

        .iconz {
            margin-left: auto;
            margin-right: -20px;
            cursor: pointer;
        }


        .popup-menu a {
            display: block;
        }

        .container {
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 20px;
        }



        .term {
            width: 95px;
        }

        .box {
            width: calc(80% - 40px) !important;
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
        }

        .box {
            width: calc(50% - 40px);
        }
    }
</style>

<body>
    <header id="mainHeader">

        <img src="https://i.imgur.com/FQdzZM0.png" style="width: 50px; height: 65px;">
        <a href="#">EduCard</a>
        <div class="navbar-icons">

            <a href="../9.php" style="font-size: 16px; margin-right:-20px;"><i class="fa-solid fa-house fa-2x"></i></a>
            <a href="../recent.php" style="font-size: 16px; margin-right: 6px;"><i
                    class="fa-solid fa-file fa-2x"></i></a>
            <div class="profile-icon">
                <i class="fa-solid fa-user fa-2x" id="profile" style=" margin-top:2px;"></i>



                <div class="dropdown">
                    <?php
                    if ($row_student) {
                        echo '<a href="../13_profilepagestudent.php" style="font-size: 18px;" id="profileLink">';

                        echo $row_student["full_name"];
                        echo '</a>';



                    }
                    ?>
                    <a href="../14_editprofile.php" style="margin-bottom: 30px; font-size: 20px;">Settings</a>
                    <a href="#" style="font-size: 20px;" id="logout">Logout</a>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="iconz" onclick="togglePopup()" id="menuIcon">
            <i class="fa-solid fa-bars"></i>
        </a>

        <div id="myPopups" class="popup-menu">
            <a href="../9.php">Dashboard</a>
            <a href="../recent.php">Subject Lessons</a>
            <a href="../13_profilepagestudent.php">Profile</a>
            <a href="../3 teacher portal or student portal.php">Logout</a>
        </div>

    </header>

    <h1 style="margin: 30px 30px 20px;">Filipino: Lessons</h1>


    <div class="container">
        <?php

        $tables = array(
            'filipino' => 'filipino_teacher',
        );

        $processedLessonNumbers = array();


        $sql_lessons = "SELECT lesson_number, subject FROM filipino_teacher";
        $result_lessons = mysqli_query($conn, $sql_lessons);

        while ($row_lesson = mysqli_fetch_assoc($result_lessons)) {
            $lesson_number = $row_lesson['lesson_number'];
            $subject = $row_lesson['subject'];


            if (!isset($processedLessonNumbers[$lesson_number])) {

                $processedLessonNumbers[$lesson_number] = true;


                $total_terms = 0;

                foreach ($tables as $subjectKey => $table) {
                    $sql_total_terms = "SELECT COUNT(*) as total_terms FROM $table WHERE lesson_number = '$lesson_number'";
                    $result_total_terms = mysqli_query($conn, $sql_total_terms);
                    $row_total_terms = mysqli_fetch_assoc($result_total_terms);
                    $total_terms += $row_total_terms['total_terms'];
                }
                ?>
                <button class="box" onclick="redirectToFlashcardPage(<?php echo $lesson_number; ?>)">
                    <h2>
                        <?php echo $subject . ' - Lesson: ' . $lesson_number; ?>
                    </h2>
                    <div class="term">
                        <?php echo $total_terms . ' Terms'; ?>
                    </div>
                    <div class="content-container">

                    </div>
                </button>
                <?php
            }
        }
        ?>
    </div>




    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var popupMenu = document.querySelector(".popup-menu");
            var header = document.getElementById("mainHeader");


            var deductionAmount = 20;

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



        document.getElementById("logout").addEventListener("click", function () {
            window.location.href = "../3 teacher portal or student portal.php";
        });


        function redirectToFlashcardPage(lessonNumber) {
            window.location.href = "flashcard_teacher.php?lesson_number=" + lessonNumber;
        }
    </script>
</body>

</html>