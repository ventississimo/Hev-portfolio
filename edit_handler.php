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

// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Retrieve the updated title and description from the form
    $updatedTitle = $_POST['title'];
    $updatedDescription = $_POST['description'];

    // Prepare the UPDATE query
    $query = "UPDATE about_me SET title = '$updatedTitle', description = '$updatedDescription'";

    // Execute the query
    if (mysqli_query($connection, $query)) {
        // Update successful
        echo "Title and description updated successfully.";
        header('location:editing_form.php');
    } else {
        // Update failed
        echo "Error updating title and description: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>

<?php
if (isset($_POST['upload'])) {
    $targetDirectory = "";
    $section = $_POST['section'];

    if ($section === 'work') {
        $targetDirectory = "images/portfolio/work/";
    } elseif ($section === 'gallery') {
        $targetDirectory = "images/portfolio/gallery/";
    }

    $targetFile = $targetDirectory . basename($_FILES['image']['name']);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is an actual image
    $check = getimagesize($_FILES['image']['tmp_name']);
    if ($check !== false) {
        // Allow only specific file formats (you can modify this based on your requirements)
        $allowedFormats = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($imageFileType, $allowedFormats)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                // Image uploaded successfully
                echo "Image uploaded successfully.";
                header('location:editing_form.php');
            } else {
                echo "Sorry, there was an error uploading your image.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "The selected file is not an image.";
    }
}
?>
