<?php session_start();

include_once "conn.php";
include_once "logInCheck.php";
include_once "classes.php";
include_once "navbar.php";

if($_SESSION["user_type"] == "company")
{
  $enquiries = new Company();
}
else if ($_SESSION["user_type"] == "homeowner")
{
  $enquiries = new Homeowner();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php include_once('cssLinks.php');?>
      <title>Platform Enquiries</title>
  </head>
  <body>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Platform Enquiries</h1>
      <div class="row justify-content-center">
        <div class="col text-center">
          <p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Enquiries to our Platform are listed here.</p>
        </div>
    <div class="col-md-12 text-center">

      </div>
      </div>
      </div>
      <div class="container mt-3">
        <div class="d-flex justify-content-around bg-secondary mb-3">
          <input class="form-control rounded-0 search-for" type="text" placeholder="Search..">
        </div>
      </div>
      <div class="container justify-content-center text-center table-responsive">
      <?php $enquiries->viewEnquiryReplies(); ?>
      </div>

      <?php include_once('jsLinks.php');?>
  </body>
  </html>
