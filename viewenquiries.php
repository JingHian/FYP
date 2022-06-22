<?php session_start();
include "conn.php";
include "classes.php";
include_once "navbar.php";
$enquiries = new Homeowner();

?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <title>Company Details</title>
  </head>
  <body>
      <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Enquiries</h1>
      <div class="row justify-content-center">
        <div class="col text-center">
          <p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Here you can view the status of your Enquiries.</p>
        </div>
        <form method="post" action="sendEnquiry.php">
            <button class="float-end btn btn-primary" type="submit">New +</button>
        </form>
      </div>
      </div>
      <div class="container mt-3">
        <div class="d-flex justify-content-around bg-secondary mb-3">
          <input class="form-control" id="myInput" type="text" placeholder="Search..">
          <div class="dropdown d-flex justify-content-end">
            <button class="btn btn-secondary dropdown-toggle align-text-top" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
              Category
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              <li><a class="dropdown-item" href="#">Category1</a></li>
              <li><a class="dropdown-item" href="#">Category2</a></li>
              <li><a class="dropdown-item" href="#">Category3</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="container justify-content-center text-center">
      <?php $enquiries->viewEnquiries(); ?>
      </div>

  </body>
