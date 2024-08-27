<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'ledres_db');

//connecting the database
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if (!$link) {
	die("connection failed: " . mysqli_connect_error());
}

//checking the connection
if ($link == false) {
	die("ERROR: Could not connect to the server. " . mysqli_connect_error());
}
?>