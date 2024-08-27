<?php
// Start a session
session_start();
require_once "config.php";


// Function to create the "ledres_db" database if it doesn't exist
function createDatabase()
{
    $conn = mysqli_connect('localhost', 'root', '');
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Create the database if it doesn't exist
    $sql = "CREATE DATABASE IF NOT EXISTS ledres_db";
    if (!mysqli_query($conn, $sql)) {
        echo "Error creating database: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}

// Check if the "ledres_db" database exist
$conn = mysqli_connect('localhost', 'root', '');
if (!$conn) {
    // Database connection failed
    die("Database connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Handle the registration form submission
        // ...
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username is already taken
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error_message = 'Username already taken.';
        } else {
            // Insert the new user into the database
            $sql = "INSERT INTO users (username, password, acc_type) VALUES ('$username', '$password', 'user')";
            if (mysqli_query($conn, $sql)) {
                // Registration successful, redirect to the login page
                header('Location: login.php');
                exit();
            } else {
                // Registration failed, display an error message
                $error_message = 'Registration failed.';
            }
        }
    }
}


// Create the database if it doesn't exist
createDatabase();

// Establish a connection to the "ledres_db" database
$conn = mysqli_connect('localhost', 'root', '', 'ledres_db');
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Function to log in a user
function login($username, $password)
{
    global $conn;

    // Prepare the query to retrieve the user details from both tables
    $sql = "SELECT * FROM user WHERE username='$username' UNION SELECT * FROM admin WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // Set the session variables
        $_SESSION['username'] = $row['username'];
        $_SESSION['acc_type'] = $row['acc_type'];
        $_SESSION['loggedin'] = true;

        // Redirect based on account type
        if ($_SESSION['acc_type'] === 'admin') {
            header('Location: admin_form.php');
            exit();
        } elseif ($_SESSION['acc_type'] === 'user') {
            header('Location: portfolio.php');
            exit();
        }
    }

    // Login failed, return false
    return false;
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (login($username, $password)) {
            // Login successful, redirect based on account type
            if ($_SESSION['acc_type'] === 'admin') {
                header('Location: admin_form.php');
                exit();
            } elseif ($_SESSION['acc_type'] === 'user') {
                header('Location: portfolio.php');
                exit();
            }
        } else {
            // Login failed, display an error message
            $error_message = 'Invalid username or password.';
        }
    }
}

// Close the database connection
mysqli_close($conn);
?>


 <!DOCTYPE html>
<html>
<head>
    <title>Login</title>
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
        .login-cont {
            width: 350px;
            padding: 50px;
            background-color: #165A72;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }
        .login-cont h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #17A589;
        }
        .login-cont p{
            font-size: 12px;
        }
        .login-cont form {
            display: flex;
            flex-direction: column;
        }
        .login-cont form label {
            margin-bottom: 5px;
        }
        .login-cont form input[type="text"],
        .login-cont form input[type="password"] {
            padding: 5px;
            margin-bottom: 10px;
            border-radius: 3px;
            background-color: #E6FAF6;
            border: 1px solid #9BA4B5;
            font: 1px;
            color: #0C231F;
        }
        .login-cont form input[type="submit"] {
            padding: 10px 12px;
            margin-top: 10px;
            background-color: #17A589;
            color: #E6FAF6;
            border: 1px solid #9BA4B5;
            cursor: pointer;
        }
        .login-cont form input[type="submit"]:hover {
            background-color: #1EDFB9;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-bottom: 10px;
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

    @keyframes spin {
      0% {
        transform: rotate(0deg);
      }
      100% {
        transform: rotate(360deg);
      }
    }
    </style>
</head>
<body>
    <div class="login-cont">
        <h2>Greetings!</h2>
        <?php
        if (isset($error_message)) {
            echo '<p class="error-message">' . $error_message . '</p>';
        }
        ?>
        <form method="POST" action="">
            <label for="username" style="color: #E6FAF6;">Username:</label>
            <input type="text" id="username" name="username" required>
            <label for="password" style="color: #E6FAF6;">Password:</label>
            <input type="password" id="password" name="password" required>
            <div class="password-toggle" style="font-size: 0.8em;">
                <input type="checkbox" id="show-password" onchange="togglePasswordVisibility()">
                <label for="show-password" style="color: #E6FAF6;">Show password</label>
            </div>
            <input type="submit" name="login" value="Login">
        </form>
        <p style="color:#E6FAF6; ">Don't have an account? <a href="register.php" style="color:#1EDFB9; text-decoration: none;">Register here</a></p>

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
<script>
        window.addEventListener('load', function() {
  var loadingScreen = document.getElementById('loading-screen');
  loadingScreen.classList.add('hide');
});
    </script>
