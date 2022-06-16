<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('cssLinks.php');?>
    <title>Welcome</title>
</head>
<body>
  <?php include_once('navbar.php');?>
  <h1 class ="display-6 text-center" style="margin-top:20px;margin-bottom:20px;">Track Water Usage</h1>
  <div class="container">
    <div class="row ">
    <div class="col-2"></div>
      <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
        <div class =" text-center">
          <span class="material-symbols-outlined icon-size">water_drop</span>
          <p class="usage-font ">Water Usage </p>
        </div>
      </div>
      <div class="col-1"></div>
        <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
          <div class =" text-center">
            <span class="material-symbols-outlined icon-size">water_drop</span>
            <p class="usage-font ">Water Usage </p>
          </div>
        </div>
        <div class="col-1"></div>
        <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
          <div class =" text-center">
            <span class="material-symbols-outlined icon-size">water_drop</span>
            <p class="usage-font ">Water Usage </p>
          </div>
        </div>
        <div class="col-2"></div>
        <div class="col-2"></div>
          <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
            <div class =" text-center">
              <span class="material-symbols-outlined icon-size">water_drop</span>
              <p class="usage-font ">Water Usage </p>
            </div>
          </div>
          <div class="col-1"></div>
            <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
              <div class =" text-center">
                <span class="material-symbols-outlined icon-size">water_drop</span>
                <p class="usage-font ">Water Usage </p>
              </div>
            </div>
            <div class="col-1"></div>
            <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
              <div class =" text-center">
                <span class="material-symbols-outlined icon-size">water_drop</span>
                <p class="usage-font ">Water Usage </p>
              </div>
            </div>
            <div class="col-2"></div>
            <div class="col-2"></div>
              <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
                <div class =" text-center">
                  <span class="material-symbols-outlined icon-size">water_drop</span>
                  <p class="usage-font ">Water Usage </p>
                </div>
              </div>
              <div class="col-1"></div>
                <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
                  <div class =" text-center">
                    <span class="material-symbols-outlined icon-size">water_drop</span>
                    <p class="usage-font ">Water Usage </p>
                  </div>
                </div>
                <div class="col-1"></div>
                <div class="d-flex align-items-center justify-content-center col-2 border border-secondary border-3 rounded pt-3 mb-3 height-200">
                  <div class =" text-center">
                    <span class="material-symbols-outlined icon-size">water_drop</span>
                    <p class="usage-font ">Water Usage </p>
                  </div>
                </div>
                <div class="col-2"></div>

    </div>
  </div>
<?php include('jsLinks.php');?>
</body>
</html>
