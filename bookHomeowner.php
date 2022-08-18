<?php session_start();

include("conn.php");
include_once("classes.php");
include_once("validation.php");
include_once "logInCheck.php";
$company = new Company();
$homeowner = new Homeowner();
$uni = new Universal();
$booking_success = "";
$booking_failed = "";
$upload_failed = "";
$upload_success = "";



if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){

    if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

        $file_name = $uni->getImageName($_FILES,"_user_problem_image_". microtime(true));
        $check_image = $uni->imageUpload($_FILES,$file_name);
        if ($check_image == "not_image")
        {
          $upload_failed ="File is not an image, please upload a JPG, JPEG or PNG file!";
        }
        else if ($check_image == "file_too_big")
        {
          $upload_failed ="File size is too large! please upload a file smaller than 2mb!";
        }
        else if ($check_image == "wrong_file")
        {
          $upload_failed ="File is not an image, please upload a JPG, JPEG or PNG file!";
        }
        else if ($check_image == "upload_failed")
        {
          $upload_failed ="There was an error uploading your image, please try again!";
        }
        else if ($check_image == "upload_success")
        {
          $upload_success ="Image has been uploaded!";
        }
    }
    else{
      $file_name = NULL;
    }

  $check_success =  $homeowner->insertBooking($_POST['company_name'],$_POST['date'],$_POST['problem_details'],$_POST['booking_type'],$file_name);
  if($check_success == True)
  {
    $booking_success = "Your booking for ".$_POST['date']. " has been sent to ". $_POST['company_name']."!";
  }
  else if ($check_success == False) {
    $booking_failed = "You are not a client of ". $_POST['company_name']."!";
  }

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
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Book a Technician</h1>
      <div class="row justify-content-center">
        <div class="col-md--md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Please enter issue details and date.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
    <?php
     $rand=rand();
     $_SESSION['rand']=$rand;
    ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div class="col-md-">
      <?php  $company->CompanyDropDown();?>
      </div>
        <div class="col-md-">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="home_address" name="home_address" placeholder="home_address" value ="<?php echo $_SESSION["address"];?>" disabled>
            <label for="home_address">Address </label>
          </div>
        </div>
        <div class="row">
          <div class ="col-md-">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="home_postal" name="home_postal" placeholder="home_postal" value ="<?php echo $_SESSION['postal_code'];?>" disabled>
            <label for="home_postal">Postal Code</label>
          </div>
        </div>

      <div class="col-md-">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="date" name="date"placeholder="date" required>
          <label for="date">Date</label>
          <script>date.min = new Date().toLocaleDateString('en-ca')</script>
        </div>
      </div>

      </div>
      <div class="col-md-">
        <div class="form-floating  mb-3 ">
          <textarea class="form-control" id="problem_details" name="problem_details" placeholder="problem_details" style="height: 200px" ></textarea>
          <label for="problem_details">Problem Details</label>
        </div>
      </div>
      <div class="col">
        <div class=" mb-3 ">
          <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
      </div>
    </div>
      <input type="hidden" id="booking_type" name="booking_type" value="problem">

      <div class="form-group mb-2 mt-3 text-center">
          <input type="submit" class="btn btn-lg btn-primary" value="Submit Booking">
      </div>
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $booking_success;?></div>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $upload_failed;?></div>
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $upload_success;?></div>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $booking_failed;?></div>
        </form>
      </div>
      <?php include_once('jsLinks.php');?>
    </body>
</html>
