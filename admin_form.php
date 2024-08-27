<?php
// Start a session
session_start();
require_once "config.php";

// Check if the user is not logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit;
}

// Check if the user has the "admin" account type
if ($_SESSION['acc_type'] !== 'admin') {
    // Redirect to an error page or display an error message
    header('Location: error.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Choose Form</title>
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

        h2 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            transition: opacity 0.5s;
        }

        form.fadeout {
            opacity: 0;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button {
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form id="chooseForm" method="post" action="adminform_handler.php">
        <label for="form_type">Select destination:</label>
        <select name="form_type" id="form_type" required>
            <option value="contact_requests">Contact Requests</option>
            <option value="editing_form">Editing Form</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Handle form submission
            $('#chooseForm').submit(function(event) {
                event.preventDefault();

                var form = $(this);

                // Add fadeout class to trigger the CSS transition
                form.addClass('fadeout');

                // Wait for the transition to complete before submitting the form
                setTimeout(function() {
                    form.off('submit').submit();
                }, 500);
            });
        });
    </script>
</body>
</html>
