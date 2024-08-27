<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'register_handler.php';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>

       body {

            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-image: url("images/bg.jpg");
        }
        .register-cont {
            width: 350px;
            padding: 50px;
            background-color: #165A72;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .register-cont h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #17A589;
        }
        .register-cont p{
            font-size: 10px;
        }
        .register-cont form {
            display: flex;
            flex-direction: column;
        }
        .register-cont form label {
            margin-bottom: 5px;

        }
        .register-cont form label[type="checkbox"]{
            margin:0;
        }
        .register-cont form input[type="text"],
        .register-cont form input[type="password"] {
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 3px;
            background-color: #E6FAF6;
            border: 1px solid #9BA4B5;
            font: 1px;
            color: #0C231F;
        }
        .register-cont form input[type="submit"] {
            padding: 10px 12px;
            margin-top: 10px;
            background-color: #17A589;
            color: #E6FAF6;
            border: 1px solid #9BA4B5;
            cursor: pointer;

        }
        .register-cont form input[type="submit"]:hover {
            background-color: #1EDFB9;
        }
        #loading-screen {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: #f9f9f9;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 9999;
      opacity: 1;
      transition: opacity 0.5s ease-in-out;
    }

    #loading-screen.hide {
      opacity: 0;
      pointer-events: none;
    }

    .loading-icon {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      border: 3px solid #333;
      border-top-color: #08c;
      animation: spin 1s infinite linear;
    }
    .show-password-container {
    display: flex;
    align-items: center;
    }
    .show-password-container input[type="checkbox"] {
    margin-right: 5px;
    }

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    </style>
    </style>
</head>
<body>
    <div class="register-cont">
        <h2>Register</h2>
        <form action="" method="post">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
             <div class="show-password-container">
            <input type="checkbox" id="show-password" onchange="togglePasswordVisibility()">
            <label for="show-password" style="color: #E6FAF6; font-size: 0.8rem;">Show password</label>
                </div>
            <input type="submit" value="Register" name="register">
            <a href="javascript:history.back()" style="color:#1EDFB9;
            background-color:transparent;border:none; text-align: right; font-size:0.9rem; padding-top: 10px; text-decoration: none;">Back</a>
        </div>
        </form>
    </div>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var showPasswordCheckbox = document.getElementById('show-password');

            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
    </script>
</body>

</html>
