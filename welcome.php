<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

$companyName = $_SESSION["name"];
$companyId = $_SESSION["ID"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome</title>
    <?php include_once('cssLinks.php');?>

</head>
<body>
    <?php include_once('navbar.php');?>
    <div class ="container">
    <h1 class="my-5 welcome-font text-center">Hi, <?php echo htmlspecialchars($_SESSION["name"])." "; ?>. Welcome to Water Supply Marketplace.</h1>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
