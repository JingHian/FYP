<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
include_once "logInCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
    <title>Welcome</title>
</head>
<body>
  <?php include_once('navbar.php');?>
  <h1 class ="display-6 text-center " style="margin-top:20px;margin-bottom:20px;">Services</h1>
  <div class="container">
    <div class="row ">
    <div class="col-3"></div>
      <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border border-secondary border-3 pt-3  height-200">
        <a class ="no-text-deco" href="viewWaterUsage.php">
          <div class =" text-center">
            <span class="material-symbols-outlined  icon-size">water_drop</span>
            <p class="usage-font">My Water Usage </p>
          </div>
      </a>
      </button>
        <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border border-secondary border-start-0 border-end-0 border-3 pt-3  height-200">
        <a class ="no-text-deco" href="bookHomeowner.php">
          <div class =" text-center">
            <span class="material-symbols-outlined icon-size">home_repair_service</span>
            <p class="usage-font ">Book a Technician</p>
          </div>
          </a>
        </button>
        <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border border-secondary border-3 pt-3  height-200">
          <a class ="no-text-deco" href="userInfoHome.php">
            <div class =" text-center">
              <span class="material-symbols-outlined icon-size">person</span>
              <p class="usage-font">Edit Profile </p>
            </div>
          </a>
        </button>
        <div class="col-3"></div>
        <div class="col-3"></div>
        <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border border-top-0 border-secondary border-3 pt-3  height-200">
          <div class =" text-center">
            <span class="material-symbols-outlined   icon-size">request_quote</span>
            <p class="usage-font"> Bills/History </p>
          </div>
        </button>
        <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border border-top-0  border-start-0 border-end-0 border-secondary border-3 pt-3  height-200">
          <div class =" text-center">
            <span class="material-symbols-outlined  icon-size">grade</span>
            <p class="usage-font ">Review Company </p>
          </div>
        </button>
        <button class="btn no-rounded-border d-flex align-items-center justify-content-center col-2 border  border-top-0  border-secondary   border-3 pt-3  height-200">
          <a class ="no-text-deco" href="enquiryToPlatform.php">
            <div class =" text-center">
              <span class="material-symbols-outlined   icon-size">contact_support</span>
              <p class="usage-font">Send Enquiry to Platform </p>
            </div>
            </a>
          </button>

    </div>
  </div>
<?php include_once('jsLinks.php');?>
</body>
</html>
