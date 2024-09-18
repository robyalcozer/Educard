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
            padding: 0 20px 100px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 0 150px;
        }

        .edu {
            width: 55%;
            height: auto;
            padding: 0 20px -60px;
            justify-content: center;
            align-items: center;
            margin-top: 130px;
            margin-left: -56px;
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
            margin: 0;
            font-size: 30px;
            padding: 0 0 20px;
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
            margin: 1px 0 15px;
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

        .check {
            height: 20px;
            width: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        .checkbox-label {
            font-family: 'Inclusive Sans', sans-serif;
            font-family: 'Mali';
            font-family: 'Mooli', sans-serif;
            font-family: 'Roboto', sans-serif;
            font-family: 'Roboto Condensed', sans-serif;
            font-size: 15px;
            margin-left: 5px;
            display: inline-block;
            vertical-align: middle;
        }
        
         @media only screen and (max-width: 480px) {
             .edu {
                 display:none;
             }
             
             
         }
         

        @media only screen and (max-width: 600px) {
            body {
                margin-top: 40px;
            }
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
                    #email, #username, #idnumber {
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


        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="reg" method="POST" autocomplete="off" enctype="multipart/form-data">
            <input required="" type="text" id="name" name="fullname" placeholder="Full Name" minlength="6" maxlength="50">
            <input required="" type="text" id="username" name="username" placeholder="Username" minlength="6" maxlength="16">
            <input required="" type="number" id="idnumber" name="idcardno" placeholder="Student ID Number">
            <input required="" type="email" id="email" name="email" placeholder="Email">
            <p id="takenUserOrEmail"></p>
            <input required="" type="password" id="password" name="password" placeholder="Password">
            <input required="" type="password" id="passwords" name="passwords" placeholder="Confirm Password">

            <div>
                <!--<input required="" type="checkbox" class="check" id="checkage" name="checkage">
                <label for="checkage" class="checkbox-label">You confirm that you're 18 or older or giving this
                    <br>consent
                    on behalf of an individual
                    below 18 years<br> old. Further, you confirm that you can legally provide<br> this consent under
                    applicable
                    laws
                    and regulations.</label>-->
            </div>
            <div>
                <input required="" type="checkbox" class="check" id="checktos">
                <label for="checktos" class="checkbox-label">You have read, understood, and agree to ourTerms<br> and
                    Privacy Policy.</label>
            </div>

            <button class="register" type="submit">Register</button>
            <a href="4.php">Already have an account?</a>
        </form>


    </div>
    <?php
        function redirect() {
            echo"<script>window.location.replace('4.php');</script>";
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
                document.getElementById("takenUserOrEmail").innerText = "Username or email or Student ID Number is already taken";
                document.getElementById("takenUserOrEmail").style.color = "red";
                </script>
            ';
        }
    ?>
</body>

</html>
<?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = filter_input(INPUT_POST, "fullname", FILTER_SANITIZE_SPECIAL_CHARS);
    $userName = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, "passwords", FILTER_SANITIZE_SPECIAL_CHARS);
    $id_card_no = filter_input(INPUT_POST, "idcardno", FILTER_SANITIZE_SPECIAL_CHARS);

    
   if ($password == $confirmPassword) {
    
    if ($_FILES['profile_image']['name']) {
        // If a file is uploaded, process it as usual
        $pic = $_FILES['profile_image']['name'];
        $pic_tmp = $_FILES['profile_image']['tmp_name'];
        $pic_folder = "uploads/" . $pic;

        
        if (!file_exists('uploads')) {
            mkdir('uploads', 0777, true);
        }

        
        move_uploaded_file($pic_tmp, "uploads/" . $pic);
    } else {
        
        $pic_folder = "uploads/defaultdp.jpg";
    }

    
    $sql = "INSERT INTO student_acc (full_name, email, username, password, id_card_no, pic)
            VALUES ('$fullName', '$email', '$userName', '$password', '$id_card_no', '$pic_folder')";

    try {
        mysqli_query($conn, $sql);
        redirect();
    } catch (mysqli_sql_exception) {
        
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