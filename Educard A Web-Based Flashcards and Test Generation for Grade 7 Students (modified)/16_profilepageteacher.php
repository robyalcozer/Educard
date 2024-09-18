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

$sql_scores = "SELECT full_name, subject, quiz_number, score FROM score";

$result_scores = mysqli_query($conn, $sql_scores);
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile: Teacher</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Mooli&family=Roboto+Condensed&family=Roboto:wght@500&display=swap');

        body {
            margin: 0;
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

        .color-box {

            width: 90%;
            box-sizing: border-box;
            justify-content: center;
            align-items: center;
            display: flex;
            margin: 0 auto;
            border-radius: 6px;
        }

        .red {
            background-color: #8698B1;
            height: 30.33%;
            display: flex;
            justify-content: flex-start;
            align-items: center;

        }

        .combined-box {
            background-color: #294E83;
            height: auto;
            border-radius: 6px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 70px;
            padding: 20px;
        }

        .column {
            text-align: center;
            color: white;
            overflow-y: none;
            margin-bottom: 20px;
            font-size: 30px;
        }

        .edit {
            width: 150px;
            height: 40px;
            border-radius: 20px;
            border: 0;
            background-color: #3C5E8C;
            color: white;
            cursor: pointer;
            margin-left: 120px;
            margin-right: 30px;
            margin-top: -140px;
            font-family: 'Inclusive Sans', 'Mali', 'Mooli', 'Roboto', 'Roboto Condensed', sans-serif;
        }


        .profile-info-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .edit:hover,
        .edit:focus {
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.1) 0 4px 12px;
            color: rgba(0, 0, 0, 0.65);
        }

        .edit:hover {
            transform: translateY(-1px);
        }

        .edit:active {
            background-color: #F0F0F1;
            border-color: rgba(0, 0, 0, 0.15);
            box-shadow: rgba(0, 0, 0, 0.06) 0 2px 4px;
            color: rgba(0, 0, 0, 0.65);
            transform: translateY(0);
        }

        h2 {
            font-size: 45px;
        }

        p {
            font-size: 35px;
        }

        .picx {
            width: 200px;
            border-radius: 100px;
            height: 200px;
            margin-left: 30px;
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

        .create {

            text-decoration: none;
            color: #0073ff;

        }

        @media screen and (max-width: 480px) {

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
                font-size: 27px !important;
            }

            img#profileImage {
                margin-top: 2%;
                width: 100px !important;
                height: 100px !important;
                margin-right: -35%;
            }

            .red {
                height: 150px;
            }

            .profile-info-container h1 {
                font-size: 15px !important;
                margin-top: -10%;
                margin-left: -8%;
                line-height: 1.5;
            }

            .edit {
                width: 25%;
                margin-left: -90%;
                margin-top: 15%;
                font-size: 13px;
                height: 29px;
            }

            h2 {
                font-size: 17px;
            }

            .column {
                font-size: 18px !important;
            }

            .combined-box {
                grid-gap: 25px !important;
            }

            .iconz {
                margin-left: auto;
                margin-right: -20px;
                cursor: pointer;
            }


            .popup-menu a {
                display: block;
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
            <a href="15_teacherlanding.php">Dashboard</a>
            <a href="19_flashcardpage.php">Subject Lessons</a>
            <a href="16_profilepageteacher.php">Profile</a>
            <a href="#" id="logouts">Logout</a>
        </div>

    </header>

    <h1>My profile</h1>


    <div class="color-box red">
        <div class="profile-info-container">
            <img id="profileImage"
                src="<?php echo isset($row_teacher['pic']) ? $row_teacher['pic'] : 'img/defaultdp.jpg'; ?>"
                style="width: 170px; border-radius: 100px; height: 170px;">
            <?php
            if ($row_teacher) {
                echo '<h1 style="font-weight: 500;">' . $row_teacher["full_name"] . '</h1>';
            }
            ?>
            <button class="edit" id="editProfile" onclick="editProfile()">Edit Profile</button>
        </div>
    </div>

    <div class="color-box combined-box">
        <?php
        while ($row_scores = mysqli_fetch_assoc($result_scores)) {
            echo '<div class="column">';
            echo '<h2> Full Name </h2>';
            echo $row_scores['full_name'];
            echo '</div>';

            echo '<div class="column">';
            echo '<h2> Subject </h2>';
            echo $row_scores['subject'];
            echo '</div>';

            echo '<div class="column">';
            echo '<h2> Quiz # </h2>';
            echo $row_scores['quiz_number'];
            echo '</div>';

            echo '<div class="column">';
            echo '<h2> Score </h2>';
            echo $row_scores['score'];
            echo '</div>';
        }
        ?>
    </div>


    <script>
        document.getElementById("logouts").addEventListener("click", function () {
            window.location.href = "3 teacher portal or student portal.php";
        });

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

        document.getElementById("editProfile").addEventListener("click", function () {
            window.location.href = "17_editprofileteacher.php";
        });



    </script>
</body>

</html>