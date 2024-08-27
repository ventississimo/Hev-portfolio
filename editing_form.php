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
    <title>Editing Form</title>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('images/bg.jpg');
            background-repeat: none;
        }
        .form-container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="file"] {
            margin-bottom: 10px;
        }
        button {
            font-size: 1rem;
            color: #F8FEFC;
            background-color: #48C9B0;
            display: inline-flex;
            padding: 10px 13px;
            border-radius: 0.3rem;
            cursor: pointer;
        }
        .image-list {
            margin-top: 20px;
            list-style-type: none;
            padding: 0;
        }
        .image-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .image-item img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            margin-right: 10px;
        }
        .image-item button {
            font-size: 0.85rem;
            padding: 5px 8px;
            background-color: #FF6B6B;
        }
         .back-button {
            position: absolute;
            bottom: 20px;
            right: 2px;
        }
        
        .delete-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        }


    </style>
</head>
<body>
    <!-- Logout -->
    <div class="logout-cont">
        <form method="post" action="logout.php">
            <input type="hidden" name="action" value="logout">
            <button type="submit" style="font-size: 0.85rem; color: #F8FEFC; background: #48C9B0; display: inline-flex; padding: 10px 13px; border-radius: 0.3rem; margin-right: 50px; cursor: pointer; float: right;">Logout</button>
        </form>
    </div>

    <div class="back-button">
        <button onclick="goBack()" style="font-size: 0.85rem; color: #F8FEFC; background: #48C9B0; display: inline-flex; padding: 10px 13px; border-radius: 0.3rem; margin-right: 50px; cursor: pointer; float: right;">Back</button>
    </div>

    <?php
    // Replace the placeholder values with your actual database credentials
    $hostname = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'ledres_db';

    // Create a connection
    $connection = mysqli_connect($hostname, $username, $password, $database);

    // Check if the connection was successful
    if (!$connection) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch the current title and description from the database
    $query = "SELECT title, description FROM about_me";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Fetch the row from the result
        $row = mysqli_fetch_assoc($result);

        // Assign the values to variables
        $currentTitle = $row['title'];
        $currentDescription = $row['description'];

        // Free the result set
        mysqli_free_result($result);
    } else {
        // Query failed, handle the error
        echo "Error fetching title and description: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
    ?>
<div class="form-container">
    <h2>About Editor</h2>
    <form method="post" action="edit_handler.php" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?php echo $currentTitle; ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="6" required><?php echo $currentDescription; ?></textarea>

        <button type="submit" name="submit">Update</button>
    </form>
</div>


    <!-- image editing -->
    <div class="form-container">
    <h2>Image Editor</h2>
    <form method="post" action="edit_handler.php" enctype="multipart/form-data">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" required>
        <label for="section">Select Section:</label>
        <select name="section" id="section" required>
            <option value="work">Work Samples</option>
            <option value="gallery">Gallery</option>
        </select>
        <button type="submit" name="upload">Upload</button>
    </form>
    <ul class="image-list">
        <?php
        // Display the list of images
        $imageDir = "images/portfolio/"; // Directory path for the images

        // Get all image files in the directory
        $images = glob($imageDir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);

        foreach ($images as $image) {
            echo '<li class="image-item">';
            echo '<img src="' . $image . '" alt="Portfolio Image">';
            echo '<form method="POST" action="delete_handler.php">';
            echo '<input type="hidden" name="image" value="' . $image . '">';
            echo '<button type="submit" name="delete" onclick="return confirm(\'Are you sure you want to delete this image?\')" class="delete-button">Delete</button>';
            echo '</form>';
            echo '</li>';
        }
        ?>
    </ul>
</body>
</html>
