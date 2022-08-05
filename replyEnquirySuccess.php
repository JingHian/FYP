<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$admin = new Admin();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $reply = $_POST['reply'];
  if ($reply !="")
  {
    $admin->updateEnquiry($reply,$_SESSION['enquiry_ID'],$_SESSION['ID'],$_SESSION['enquiry_user_type']);
  }
}
// echo $_SESSION['case_ID'];

?>

<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Enquiry</title>
    </head>
    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Enquiry #<?php echo $_SESSION['enquiry_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <div class="alert alert-primary booking-alert mt-3" role="alert">Your reply to <?php echo $_SESSION['user_name']?> was sent!</div>
    </div>
      </div>
          <div class="form-group mb-2 mt-3 text-center">
              <a class="btn btn-lg btn-primary" href="viewEnquiriesAdmin.php">Return to Enquiry List</a>
          </div>
    </div>


    </body>



</html>
