<?php
// Initialize the session
session_start();

include("conn.php");
include_once("classes.php");
// Check if the user is logged in, if not then redirect him to login page
include_once "logInCheck.php";
include_once "conn.php";
$admin = new Admin();
$delete_success ='';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Remove']))
{
  $ready_delete = 0;
  $_SESSION['service_ID'] = $_POST["service_ID"];
  $_SESSION['service_name'] = $_POST["service_name"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete']))
{
  $admin->deleteService($_SESSION['service_ID']);
  $ready_delete = 1;
  $delete_success = "Service ". $_SESSION['service_name']." has been deleted.";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Delete Service</title>
    <?php include_once('cssLinks.php');?>

</head>
<body>
    <?php include_once('navbar.php');?>
    <div class="container" >
    <h1 class ="display-5 text-center" style="margin-top:50px;">Delete Service '<?php echo $_SESSION['service_name'];?>'</h1>
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
  </div>
    </div>
  </div>
    <div class ="container ">
    <?php
      if ($ready_delete == 0)
      {
        echo '<div class="alert alert-danger text-center booking-alert mt-3 form-horizontal-2" role="alert">Are you sure you want to delete the Service \''.$_SESSION["service_name"].'\' from the system?</div>';
      }
    ?>
    <div class="alert alert-success text-center booking-alert mt-3 form-horizontal-2" role="alert"><?php echo $delete_success; ?></div>
  </div>
  <div class="form-group mb-2 mt-4 text-center">
    <form class="form-horizontal" id="form_Comp" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <?php
        if ($ready_delete == 0)
        {
          echo' <input type="submit" class="btn me-5 btn-lg btn-danger"  name="Delete" value="Confirm">';
        }
      ?>
      <a class="btn btn-lg btn-primary" href="viewServiceAdmin.php">Back to Services</a>
    </form>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
