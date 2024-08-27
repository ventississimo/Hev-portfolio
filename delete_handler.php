<?php
if (isset($_POST['image'])) {
    $imagePath = $_POST['image'];
    if (file_exists($imagePath)) {
        unlink($imagePath); // Delete the image file
        echo "Image deleted successfully.";
    } else {
        echo "Image not found.";
    }
}
?>
