<?php
$conn = mysqli_connect('localhost', 'root', '', 'ledres_db') or die('connection failed.');

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$msg = mysqli_real_escape_string($conn, $_POST['message']);

	$select_message = mysqli_query($conn, "SELECT * FROM `contact_submissions` WHERE name = '$name' AND email = '$email' AND message = '$msg'");

	if (!$select_message) {
		die('query failed: ' . mysqli_error($conn));
	}

	if (mysqli_num_rows($select_message) > 0) {
		$message = 'message sent already!';
		
	} else {
		$insert_query = "INSERT INTO `contact_submissions`(name, email, message) VALUES ('$name', '$email', '$msg')";
		if (!mysqli_query($conn, $insert_query)) {
			die('query failed: ' . mysqli_error($conn));
		}
		$message = 'message sent successfully!';
	}
}
?>