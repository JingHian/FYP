<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$enquiry_success = "";
$reply = "";
$_SESSION['case_ID'] = $_POST['case_ID'];
$_SESSION['homeowner_name'] = $_POST['homeowner_name'];


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
      <h1 class ="display-5 text-center" style="margin-top:50px;">Case #<?php echo $_SESSION['case_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">View and reply to case.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="reply_case" class ="form-horizontal-2" action="replySuccess.php" method="post">
      <input type="hidden" name="case_ID" value ="<?php echo $_SESSION['case_ID']; ?>">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="homeowner_name" name="homeowner_name" placeholder="homeowner_name" value ="<?php echo $_POST['homeowner_name']; ?>" disabled>
            <label for="homeowner_name">Homeowner name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="case_subject" name="case_subject" placeholder="case_subject" value ="<?php echo $_POST['case_subject']; ?>" disabled>
            <label for="case_subject">Subject</label>
          </div>
        </div>
        <div class="row">
            <div class="col">
              <div class="form-floating  mb-3 ">
                <input type="text" class="form-control" id="case_date" name="case_date" placeholder="<?php $_POST['case_date']; ?>" value="<?php echo $_POST['case_date']; ?>" disabled>
                <label for="case_date">Case Date</label>
              </div>
            </div>

            <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="case_status" name="case_status"placeholder="case_status" value="<?php echo $_POST['case_status']; ?>" disabled>
              <label for="case_status">Case Status</label>
            </div>
          </div>

          </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px" disabled><?php echo $_POST['case_description']; ?></textarea>
            <label for="enquirydetails">Enquiry Details</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea  class="form-control" name="reply" placeholder="reply" style="height: 200px" ></textarea>
            <label for="reply">Reply</label>
          </div>
        </div>

    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn  btn-primary" value="Reply Homeowner">
    </div>
    <p class="text-center" style  ="color:green"><?php echo $enquiry_success;?></p>
  </form>
</div>


    </body>



</html>
