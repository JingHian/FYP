<?php session_start();

include "conn.php";
include_once "classes.php";
include_once "logInCheck.php";
  // echo '<pre>' . print_r($_SESSION) . '</pre>';
$ID = $_SESSION["ID"];
$name = $_SESSION["name"];
$phone = $_SESSION["phone"];
$email = $_SESSION["email"];
$address = $_SESSION["address"];
$postal_code = $_SESSION["postal_code"];
$booking_success = "";
$booking_failed = "";
$homeowner = new Homeowner();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['randcheck']==$_SESSION['rand'] && isset($_POST['accept'])) {
  $checkother = "SELECT * FROM Clients WHERE homeowner_ID = '$ID'";
  $result = mysqli_query($conn, $checkother);
  if($homeowner->checkClientExists($_SESSION["ID"],$_SESSION["company_ID"]) == True)
  {
    $homeowner->addClient($_SESSION["company_ID"],$_POST["date"]);
    $homeowner->insertBooking($_SESSION["company_name"],$_POST["date"],$_POST["comments"],"installation",NULL);
    $booking_success = "Your booking for ".$_POST['date']. " has been sent to ". $_SESSION['company_name']."!";
  }
  elseif((mysqli_num_rows($result))!= 0)
  {
      $booking_failed = "You already are a client of another company. You may only be a client of 1 company at a time. ";
  }
  else{
    $booking_failed = "You already are a client of ". $_SESSION['company_name']."! Please check your bookings for your previous installation booking.";
  }
}
elseif($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['randcheck']==$_SESSION['rand'] && !isset ($_POST['accept']))
{
    $booking_failed = "Please check that you have accepted to be registered as a client";
}
?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
    <title>Company Details</title>
</head>

<body>
    <?php include_once('navbar.php');?>
  <div class="container" >
  <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Choose Installation Date</h1>
  <div class="row justify-content-center">
    <div class="col-md-6 text-center">
  <p class ="display-6 fs-5" name = "product" value ="avail">confirm your details.</p>
</div>
  </div>
</div>
<div class="container form-horizontal">
    <div class="col">
      <div class="form-floating  mb-3 ">
        <input type="text" class="form-control" name="Company" placeholder="Company" value="<?php echo $_SESSION["company_name"]; ?>"disabled>
        <label for="Company">Company </label>
      </div>
    </div>
    <div class="row">
        <div class="col">
          <div class="form-floating  mb-3 ">
            <input type="text" class="form-control" name="name" placeholder="name" value="<?php echo $name; ?>"disabled>
            <label for="name">Name </label>
          </div>
        </div>

        <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="phone" name="phone"placeholder="phone" value="<?php echo $phone; ?>"disabled>
          <label for="phone">Phone</label>
        </div>
      </div>
      </div>

      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>"disabled>
          <label for="email">Email</label>
        </div>
      </div>

      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>"disabled>
          <label for="address">Address</label>
        </div>
      </div>

<div class="row">
      <div class="col">
        <div class="form-floating mb-3 ">
          <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="postal_code" value="<?php echo $postal_code; ?>"disabled>
          <label for="postal_code">Postal Code</label>
        </div>
      </div>

      <div class="col">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
          <?php
           $rand=rand();
           $_SESSION['rand']=$rand;
          ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
        <div class="form-floating mb-3">
          <input type="date" class="form-control" name="date" placeholder="date"  id="installationDate" required>
          <label for="date">Date</label>
          <script>installationDate.min = new Date().toLocaleDateString('en-ca')</script>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="form-floating  mb-3 ">
        <textarea class="form-control"  name="comments" placeholder="comments" style="height: 200px" ></textarea>
        <label for="comments">Additional comments</label>
      </div>
    </div>
    <div class="col">
        <div class="row">
            <label style="display: inline-block">
                <input type="checkbox" id="accept" name="accept" value="accept">
                I agree to be registered as a client of <?php echo $_SESSION["company_name"]; ?></label>
        </div>
    </div>
    <div class="form-group mt-3 text-center">
        <input type="submit" class="btn btn-lg btn-primary" value="Submit">
        <button onclick="location.href='viewCompanies.php'"class="btn btn-lg btn-primary">Back</button>
    </div>
    <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $booking_success;?></div>
    <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $booking_failed;?></div>

    </form>
</div>
<?php include_once('jsLinks.php');?>
</body>
</html>
