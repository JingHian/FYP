<?php session_start();

include("conn.php");
include_once "logInCheck.php";
include_once "classes.php";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

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
      <h1 class ="display-5 text-center" style="margin-top:50px;">Enquiry #<?php echo $_POST['case_ID'];?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">check the details of your enquiry here.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="to_company" name="to_company" placeholder="to_company" value ="<?php echo $_POST['company_name'];?>" disabled>
            <label for="to_company">To: </label>
          </div>
        </div>

        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="Subject" name="Subject" placeholder="Subject" value ="<?php echo $_POST['case_subject'];?>" disabled>
            <label for="Subject">Subject</label>
          </div>
        </div>
        <div class="row">
          <div class ="col-md-6">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="case_date" name="case_date" placeholder="case_date" value ="<?php echo $_POST['case_date'];?>" disabled>
            <label for="case_date">Date</label>
          </div>
        </div>

        <div class ="col-md-6">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="case_status" name="case_status" placeholder="case_status" value ="<?php echo $_POST['case_status'];?>" disabled>
          <label for="case_status">Status</label>
        </div>
      </div>

        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px" disabled><?php echo $_POST['case_description'];?></textarea>
            <label for="enquirydetails">Enquiry Details</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control hide-reply" id="enquiry_reply" name="enquiry_reply" style="height: 200px" disabled><?php echo $_POST['case_reply'];?></textarea>
            <label for="enquiry_reply" id="reply-label">Enquiry Reply</label>
          </div>
        </div>


  </form>
  <div class="form-group mt-3 text-center form-horizontal">
      <input type="button" onClick="history.go(-1);" class="btn btn-lg btn-primary" value="Back">
  </div>
</div>

<?php include_once('jsLinks.php');?>

</body>



</html>
