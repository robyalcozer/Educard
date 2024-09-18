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
?>

<?php
if (isset($_POST["lesson_number"])) {
    $lesson_number = $_POST["lesson_number"];
    $term = $_POST["term"];
    $definition = $_POST["definition"];

    $insertquery = "INSERT INTO filipino(lesson_number, term, definition, added_by) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertquery);
mysqli_stmt_bind_param($stmt, "ssss", $lesson_number, $term, $definition, $username);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

}

if (isset($_POST['delete'])) {

    $lessonNumberToDelete = mysqli_real_escape_string($conn, $_POST['delete_lesson_number']);
    $termToDelete = mysqli_real_escape_string($conn, $_POST['delete_term']);
    $definitionToDelete = mysqli_real_escape_string($conn, $_POST['delete_definition']);


    $deleteQuery = "DELETE FROM filipino WHERE lesson_number = '$lessonNumberToDelete' AND term = '$termToDelete' AND definition = '$definitionToDelete'";
    mysqli_query($conn, $deleteQuery);


    header("Location: " . $_SERVER['PHP_SELF']);
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
        <title>Create: filipino Flashcard</title>
        <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">
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
            display: flex;
            gap: 50px;
            cursor: pointer;
            margin-left: auto;
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
            margin: 10px 55px 5px;
            color: white;
            font-size: 21px;
        }

        label {
            margin: 10px 80px 5px;
            font-size: 30px;
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

        .card {
            position: relative;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 2);
            padding: 20px;
            width: 320px;
            height: 95%;
            margin-left: 20px;
            max-width: 80%;
            background-color: white;
        }


        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 30px;
        }

        .term {
            font-size: 26px;
            font-weight: 540;
            border-bottom: 2px solid;
            margin-top: -20px;
        }

        .definition {
            margin-top: 30px;
            font-size: 18px;
        }

        .delete {
            position: absolute;
            top: -10px;

            right: -35px;

            background-color: red;
            color: white;
            font-size: 20px;
            width: 25px;
            height: 25px;
            transition: transform 0.3s ease-in-out;
        }

        .delete:hover {
            transform: scale(1.4);

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
         header {
             width: 85%;
         }
            label {
                font-size: 30px;
            }

            input {
                width: 75% !important;
            }

            .term {
                font-size: 20px;
            }

            .definition {
                margin-top: 15px;

                font-size: 16px;
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
            <a href="../3 teacher portal or student portal.php" id="logouts">Logout</a>
        </div>
    </header>

    <h1 style="margin: 10px; color: #41618F; margin: 10px 35px 5px;">Create your own set</h1>


    <div class="container">
        <form method="POST">

            <label for="lesson_number">Lesson #</label><br>
            <input type="number" id="lesson_number" name="lesson_number" required style="width: 68%; height: 45px;"> <br>

            <label for="term">Terms</label><br>
            <input type="text" id="term" name="term" required style="width: 88%; height: 45px;"><br>

            <label for="definition">Definition</label><br>
            <input type="text" id="definition" name="definition" required style=" width: 1000px; height: 150px;"
                max="95"><br>

            <button type="submit" name="create">Create</button>

        </form>


        <div class="card-container">
            <?php

            $sql_select = "SELECT term, definition, lesson_number FROM filipino WHERE added_by = '$username'";
            $result_select = mysqli_query($conn, $sql_select);


            if ($result_select && mysqli_num_rows($result_select) > 0) {

                while ($row_select = mysqli_fetch_assoc($result_select)) {
                    ?>
                    <div class="card">

                        <div class="term">
                            <form method="POST">
                                <input type="hidden" name="delete_lesson_number"
                                    value="<?php echo $row_select['lesson_number']; ?>">
                                <input type="hidden" name="delete_term" value="<?php echo $row_select['term']; ?>">
                                <input type="hidden" name="delete_definition" value="<?php echo $row_select['definition']; ?>">
                                <button type="submit" name="delete" class="delete">X</button>
                            </form>
                            <?php echo "Lesson #" . $row_select['lesson_number']; ?><br>

                            <?php echo $row_select['term']; ?>
                            <button style="width: 40px; font-size: 16px;" onclick="speakText('<?php echo $row_select['term']; ?>', '<?php echo $row_select['definition']; ?>')">
                            <i class="fa-solid fa-volume-high"></i>
    </button>


                        </div>
                        <div class="definition">

                            <?php echo $row_select['definition']; ?>
                        </div>



                    </div>
                    <?php
                }
            }
            ?>
        </div>



        <script>
             document.getElementById("logouts").addEventListener("click", function () {
                window.location.href = "3 teacher portal or student portal.php";
            });
            
 function speakText(term, definition) {
        var textToSpeak = term + '. ' + definition;
        var utterance = new SpeechSynthesisUtterance(textToSpeak);
        speechSynthesis.speak(utterance);
    }

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

            document.getElementById("profile").addEventListener("click", function () {
                window.location.href = "../13_profilepagestudent.php";
            });

        </script>
</body>

</html>