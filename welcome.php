<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
    <title>Welcome</title>
</head>
<body>
    <?php include_once('navbar.php');?>
    <div class ="container">
    <h1 class="my-5 display-5 text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["name"])." "; ?></b>. Welcome to Water Supply Marketplace.</h1>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
