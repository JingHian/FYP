<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$enquiry_success = "";
$reply = "";
if(isset($_POST['booking_ID']))
{
    $_SESSION['booking_ID'] = $_POST['booking_ID'];
}
$bookingID = $_SESSION['booking_ID'];

$getbooking = mysqli_query($conn, "SELECT * FROM bookings INNER JOIN homeowners ON bookings.homeowner_ID = homeowners.homeowner_ID WHERE bookings.booking_ID = '$bookingID'");
try
{
    if(($row = mysqli_fetch_assoc($getbooking)) == TRUE)
    {
        $homeownerName = $row['name'];
        $staff = $row['staff_ID'];
        $bookingDate = $row['booking_date'];
        $bookingStatus = $row['booking_status'];
        $bookingDescription = $row['booking_description'];
        if($row['completion_date'] != NULL)
        {
            $completiondate = $row['completion_date'];
        }
        else
        {
            $completiondate = "";
        }
    }
} catch (Exception $ex) {
     echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

if(isset($_POST['assign']))
{
    $staffid = $_POST['staff_name'];
    $bookid = $_POST['bookingID'];
    $status = "Assigned-$bookid";
    $booked = "Assigned";
    $assignstaff = "UPDATE maintenance_staff SET status='$booked', booking_ID ='$bookid' WHERE staff_ID = '$staffid'";
    $chgstatus = "UPDATE bookings SET booking_status='$booked', staff_ID = '$staffid' WHERE booking_ID = '$bookid'";
    try
    {
        if(mysqli_query($conn, $assignstaff)== TRUE)
        {
            if(mysqli_query($conn, $chgstatus)== TRUE)
            {
                $enquiry_success = "Booking updated!";
            }
        }
    } catch (Exception $ex) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}
elseif (isset($_POST['chg_status'])) {

    $bookid = $_POST['bookingID'];
    $staffid = $_POST['booking_subject'];
    $donedate = date("Y/m/d");
    $complete = "UPDATE bookings SET booking_status=\"Completed\" , completion_date='$donedate' WHERE booking_ID = '$bookid'";
    $unassign = "UPDATE maintenance_staff SET status=\"Not Assigned\" WHERE staff_ID = '$staffid'";
    try
    {
        if(mysqli_query($conn, $complete)== TRUE)
        {
            if(mysqli_query($conn, $unassign)== TRUE)
            {
                $enquiry_success = "Booking Marked as complete!";
            }
        }
    } catch (Exception $ex) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}
?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Booking details</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Booking #<?php echo $_SESSION['booking_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Assign staff to booking.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="reply_booking" class ="form-horizontal-2" action=""<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"" method="post">
      <input type="hidden" name="booking_ID" value ="<?php echo $_SESSION['booking_ID']; ?>">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="homeowner_name" name="homeowner_name" placeholder="homeowner_name" value ="<?php echo $homeownerName; ?>" disabled>
            <label for="homeowner_name">Homeowner name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="booking_subject" name="booking_subject" placeholder="Staff Assigned" value ="<?php echo $staff; ?>" READONLY>
            <label for="booking_subject">Staff Assigned</label>
          </div>
        </div>
        <div class="row">
            <div class="col">
              <div class="form-floating  mb-3 ">
                <input type="text" class="form-control" id="booking_date" name="booking_date" placeholder="<?php $bookingDate; ?>" value="<?php echo $bookingDate; ?>" disabled>
                <label for="booking_date">Booking Date</label>
              </div>
            </div>

            <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="booking_status" name="booking_status"placeholder="booking_status" value="<?php echo $bookingStatus; ?>"disabled>
              <label for="booking_status">Booking Status</label>
            </div>
          </div>

          </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px" disabled><?php echo $bookingDescription; ?></textarea>
            <label for="enquirydetails">Enquiry Details</label>
          </div>
        </div>
        <div class="col">
              <div class="form-floating  mb-3 ">
                <input type="text" class="form-control" id="completion_date" name="completion_date" placeholder="<?php $completiondate; ?>" value="<?php echo $completiondate; ?>" disabled>
                <label for="completion_date">Date Completed</label>
              </div>
        </div>
        <div class="col">
          <?php  $company->StaffDropDown();?>
          </div>
      <input type="hidden" name="bookingID" value=<?php echo $_SESSION['booking_ID'] ?>>
    <div class="form-group mb-2 mt-3 text-center">
        <button type="submit" class="btn  btn-primary" name ="assign">Assign a Staff</button>
        <button type ="submit" class="btn btn-primary" name="chg_status" value ="update status">Mark as completed</button>
    </div>
    <p class="text-center" style  ="color:green"><?php echo $enquiry_success;?></p>
  </form>
</div>
    </body>

</html>
<?php
//once do assign staff, pull from company staff records, once assigned shoot email, also add in change status
?>
