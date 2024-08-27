<?php
session_start();
if (isset($_POST['action']) && $_POST['action'] == 'logout') {
  // destroy the user's session
  session_unset();
  session_destroy();
}
header("Location: login.php"); // redirect to the login page
?>
