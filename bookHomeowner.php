<?php session_start();

include("conn.php");
include("classes.php");
$company = new Company();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}

?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('cssLinks.php');?>
        <title>Enquiry</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Book a Technician</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Please enter issue details and date.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <div class="col">
      <?php  $company->CompanyDropDown();?>
      </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="home_address" name="home_address" placeholder="home_address" value ="<?php echo $_SESSION["address"];?>" disabled>
            <label for="home_address">Address </label>
          </div>
        </div>
        <div class="row">
          <div class ="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="home_postal" name="home_postal" placeholder="home_postal" value ="<?php echo $_SESSION['postal_code'];?>" disabled>
            <label for="home_postal">Postal Code</label>
          </div>
        </div>

      <div class="col">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="date" name="date"placeholder="date" >
          <label for="date">Date</label>
        </div>
      </div>

        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="problem_details" name="problem_details" placeholder="problem_details" style="height: 200px" ></textarea>
            <label for="problem_details">Problem Details</label>
          </div>
        </div>


  </form>
    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn btn-primary" value="Submit Booking">
    </div>
</div>


    </body>



</html>