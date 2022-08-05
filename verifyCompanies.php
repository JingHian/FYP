<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
include_once ("classes.php");
include_once('navbar.php');
$verify = new Admin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
</head>
<body>
  <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Verify Companies</h1>
      <div class="row justify-content-center">
          <div class="col-md-6 text-center">
              <p class ="display-6 fs-5">Check details and approve or reject requests.</p>
          </div>
      </div>
  </div>

  <div class="container mt-3">
  <div class="d-flex justify-content-around bg-secondary mb-3">
    <input class="form-control rounded-0 search-for" type="text" placeholder="Search..">
  </div>
</div>
<div class="container justify-content-center text-center">
  <?php
    $verify->verifyCompanies();
  ?>
</div>

<?php include_once('jsLinks.php');?>
</body>
</html>
