<?php
include "shared/string_functions.php";
include "shared/connect.php";
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCard: Registration</title>

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
            padding: 0 50px 40px;
            justify-content: center;
            align-items: center;
            margin-bottom: -30px;
            margin-left : -56px;
        }

        .reg {
            display: flex;
            flex-direction: column;
            row-gap: 14px;
            justify-content: center;
            align-items: center;
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
            font-size: 30px;
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
            margin: 1px 0 0;
            padding: 3px;
        }

        a {
            text-decoration: none;
            color: #0073ff;
        }

        .register {
            height: 45px;
            width: 200px;
            border: none;
            border-radius: 20px;
            background-color: #17407A;
            color: white;
            font-family: 'Inclusive Sans', sans-serif;
            font-family: 'Mali';
            font-family: 'Mooli', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 22px;
            cursor: pointer;
        }

        @media only screen and (max-width: 600px) {
        .peep {
            display: none;
        }

        .container {
            padding-bottom: 50px;
        }

        .reg {
            padding: 0 20px; 
        }

        .btns,
        .btnss,
        .btnsss {
            width: 100%; 
        }
    }


    </style>
    <?php 
        function incorrectInput() {
            echo"<style>
                    #password, #passwords {
                        border: 1px solid red;
                    }
                </style>";
        }

        function duplicateCredentials() {
            echo"<style>
                    #email, #username {
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

        <h2>Create account!</h2>


        <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="reg" method="POST" autocomplete="off">
            <input required="" type="text" id="fullname" name="fullname" placeholder="Full Name" minlength="6" maxlength="55">
            <input required="" type="text" id="username" name="username" placeholder="Username" minlength="6" maxlength="16">
            <input required="" type="email" id="email" name="email" placeholder="Email">
            <p id="takenUserOrEmail"></p>
            <input required="" type="password" id="password" name="password" placeholder="Password">
            <input required="" type="password" id="passwords" name="passwords" placeholder="Confirm Password">
            <p id="errorMessage"></p>
            <button class="register" type="submit">Register</button>
            <a href="5.php">Already have an account?</a>
        </form>


    </div>
    <?php
        function redirect() {
            echo"<script>window.location.replace('5.php');</script>";
        }

        function errorMessage() {
            echo'
                <script>
                document.getElementById("errorMessage").innerText = "Passwords do not match";
                document.getElementById("errorMessage").style.color = "red";
                </script>
            ';
        }

        function takenUserOrEmail() {
            echo'
                <script>
                document.getElementById("takenUserOrEmail").innerText = "Username or email is already taken";
                document.getElementById("takenUserOrEmail").style.color = "red";
                </script>
            ';
        }
    ?>
</body>

</html>
<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fullName = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
        $userName = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
        $student_id = filter_input(INPUT_POST, "student_id", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "passwords", FILTER_SANITIZE_SPECIAL_CHARS);
        
        /* $hash = password_hash($password, PASSWORD_DEFAULT); */
        /* tanggalin ko muna hash while working with passwords */

        if ($password == $confirmPassword) {
            $sql = "INSERT INTO teacher_acc (full_name, email, username, password, student_id)
                    VALUES ('$fullName', '$email', '$userName', '$password', '$student_id')";
            try{
                mysqli_query($conn, $sql);
                redirect();
            }
            catch(mysqli_sql_exception){
                duplicateCredentials();
                takenUserOrEmail();
            }  
        } else {
            incorrectInput();
            errorMessage();
        }
    }

    mysqli_close($conn);
?>