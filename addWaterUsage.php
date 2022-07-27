<?php session_start();

include("conn.php");
include_once("classes.php");
$company = new Company();
$homeowner = new Homeowner();
$update_success = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}

if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){
  $homeowner->addWaterUsage($_POST['company_name'],$_POST['water_usage'],$_POST['date']);
  $update_success = "Your Water Usage for ".$_POST['date']. " has been saved!";


}

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
      <h1 class ="display-5 text-center" style="margin-top:50px;">Add Water Usage</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Enter Water Usage Statistics.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <?php
     $rand=rand();
     $_SESSION['rand']=$rand;
    ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div class="col">
      <?php  $company->CompanyDropDown();?>
      </div>
        <div class="row">
          <div class ="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="water_usage" name="water_usage" placeholder="water_usage" >
            <label for="water_usage">Water Usage/m³</label>
          </div>
        </div>

      <div class="col">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="date" name="date"placeholder="date" required>
          <label for="date">Date</label>
        </div>
      </div>

      </div>

      <div class="form-group mb-2 mt-3 text-center">
          <input type="submit" class="btn btn-primary" value="Submit">
      </div>
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $update_success;?></div>
        </form>
      </div>
      <?php include_once('jsLinks.php');?>
    </body>
</html>
