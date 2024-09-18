<?php
session_start();
include "shared/string_functions.php";
include "shared/connect.php";

if (!isset($_SESSION['username'])) {
    header("Location: 5.php");
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
    <title>Create: Quiz</title>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Playfair+Display:wght@500&family=Roboto+Condensed&family=Roboto:wght@400;500&display=swap');

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
            color: black;
            font-size: 40px;
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

        .activities {
            color: white;
        }

        .acticon {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-left: 10px;
        }

        .acticon img {
            width: 50px;
            height: 50px;
            border-radius: 45px;
            display: flex;



        }

        .acticon button {

            font-size: 20px;
            color: white;
            width: 300px;
            background-color: #143a6d;
            border: none;
            cursor: pointer;
        }

        h3 {
            margin-left: 35px;
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
        
        .create-account-container {
        margin-top: -110px; 
        text-decoration: none;
        margin-left: 75% !important;
    }
    
    .create {
        color: #0073ff;
                    font-size: 15px;
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
            
           .create {
               display: none;
           }
        }

        @media only screen and (max-width: 600px) {
            
            .container {
            max-width: 100%;
            margin: 0 auto;
            margin-left: -20px;
        }

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

            .popup {
                margin-left: -20%;
            }
        }
    </style>
</head>

<body>
<header id="mainHeader">
        <img src="https://i.imgur.com/FQdzZM0.png" style="width: 50px; height: 65px;">
        <a href="#">EduCard</a>
        <div class="navbar-icons">
            <a href="15_teacherlanding.php" style="font-size: 16px; margin-right:-20px;"><i
                    class="fa-solid fa-house fa-2x"></i></a>
            <a href="19_flashcardpage.php" style="font-size: 16px; "><i class="fa-solid fa-file fa-2x"></i></a>
            <div class="profile-icon">
                <i class="fa-solid fa-user fa-2x" id="profile" style="margin-top: 3px; margin-left:-20px;"></i>
                <div class="dropdown">
                    <?php
                    if ($row_student) {
                        echo '<a href="16_profilepageteacher.php" style="font-size: 18px;" id="profileLink">';
                        echo '<img src="' . $row_student["pic"] . '" id="dp" alt="Profile Image" />';
                        echo $row_student["full_name"];
                        echo '</a>';

                    } elseif ($row_teacher) {
                        echo '<a href="16_profilepageteacher.php" style="font-size: 18px;" id="profileLink">';
                        echo '<img src="' . $row_teacher["pic"] . '" id="dp" alt="Profile Image" />';
                        echo $row_teacher["full_name"];
                        echo '</a>';

                    }
                    ?>
                    <a href="17_editprofileteacher.php" style="margin-bottom: 30px; font-size: 20px;">Settings</a>
                    <a href="#" style="font-size: 20px;" id="logout">Logout</a>
                </div>
            </div>
        </div>

        <a href="javascript:void(0);" class="iconz" onclick="togglePopup()" id="menuIcon">
            <i class="fa-solid fa-bars"></i>
        </a>

        <div id="myPopups" class="popup-menu">
            <a href="15_teacherlanding.php">Create Quiz</a>
            <a href="19_flashcardpage.php">Make Flashcard Lessons</a>
            <a href="16_profilepageteacher.php">Profile</a>
            <a href="3 teacher portal or student portal.php" id="logouts">Logout</a>
        </div>

    </header>

    <h1 style="margin: 30px 30px 20px;">Create Quiz</h1>
    <div class="container2">

        <!--
        <div class="activities">
            <h2 style="margin: 20px; font-size: 30px;">Class activities</h2>
            <div class="acticon">
                <div class="acticon"><img src="https://i.imgur.com/AX0fU3R.jpg" alt=""></div>
                <h3 style="font-size:20px;">Result here</h3>
            </div>


        </div>
                -->
    </div>

    <div class="container">
        <div class="box" style="background-color:#D4FF9C;" onclick="redirectToPage('science/18_create.php');">
            <h2 style="padding: 5px 20px;">Science</h2>
            <img src="https://i.imgur.com/LVPvnQc.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#EEC781;" onclick="redirectToPage('filipino/18_create.php');">
            <h2 style="padding: 5px 20px;">Filipino</h2>
            <img src="https://i.imgur.com/69OCIwu.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#C68CE1;" onclick="redirectToPage('english/18_create.php');">
            <h2 style="padding: 5px 20px;">English</h2>
            <img src="https://i.imgur.com/LVPvnQc.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>

        <div class="box" style="background-color:#EE8080;" onclick="redirectToPage('math/18_create.php');">
            <h2 style="padding: 5px 20px;">Math</h2>
            <img src="https://i.imgur.com/CvV73H4.png"
                style="height: 80px; width: 60px; float: right; padding: 1px 20px; margin-top: -29px;">
        </div>
        </div>
<br>
<div class="create-account-container">
    <a href="6_teacher_signup.php" class="create">Create an account for teacher</a>
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
                window.location.href = "3 teacher portal or student portal.php";
            });

            document.getElementById("logouts").addEventListener("click", function () {
                window.location.href = "3 teacher portal or student portal.php";
            });

            function redirectToPage(page) {
                window.location.href = page;
            }


            function handleResultBoxClick() {
                redirectToPage("result_page.php");
            }
        </script>
</body>

</html>