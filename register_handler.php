<?php
// Step 1: Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ledres_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Step 2: Prepare the query
$username = $_POST['username'];
$password = $_POST['password'];
$acc_type = "user";

$sql = "INSERT INTO user (username, password, acc_type)
VALUES ('$username', '$password', '$acc_type')";

// Step 3: Execute the query
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  header('Location: login.php');
  exit();
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Step 4: Close the database connection
mysqli_close($conn);
?>
