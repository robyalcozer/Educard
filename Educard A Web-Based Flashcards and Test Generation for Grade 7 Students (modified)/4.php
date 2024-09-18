<?php
session_start();
include "shared/string_functions.php";
include "shared/connect.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCard: Student Login</title>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Mooli&family=Playfair+Display&family=Roboto+Condensed&family=Roboto:wght@400;500&display=swap');

        body {
            background-color: #FFF8EC;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .peep {
            width: 45%;
            height: auto;
            float: left;
            padding: 0 10px 60px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 0 150px;
        }

        .edu {
            width: 70%;
            height: auto;
            padding: 0 50px;
            justify-content: center;
            align-items: center;
            margin-bottom: -30px;
            margin-left : -47px;
        }

        .login {
            display: flex;
            flex-direction: column;
            row-gap: 14px;
            justify-content: center;
            align-items: center;
        }

        .btns,
        .btnss,
        .btnsss {
            width: 350px;
            height: 40px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-family: 'Inclusive Sans', 'Mali', 'Mooli', 'Roboto', 'Roboto Condensed', sans-serif;
            font-size: 18px;
        }

        .btns img,
        .btnss img,
        .btnsss img {
            height: auto;
            width: 7%;
            padding: 0px 15px;
            margin: -5px;
            vertical-align: middle;
        }

        .btnss img {
            width: 8%;
            padding: 0px 12px;
        }

        .btnsss {
            background-color: #456490;
        }

        .btnss {
            background-color: #CECCCA;
        }

        .btns {
            background-color: #C3D9F4;
        }

        p {
            font-family: 'Inclusive Sans', sans-serif;
            font-family: 'Mali';
            font-family: 'Mooli', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 18px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        h2 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 4px;
            font-size: 36px;
        }

        h3 {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        input {
            height: 41px;
            width: 330px;
            border-radius: 12px;
            border: none;
            background-color: #A5B1C0;
            margin: 15px 0 0;
            padding: 3px;
        }

        a {
            text-decoration: none;
            color: #0073ff;
        }

        .logins {
            height: 30px;
            width: 90px;
            border: none;
            border-radius: 12px;
            background-color: #17407A;
            color: white;
            font-family: 'Inclusive Sans', sans-serif;
            font-family: 'Mali';
            font-family: 'Mooli', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
        .peep {
            display: none;
        }

        .container {
            padding-bottom: 50px;
        }

        .login {
            padding: 0 20px; 
        }

        .btns,
        .btnss,
        .btnsss {
            width: 100%; 
        }

        body {
            margin-top: -60px;
        }
    }
    </style>
    <?php 
        function incorrectInput() {
            echo"<style>
                    input {
                        border: 1px solid red;
                    }
                </style>";
        }
    ?>
</head>

<body>
    <img src="https://i.imgur.com/xOA1Ujj.png" class="peep" alt="login">
    <div class="container">
        <img src="https://i.imgur.com/FAFZ1TT.png" class="edu" alt="edu">

        <h2>Login</h2>
        <h3>Student Login</h3>

        <form class="login" method="POST" autocomplete="off">
            <input required="" type="text" id="username" name="username" placeholder="Username" minlength="3" maxlength="16">
            <input required="" type="password" id="password" name="password" placeholder="Password">
            <p id="errorMessage"></p>

            <!--<a href="#">Forgot your password?</a>-->

            <!-- <button class="logins" type="submit">Login</button> -->
            <input class="logins" id="submit" name="submit" type="submit" value="Login">

           <!--<p>or</p>-->

            <!--<button class="btns">
                <img src="https://i.imgur.com/3sFL0YC.png" alt="Facebook icon">
                Login with Facebook
            </button>

            <button class="btnss">
                <img src="https://i.imgur.com/iRtb7D6.png" alt="Gmail icon">
                Login with Gmail
            </button>-->

            <a href="7_student_signup.php">Don't you have an account? Create your account</a>
        </form>


    </div>
    <?php 
       function redirect($username) {
        $_SESSION['username'] = $username;
        echo "
        <script>
        var popup = document.createElement('div');
        popup.className = 'popup';
        popup.innerText = 'Login Successful';

        // Find the password input element
        var passwordInput = document.getElementById('password');

        // Append the popup below the password input
        passwordInput.parentNode.insertBefore(popup, passwordInput.nextSibling);

        // Fade out the popup after 2 seconds
        setTimeout(function() {
            popup.style.opacity = 0;
            setTimeout(function() {
                document.body.removeChild(popup);
            }, 1000);
        }, 2000);

        // Redirect after 2 seconds
        setTimeout(function() {
            window.location.replace('9.php');
        }, 2000);
    </script>";
    }

        function errorMessage() {
            echo'
                <script>
                document.getElementById("errorMessage").innerText = "Incorrect Username or Password";
                document.getElementById("errorMessage").style.color = "red";
                </script>
            ';
        }
    ?>
</body>



</html>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);

        $sql = "SELECT username, password FROM student_acc WHERE username='$username' AND password='$password'";
        
        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) == 1) {
            redirect($username);
        } else {
            incorrectInput();
            errorMessage();
        }
    } 

    mysqli_close($conn);

?>

