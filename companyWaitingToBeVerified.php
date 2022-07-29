<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
include_once('navbar.php');
include_once('jsLinks.php');
include_once('cssLinks.php');
echo "<title>Company Details</title>";


if($_SERVER["REQUEST_METHOD"] == "POST"){
  $_SESSION["company_ID"] = $_POST["company_ID"];
  $_SESSION["company_name"]= $_POST["name"];
  $company_ID = $_POST["company_ID"];
  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];
  $postal_code = $_POST["postal_code"];

try {
    $query = "SELECT GROUP_CONCAT(serv.service_name SEPARATOR ', ') as service_grouped
    FROM Company AS comp
    JOIN Company_Services AS cs
    ON comp.company_ID = cs.company_ID
    JOIN Services As serv
    ON cs.service_ID = serv.service_ID
    where comp.company_ID = $company_ID";

    $getService = mysqli_query($conn, $query);

    while (($row = mysqli_fetch_array($getService)) != FALSE) {
      $services =  $row["service_grouped"];
    }
} catch (Exception $e){
    echo "<br><br>No services are found.<br><br>";
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
<title>Change Details</title>
</head>
<body>
  <?php include_once('navbar.php');?>
  <div class="container" >
  <h1 class ="display-5 text-center" style="margin-top:50px;">Approve or Reject Company Application</h1>
  <div class="row justify-content-center">
    <div class="col-6 text-center">
  <p class ="display-6 fs-5" name = "product" value ="avail">Check the Company's details and approve or reject their application.</p>
</div>
  </div>
</div>
<div class="container justify-content-center"  style="text-align: center;">
<div class="container">
    <form class ="form-horizontal-2" action="companyVerificationResult.php" method="post">
    <div class="row">
        <div class="col">
          <div class="form-floating  mb-3 ">
            <input type="text" class="form-control" id="company_ID" name="company_ID" placeholder="company_ID" value="<?php echo $company_ID; ?>" disabled>
            <label for="company_ID">Company ID</label>
          </div>
        </div>

        <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name"placeholder="name" value="<?php echo $name; ?>"disabled>
          <label for="name">Name</label>
        </div>
      </div>

      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>"disabled>
          <label for="email">Email</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="number" class="form-control" id="phone" name="phone" placeholder="phone" value="<?php echo $phone; ?>"disabled>
          <label for="phone">Phone</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>"disabled>
          <label for="address">Address</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="postal_code" name="postal_code"placeholder="postal_code" value="<?php echo $postal_code; ?>" disabled>
          <label for="postal_code">Postal Code</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <textarea style="height: 150px" class="form-control" id="services" name="services"placeholder="services"disabled><?php echo $services; ?></textarea>
          <label for="services">Services</label>
        </div>
      </div>



    <div class="form-group mb-2 mt-3 text-center">
          <input  class='btn btn-lg btn-primary' type="submit" name="approve" value="Approve">
          <input  class='btn btn-lg btn-danger' type="submit" name="reject" value="Reject">
      </form>
    </div>

  </form>
</div>
<?php include_once('jsLinks.php');?>

</body>
</html>
