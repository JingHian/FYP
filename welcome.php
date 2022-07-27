<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
echo "<title>Welcome</title>";

$companyName = $_SESSION["name"];
$companyId = $_SESSION["ID"];
$userType = $_SESSION["user_type"];

$getVerifiedStatus = mysqli_query($conn, "select `verified` from company where `company_ID` = '$companyId'");
$verifiedStatus = $getVerifiedStatus->fetch_array()[0] ?? '';

if ($verifiedStatus == 0 && $userType == 'company') {
  echo "<h1>Hello $companyName. Your account will be verified by the admin team soon. </h1><br> 
  <h3>You will be able to use your account after we approve your account creation request.</h3> 
  <h4>We will send you an email if we have approved or rejected your account verification.</h4>";
  echo "<a href='logout.php'>log out</a>";
  //echo $userType;

} else if (($verifiedStatus == 1 && $userType == 'company') || $userType != 'company') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
    
</head>
<body>
    <?php include_once('navbar.php');?>
    <div class ="container">
    <h1 class="my-5 display-5 text-center">Hi, <b><?php echo htmlspecialchars($_SESSION["name"])." "; ?></b>. Welcome to Water Supply Marketplace.</h1>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
<?php } else if ($verifiedStatus == 2 && $userType == 'company') {
  echo "We are sorry that yoru account verification request has been rejected. Please contact the admin for more details.";
  echo "<a href='logout.php'>log out</a>";
}

// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
// echo "<a href='logout.php'>log out</a>";?>
