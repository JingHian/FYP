<?php session_start();

include("conn.php");
include_once "logInCheck.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}
$enquiry_success = "";
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
    }
} catch (Exception $ex) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

if(isset($_POST['update']))
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
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

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
         <div class="form-group mb-2 mt-3 text-center">
      <button type="submit" name="update" class="btn btn-lg btn-primary">Update</button>
        <a class="btn btn-lg btn-danger" href="viewBookingsHomeowner.php">Back</a>
        </div>
  </form>

  <div class="alert alert-primary text-center booking-alert mt-3" role="alert"><?php echo $enquiry_success;?></div>
</div>


<?php include_once('jsLinks.php');?>
    </body>



</html>
