<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCard: Choose Portal</title>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Roboto:wght@500&display=swap');

        .navbar {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: #17407A;
            padding: 22px 20px;
            box-shadow: 0 2px 3px rgba(14, 54, 231, 0.911);
            display: flex;
            justify-content: flex-end;
        }

        .navbar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .navbar li {
            display: inline;
            margin-right: 20px;
        }

        .navbar li:last-child {
            margin-right: 0;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }

        .navbar a:hover {
            color: #000000;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #FFF8EC;
        }

        .container {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        button {
            width: 350px;
            height: 120px;
            border-radius: 4px;
            border-style: groove;
            border-width: 1px;
            border-color: rgb(163, 163, 163);
            cursor: pointer;
            font-family: 'Inclusive Sans', 'Mali', 'Mooli', 'Roboto', 'Roboto Condensed', sans-serif;
            font-size: 18px;
            background-color: #E8E7F6;
            margin: 30px;
            border-radius: 51px;
        }

        button:hover {
            background-color: #a8a8b1;
            transition: 0.7s;
        }

        .navbar img {
            height: 56px;
            margin-right: auto;
            
        }

        @media screen and (max-width: 480px) {
            .navbar {
                height: 30px;
            }
            
            body {
               margin-top: -35px;
            }
            
            button {
                width: 300px;
                height: 100px;
            }
            
            .navbar a {
                margin-right: 15px;
                font-size: 13px;
            }
            
            #logo {
                width: 250px;
            }
            
           .navbar img {
               margin-top: -10px;
           }
        }
    </style>
</head>

<body>
<nav class="navbar">
    <img src="https://i.imgur.com/FQdzZM0.png">
        <ul>
            
            <li><a href="aboutus.php">About</a></li>
            <li><a href="contact.php" style="margin-right: 50px;">Contact</a></li>
        </ul>
    </nav>

    <div class="container">
        <img src="https://i.imgur.com/R97a7Sg.png" alt="Logo" id="logo">
        <button class="button" onclick="studentPortal()">
            <h2 style="margin: 10px; margin-top: -10px; color: #605F65;">Student Portal</h2>
            <p2 style="color: #605F65;">Sign in or create your own account</p2>
        </button>
        
        <button class="button" onclick="teacherPortal()">
            <h2 style="margin: 10px; margin-top: -10px; color: #605F65;">Teacher Portal</h2>
            <p2 style="color: #605F65;">Access your teacher or admin account</p2>
        </button>
        
    </div>

    <script>
        function teacherPortal() {
            window.location.href = '5.php';
        }

        function studentPortal() {
            window.location.href = '4.php';
        }
    </script>
</body>

</html>
