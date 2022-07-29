<?php
session_start();
include_once ("conn.php");
include_once ("classes.php");
include_once('navbar.php');
include_once('cssLinks.php');
include_once "logInCheck.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION['staff_ID'] = $_POST['staff_ID'];
  $_SESSION['staff_name'] = $_POST['staff_name'];
  $_SESSION['staff_email'] = $_POST['staff_email'];
  $_SESSION['staff_phone'] = $_POST['staff_phone'];
  $_SESSION['staff_role'] = $_POST['staff_role'];
  $staff_ID = $_SESSION['staff_ID'];
  $staff_name = $_SESSION['staff_name'];
  $staff_email = $_SESSION['staff_email'];
  $staff_phone = $_SESSION['staff_phone'];
  $staff_role = $_SESSION['staff_role'];
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo "Staff " . $staff_name . "'s Details";?></title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Staff #<?php echo $staff_ID;?></h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Staff Details</p>
                </div>
            </div>
        </div>
        <div class="container form-horizontal">
            <form action="editStaff.php" method="post">

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_name" placeholder="Staff Name" value = "<?php echo $staff_name?>" disabled>
                        <label for="staff_name">Staff Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_email" placeholder="Email" value =" <?php echo $staff_email?> "disabled>
                        <label for="staff_email">Staff Email</label>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col">
                  <div class="form-floating mb-3 ">
                      <input type="number" class='form-control' name="staff_phone" placeholder="Staff Phone Number" value = "<?php echo $staff_phone?>" disabled>
                      <label for="staff_phone">Staff Phone Number</label>
                  </div>
              </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_role" placeholder="Staff role" value = "<?php echo $staff_role?>" disabled>
                        <label for="staff_role">Staff Role</label>
                    </div>
                </div>
            </div>
                <div class="form-group mt-3 text-center">
                  <input type ="hidden" name="edit_values" value = "false" />
                  <input type ="hidden" name="staff_ID" value = "<?php echo $_SESSION['staff_ID']?>" />
                  <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Edit">
                  <a href="deleteStaff.php" class="btn btn-lg btn-primary" name="remove" value="Remove">Delete</a>
                </div>
            </form>
        </div>

    </body>
</html>
