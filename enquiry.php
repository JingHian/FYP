<?php session_start();

include("conn.php");

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}

  $enquiry_success = "";

  $getcompanyname = mysqli_query($conn, "select name from company");
  //$companyname = $getcompanyname->fetch_array()[0] ?? '';


  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $companyName = $_POST['company'] ?? "";
    $subject = $_POST['enquirysubject'] ?? "";
    $details = $_POST['enquirydetails'] ?? "";
    $homeownerName = $_SESSION['name'] ?? "";
    $tableName = "Cases";
    $getHID = mysqli_query($conn, "select homeowner_ID from homeowners where name = ". "'$homeownerName'");
    $HID = $_SESSION["ID"];

    $getCID = mysqli_query($conn, "select company_ID from company where name = ". "'$companyName'");
    $CID = $getCID->fetch_array()[0] ?? '';

     //automatically create the table if not extist yet when the homeowner clicks the eqnuries menu
     $casesTable = "CREATE TABLE IF NOT EXISTS Cases (
        case_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        case_subject VARCHAR(30) NOT NULL,
        company_ID int(11) NOT NULL,
        homeowner_ID int(11) NOT NULL,
        case_date VARCHAR(15) NOT NULL,
        case_status VARCHAR(10) NOT NULL,
        case_description VARCHAR(500) NOT NULL)";

    mysqli_query($conn, $casesTable);

  if ($companyName == "") {
      echo "";
  } else {
      try {
          $sql = "INSERT INTO $tableName (case_subject, company_ID, homeowner_ID, case_date, case_status, case_description) VALUES " . "('$subject', '$CID', '$HID', curdate(), 'Awaiting', '$details')";
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
        <?php include('cssLinks.php');?>
        <title>Enquiry</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Send an Enquiry</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Please enter details.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

    <div class="col">
        <div class="condi-dropdown mb-3">
          <select id="company" class="form-select" name="company" form="enquirydetails" required>
              <option value="" default>Select a Company</option>
              <?php while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) { ?>
                  <option value="<?php echo $Row['name'];?>"> <?php echo $Row['name'];}?>
                  </option>
          </select>
        </div>
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
    <p class="text-center" style  ="color:green"><?php echo $enquiry_success;?></p>
  </form>
</div>


    </body>



</html>
