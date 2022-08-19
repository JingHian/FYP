<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$enquiry_success = "";
$reply = "";
$_SESSION['enquiry_ID'] = $_POST['enquiry_ID'];
$_SESSION['enquiry_user_type'] = $_POST['user_type'];
$_SESSION['user_name'] = $_POST['name'];
// echo '<pre>' . print_r($_SESSION) . '</pre>';


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
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Enquiry #<?php echo $_SESSION['enquiry_ID'] ?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">View and reply to enquiry.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="reply_enquiry" class ="form-horizontal-2" action="replyEnquirySuccess.php" method="post">
      <input type="hidden" name="enquiry_ID" value ="<?php echo $_SESSION['enquiry_ID']; ?>">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value ="<?php echo $_POST['name']; ?>" disabled>
            <label for="name">Name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="enquiry_subject" name="enquiry_subject" placeholder="enquiry_subject" value ="<?php echo $_POST['enquiry_subject']; ?>" disabled>
            <label for="enquiry_subject">Subject</label>
          </div>
        </div>
        <div class="row">
            <div class="col">
              <div class="form-floating  mb-3 ">
                <input type="text" class="form-control" id="enquiry_date" name="enquiry_date" placeholder="<?php $_POST['enquiry_date']; ?>" value="<?php echo $_POST['enquiry_date']; ?>" disabled>
                <label for="enquiry_date">Enquiry Date</label>
              </div>
            </div>

            <div class="col">
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="enquiry_status" name="enquiry_status" placeholder="enquiry_status" value="<?php echo $_POST['enquiry_status']; ?>" disabled>
              <label for="enquiry_status">Enquiry Status</label>
            </div>
          </div>

          </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="enquiry_description" name="enquiry_description" placeholder="enquiry_description" style="height: 150px" disabled><?php echo $_POST['enquiry_description']; ?></textarea>
            <label for="enquiry_description">Enquiry Details</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea  class="form-control" name="reply" placeholder="reply" style="height: 150px" <?php if($_POST['enquiry_status'] == "Closed") {echo "disabled";}?>><?php echo $_POST['enquiry_reply']; ?></textarea>
            <label for="reply">Reply</label>
          </div>
        </div>

    <div class="form-group mb-2 mt-3 text-center">
        <?php
        if ($_POST['enquiry_status']!= "Closed")
        {
            echo "<button type=\"submit\" class=\"btn btn-lg btn-primary\" name=\"Reply\">Reply</button>
                <button type=\"submit\" class=\"btn btn-lg btn-primary\" name=\"complete\">Mark as Complete</button>";
        }
        ?>
    </div>
    <p class="text-center" style  ="color:green"><?php echo $enquiry_success;?></p>
  </form>
</div>
<?php include_once('jsLinks.php');?>
</body>



</html>
