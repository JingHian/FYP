<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$name = $_SESSION['homeowner_name'];
$response = "your reply to $name was sent!";
if (isset($_POST['Reply'])) {
  $reply = $_POST['reply'];
  if ($reply !="")
  {
    $company->updateCase($reply,$_SESSION['case_ID']);
  }
}
elseif(isset($_POST['complete']))
{
    $company->closeCase($_SESSION['case_ID']);
    $response = "Your case with $name is closed";
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
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Case #<?php echo $_SESSION['case_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail"><?php echo $response?></p>
    </div>
      </div>
          <div class="form-group mb-2 mt-3 text-center">
              <a class="btn btn-lg btn-primary" href="viewCases.php">Return to Case List</a>
          </div>
    </div>


    </body>



</html>
