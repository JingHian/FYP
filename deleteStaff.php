<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();

    $company->deleteStaff($_SESSION['staff_ID']);

?>

<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Delete Staff</title>
    </head>
    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Staff #<?php echo $_SESSION['staff_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Staff  <?php echo $_SESSION['staff_name']?> was deleted.</p>
    </div>
      </div>
          <div class="form-group mb-2 mt-3 text-center">
              <a class="btn btn-lg btn-primary" href="viewStaff.php">Return to Staff List</a>
          </div>
    </div>


    </body>



</html>
