<?php
// Initialize the session
session_start();

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
    <h1 class ="display-6 text-center" style="margin-top:50px;">Track Water Usage</h1>
    <div class ="container">
      <div class ="row ">
        <div class ="col-3 border border-secondary border-3 rounded pt-3">
          <div>
            <p class="usage-font">Water Usage for December:</p>
            <h2>1000litres</h2>
            <h3>For</h3>
            <h2>Address</h2>
          </div>
        </div>
        <div class ="col-1">  </div>
        <div class ="col-8">
          <div class="chart-container">
            <canvas id="myChart"></canvas>
        </div>
        </div>
      </div>
      <hr>
      <h2 class ="text-center" style="margin:10px 0 20px 0;">Stats</h2>
      <div class ="row ">
        <div class ="col-5 border border-secondary border-3 rounded pt-3 height-300">
          <div>
            <p class="usage-font">You used 11% more water than last month:</p>
          </div>
        </div>
        <div class ="col-2">  </div>
        <div class ="col-5 border border-secondary border-3 rounded pt-3 height-300">
          <div>
            <p class="usage-font">You used 5% more water than similar households:</p>
          </div>
        </div>
      </div>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
