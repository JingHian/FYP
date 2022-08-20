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

$getbooking = mysqli_query($conn, "SELECT book.*, home.name
                                   FROM Bookings as book
                                   INNER JOIN
                                   Homeowners as home
                                   ON book.homeowner_ID = home.homeowner_ID
                                   WHERE book.booking_ID = '$bookingID'");
try
{
    if(($row = mysqli_fetch_assoc($getbooking)) == TRUE)
    {
        $homeowner_ID = $row['homeowner_ID'];
        $homeownerName = $row['name'];
        $staff = $row['staff_ID'];
        if ($staff != NULL)
        {
          $assign_true = 1;
        }
        else {
          $assign_true = 0;
        }
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
    // $sql = "SELECT client_ID FROM Clients WHERE homeowner_ID = '$homeowner_ID' AND company_ID = '" . $_SESSION['ID'] . "'";
    // $result = mysqli_query($conn, $sql);
    // $row = $result->fetch_assoc();
    // $client_ID = $row["client_ID"];
    // echo $client_ID;

    $staffid = $_POST['staff_name_ID'];
    $bookid = $_POST['booking_ID'];
    $booked = "Assigned";
    $assignstaff = "UPDATE Maintenance_Staff SET status='$booked', booking_ID ='$bookid' WHERE staff_ID = '$staffid'";
    $chgstatus = "UPDATE Bookings SET booking_status='$booked', staff_ID = '$staffid' WHERE booking_ID = '$bookid'";
    try
    {
        if(mysqli_query($conn, $assignstaff)== TRUE)
        {
            if(mysqli_query($conn, $chgstatus)== TRUE)
            {
                $enquiry_success = "Booking updated!";
                $assign_true = 1;
                // header("Location: assignStaff.php");
            }
        }
    } catch (Exception $ex) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}

elseif (isset($_POST['unassign'])) {

    $bookid = $_POST['booking_ID'];
    $donedate = date("Y/m/d");
    $complete = "UPDATE Bookings SET booking_status= 'In Progress' , staff_ID = NULL WHERE booking_ID = '$bookid'";
    $unassign = "UPDATE Maintenance_Staff SET status= 'Not Assigned', booking_ID = NULL WHERE staff_ID = '$staff'";
    try
    {
        if(mysqli_query($conn, $complete)== TRUE)
        {
            if(mysqli_query($conn, $unassign)== TRUE)
            {
                $enquiry_success = "Staff Unassigned!";
                $assign_true = 0;
            }
        }
    } catch (Exception $ex) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}

elseif (isset($_POST['chg_status'])) {

    $bookid = $_POST['booking_ID'];
    $donedate = date("Y/m/d");
    $complete = "UPDATE Bookings SET booking_status='Completed ' , completion_date='$donedate', staff_ID = NULL WHERE booking_ID = '$bookid'";
    $unassign = "UPDATE Maintenance_Staff SET status= 'Not Assigned', booking_ID = NULL WHERE staff_ID = '$staff'";
    try
    {
        if(mysqli_query($conn, $complete)== TRUE)
        {
            if(mysqli_query($conn, $unassign)== TRUE)
            {
                $enquiry_success = "Booking Marked as complete!";
                $assign_true = 0;
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
            <input type="text" class="form-control" id="staff_ID" name="staff_ID" placeholder="Staff Assigned" value ="<?php echo $staff; ?>" disabled>
            <label for="staff_ID">Staff Assigned</label>
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
          <?php
          if ($assign_true == 0)
          {
           $company->StaffDropDown();
          }
         ?>
          </div>
    <div class="form-group mb-2 mt-3 text-center">
        <?php
          if ($assign_true == 0)
          {
            echo '<button type="submit" class="btn btn-lg btn-primary" name ="assign">Assign Staff</button>';
          }
          else if ($assign_true == 1)
          {
            echo '<button type="submit" class="btn btn-lg me-5 btn-primary" name ="unassign">Unassign Staff</button>';
            echo '<button type ="submit" class="btn btn-lg btn-success" name="chg_status" value ="update status">Mark as completed</button>';
          }
        ?>
    </div>
    <div class="alert alert-primary text-center booking-alert mt-3" role="alert"><?php echo $enquiry_success;?></div>
  </form>
</div>
    </body>

</html>
<?php
//once do assign staff, pull from company staff records, once assigned shoot email, also add in change status
?>
