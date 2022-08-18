<?php session_start();

include("conn.php");
include_once("classes.php");
include_once("validation.php");
include_once "logInCheck.php";
$uni = new Universal();

$upload_failed = "";
$upload_success = "";
$enquiry_success = "";


if(isset($_POST['details']))
{
  $_SESSION['booking_type'] = $_POST['booking_type'];
}

if(isset($_POST['booking_ID']))
{
    $_SESSION['booking_ID'] = $_POST['booking_ID'];
}
$ID = $_SESSION['booking_ID'];

$getbooking = mysqli_query($conn,"SELECT * FROM Bookings INNER JOIN Company ON Company.company_ID = Bookings.company_ID WHERE booking_ID = $ID");
try
{
    if(($row = mysqli_fetch_assoc($getbooking)) == TRUE)
    {
        $compname = $row['name'];
        $date = $row['booking_date'];
        $status = $row['booking_status'];
        $desc = $row['booking_description'];
        $imgname = $row['booking_image'];
    }
} catch (Exception $ex) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

if(isset($_POST['update'])&& $_POST['randcheck']==$_SESSION['rand'])
{
    $desc= $_POST['enquirydetails'];
    $newdate = $_POST['case_date'];
    $updateBooking = mysqli_query($conn, "UPDATE Bookings SET booking_date = '$newdate', booking_description = '$desc' WHERE booking_ID = $ID");
    try{
        if($updateBooking == TRUE)
        {
            $enquiry_success = "Booking Updated";
        }
    }
     catch (Exception $ex) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }

    if(file_exists($_FILES['fileToUpload']['tmp_name']) || is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

        //get the extension of the uploaded file
        $path = $_FILES['fileToUpload']['name'];

        //convert jpeg to jpg
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if ($ext == 'jpeg' || $ext == 'JPEG')
        {
          $ext = 'jpg';
        }
        //get the name of the current file without extension
        $old_name =substr($imgname, 0, -3);

        //concat old name with new ext
        $new_name = $old_name.$ext;
        $check_image = $uni->imageUpload($_FILES,$new_name);
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
          $updateImg = mysqli_query($conn, "UPDATE Bookings SET booking_image = '$new_name' WHERE booking_ID = $ID");
          try{
              if($updateImg == TRUE)
              {
                  $enquiry_success = "Booking Updated";
              }
          }
           catch (Exception $ex) {
          echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
          }
        }
    }

}

?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Booking</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Booking #<?php echo $ID;?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">check the details of your booking here.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
        <?php
         $rand=rand();
         $_SESSION['rand']=$rand;
        ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="to_company" name="to_company" placeholder="to_company" value ="<?php echo $compname;?>" disabled>
            <label for="to_company">To: </label>
          </div>
        </div>
        <div class="row">
          <div class ="col-md-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="case_date" name="case_date" placeholder="case_date" value ="<?php echo $date;?>">
            <label for="case_date">Date</label>
          </div>
        </div>

        <div class ="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="case_status" name="case_status" placeholder="case_status" value ="<?php echo $status;?>" disabled>
          <label for="case_status">Status</label>
        </div>
      </div>

        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px"><?php echo $desc;?></textarea>
            <label for="enquirydetails">Enquiry Details</label>
          </div>
        </div>
        <?php
        if ($_SESSION['booking_type'] == "problem")
        {
       echo'  <div class="col">
          <div class=" mb-3 ">
            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">
        </div>
      </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
        <img class="image-upload2" src="img/'. $imgname.'"/>
        </div>
        </div>';
        }
        ?>
         <div class="form-group mb-2 mt-3 text-center">
      <button type="submit" name="update" class="btn btn-lg btn-primary">Update</button>
        <a class="btn btn-lg btn-danger" href="viewBookingsHomeowner.php">Back</a>
        </div>
  </form>

  <div class="alert alert-primary text-center booking-alert mt-3" role="alert"><?php echo $enquiry_success;?></div>
  <div class="alert alert-danger  text-center booking-alert mt-3" role="alert"><?php echo $upload_failed;?></div>
  <div class="alert alert-success  text-center booking-alert mt-3" role="alert"><?php echo $upload_success;?></div>
</div>


<?php include_once('jsLinks.php');?>
    </body>



</html>
