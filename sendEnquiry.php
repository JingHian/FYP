<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$enquiry_success = "";

if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){
  $companyName = $_POST['company_name'] ?? "";
  $subject = $_POST['enquirysubject'] ?? "";
  $details = $_POST['enquirydetails'] ?? "";
  $homeownerName = $_SESSION['name'] ?? "";
  $tableName = "Cases";
  $getHID = mysqli_query($conn, "select homeowner_ID from Homeowners where name = ". "'$homeownerName'");
  $HID = $_SESSION["ID"];

  $getCID = mysqli_query($conn, "select company_ID from Company where name = ". "'$companyName'");
  $CID = $getCID->fetch_array()[0] ?? '';


if ($companyName == "") {
    echo "";
} else {
    try {
        $sql = "INSERT INTO $tableName (case_subject, company_ID, homeowner_ID, case_date, case_status, case_description) VALUES " . "('$subject', '$CID', '$HID', curdate(), 'Awaiting', '$details')";
        // printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
        @mysqli_query($conn, $sql);
        $enquiry_success = "Your enquiry has been sent to ". $companyName."!";

    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
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
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Send an Enquiry</h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Please enter details.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <?php
       $rand=rand();
       $_SESSION['rand']=$rand;
      ?>
      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div class="col">
      <?php  $company->CompanyDropDown();?>
      </div>

        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="enquirysubject" name="enquirysubject" placeholder="enquirysubject" required>
            <label for="enquirysubject">Subject</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px"></textarea>
            <label for="enquirydetails">Enquiry Details</label>
          </div>
        </div>

    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn  btn-primary" value="Submit Enquiry">
    </div>
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $enquiry_success;?></div>
  </form>
</div>

<?php include_once('jsLinks.php');?>
</body>
</html>
