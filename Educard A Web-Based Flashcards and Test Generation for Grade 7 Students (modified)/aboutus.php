<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EduCard: About us</title>
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

        h1 {
            font-size: 45px;
            background-color: #17407A;
            color: #fff;
            padding: 10px;
            margin-bottom: 20px;
        }

        p {
            font-size: 30px;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto 70px;
        }

        @media screen and (max-width: 480px) {
            .navbar {
                height: 30px;
            }
            
            h1 {
                font-size: 20px;
                margin-bottom: 350px;
                margin-right: 10px;
            }

            p {
                font-size: 20px;
                height: 65vh;
            }
            
             .navbar a {
                margin-right: 15px;
                font-size: 13px;
            }
            
           .navbar img {
               margin-top: -10px;
           }



        }
    </style>
    </style>
</head>

<body>
    <nav class="navbar">
    <img src="https://i.imgur.com/FQdzZM0.png">
        <ul>
            <li><a href="3 teacher portal or student portal.php">Portal</a></li>
            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>

    <h1>About Us</h1>

    <p> Welcome to EDUCARD, where we've created a cutting-edge web-based platform dedicated to transforming the way
        flashcards and tests are used. Our commitment is to provide clear, accessible, and dynamic tools to students and
        instructors. We hope that by using EDUCARD, we can streamline the design and use of flashcards while also
        simplifying test generation, promoting an environment favorable to improved learning experiences and academic
        successes.</p>

    <script>

    </script>
</body>

</html>