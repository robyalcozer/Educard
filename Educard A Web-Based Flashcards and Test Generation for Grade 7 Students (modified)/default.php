<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome: Educard</title>
    <link rel="icon" type="image/x-icon" href="https://i.imgur.com/FQdzZM0.png">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Mali:ital,wght@1,500&family=Roboto:wght@500&display=swap');

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
            margin-top: -150px;
        }

        .button {
            position: relative;
            padding: 15px 26px;
            color: #fff;
            background-color: #456490;
            border: none;
            cursor: pointer;
            border-radius: 20px;
            display: block;
            margin-top: 20px;
            font-family: 'Inclusive Sans', 'Mali', 'Roboto', sans-serif;
            font-weight: normal;
            font-size: 20px;
            gap: 30px;
        }

        .icon {
            width: 18px;
            height: 18px;
            transition: all 0.3s ease-in-out;
        }

        .button:hover {
            transform: scale(1.05);
            border-color: #fff9;
        }

        .button:hover .icon {
            transform: translate(4px);
        }

        .button:hover::before {
            animation: shine 1.5s ease-out infinite;
        }

        .button::before {
            content: "";
            position: absolute;
            width: 100px;
            height: 100%;
            background-image: linear-gradient(120deg,
                    rgba(255, 255, 255, 0) 30%,
                    rgba(255, 255, 255, 0.8),
                    rgba(255, 255, 255, 0) 70%);
            top: 0;
            left: -100px;
            opacity: 0.6;
        }

        @keyframes shine {
            0% {
                left: -100px;
            }

            60% {
                left: 100%;
            }

            to {
                left: 100%;
            }
        }

        @media (max-width: 768px) {
            .button {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .button {
                width: 70%;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="https://i.imgur.com/R97a7Sg.png" alt="Logo">
        <button onclick="redirectToPage()" class="button">Get Started
            <svg fill="currentColor" viewBox="0 0 24 24" class="icon">
                <path clip-rule="evenodd"
                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm4.28 10.28a.75.75 0 000-1.06l-3-3a.75.75 0 10-1.06 1.06l1.72 1.72H8.25a.75.75 0 000 1.5h5.69l-1.72 1.72a.75.75 0 101.06 1.06l3-3z"
                    fill-rule="evenodd"></path>
            </svg>
        </button>
    </div>
</body>

<script>
    function redirectToPage() {
        window.location.href = '3 teacher portal or student portal.php';
    }
</script>

</html>