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

$sql_select = "SELECT term, definition, lesson_number FROM science WHERE added_by = '$username'";
$result_science = mysqli_query($conn, $sql_select);

$science_data = mysqli_fetch_all($result_science, MYSQLI_ASSOC);

$totalPages = count($science_data);


?>
<?php
$currentPage = 0;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>View: Science Flashcard</title>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Mooli&family=Roboto+Condensed&family=Roboto:wght@500&display=swap');

        body {
            margin: 0;
            overflow-x: hidden;
            overflow-y: none;
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

        h1 {
            color: #143a6d;
            font-size: 50px;
            margin: 25px;
        }

        button {
            width: 700px;
            height: 70px;
            border-radius: 200px;
            border: none;
            margin: 10px 250px;
        }

        .term {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 70.3%;
            height: 440px;
            background-color: #E9F5F9;
            margin: 0 auto;
            margin-top: 5px;
        }

        .term h1 {
            text-align: center;
            font-size: 100px;
        }

        button {
            width: 70.3%;
            height: 70px;
            background-color: #408DF0;
            margin-left: auto;
            margin-right: auto;
            cursor: pointer;
            border-radius: 0;
            font-size: 25px;
            color: white;
        }

        .button-container {
            display: flex;
            justify-content: center;
        }

        .popup {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;

        }

        .popup-content {
            width: 100%;
            height: 100%;
            max-width: 1000px;
            max-height: 500px;
            background-color: #E9F5F9;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            font-size: 25px;
            margin-bottom: 30px;

        }


        .popup-close {
            position: absolute;
            top: 10px;
            right: 10px;
            color: #000000;
            cursor: pointer;
            font-size: 60px;

        }

        .buttons {
            width: 200px;
            height: 70px;
            background-color: #408DF0;
            cursor: pointer;
            border-radius: 0;
            font-size: 25px;
            color: white;
            border-radius: 30px;

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

            h1.term {
                font-size: 60px !important;
            }

            .term {
                height: 300px !important;
                width: 85% !important; 
            }

            button#def {
                width: 85% !important;
            }

            .buttons {
                width: 30% !important;
                height: 50px !important;
                font-size: 1em !important;
            }
            
            .popup-content {
                width: 90%;
                text-align: center;
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
        
            h1 {
                font-size: 48px
            }

            h1.term {
                font-size: 55px;
            }

            .term {
                height: 350px;
                width: 88%;
            }

            button#def {
                width: 88%;
                font-size: 20px;
                height: 60px;
            }

            .buttons {
                width: 29%;
                height: 50px;
                font-size: 1em;
            }
        }
    </style>
</head>

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
                        echo $row_student["full_name"] ;
                        echo '</a> ';
                    }
                    ?>

                    <a href="../14_editprofile.php" style="margin-bottom: 30px; font-size: 20px;">Settings</a>
                    <a href="../3 teacher portal or student portal.php" style="font-size: 20px;" id="logout">Logout</a>
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
           <a href="../3 teacher portal or student portal.php" id="logouts">Logout</a>
        </div>
    </header>

    <h1>
        Science
    </h1>

    <!--<button><a href=""></a><a href=""></a><a href=""></a></button>-->

    <div class="term">
        <h1 class="term h1"></h1>
    </div>
    <div class="button-container">
        <button onclick="openPopup()" id="def">Click here to see definition</button>
    </div>

    <div class="popup" id="popup">
        <div class="popup-content">
            <div class="popup-close" onclick="closePopup()">&times;</div>
            <div id="popup-content"></div>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <button class="buttons" onclick="previousPage()">Previous</button>
        <p id="currentPage" style="font-size: 18px; margin: 0;">Page 1 / Page</p>
        <button class="buttons" onclick="nextPage()">Next</button>
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

        var totalPages = <?php echo $totalPages; ?>;
        var currentPage = <?php echo $currentPage; ?>;
        var scienceData = <?php echo json_encode($science_data); ?>;

        function updateContent() {
            var currentPageText = document.getElementById('currentPage');
            currentPageText.textContent = "" + (currentPage + 1) + " / " + totalPages;

            var term = document.querySelector('.term h1');
            term.textContent = scienceData[currentPage]['term'];

            var popupContent = document.getElementById('popup-content');
            popupContent.textContent = scienceData[currentPage]['definition'];
        }

        function openPopup() {
            document.getElementById('popup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
        }

        function nextPage() {
            currentPage = (currentPage + 1) % totalPages;
            updateContent();
        }

        function previousPage() {
            currentPage = (currentPage - 1 + totalPages) % totalPages;
            updateContent();
        }

        updateContent();

        document.getElementById("homeIcon").addEventListener("click", function () {
            window.location.href = "../9.php";
        });

        document.getElementById("logout").addEventListener("click", function () {
            window.location.href = "../3 teacher portal or student portal.php";
        });
    </script>
</body>

</html>