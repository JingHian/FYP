<?php session_start();

include_once "conn.php";
include_once "logInCheck.php";
include_once "classes.php";
include_once "navbar.php";

$enquiries = new Homeowner();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php include_once('cssLinks.php');?>
      <title>Company Details</title>
  </head>
  <body>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Enquiries</h1>
      <div class="row justify-content-center">
        <div class="col text-center">
          <p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Here you can view the status of your Enquiries.</p>
        </div>
    <div class="col-md-12 text-center">
        <a class="float-end btn btn-primary" href="sendEnquiry.php" type="submit">New +</a>
      </div>
      </div>
      </div>
      <div class="container mt-3">
        <div class="d-flex justify-content-around bg-secondary mb-3">
          <input class="form-control rounded-0 search-for" type="text" placeholder="Search..">
        </div>
      </div>
      <div class="container justify-content-center text-center table-responsive">
      <?php $enquiries->viewEnquiries(); ?>
      </div>

      <?php include_once('jsLinks.php');?>
  </body>
  </html>
