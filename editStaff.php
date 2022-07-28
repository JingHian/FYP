<?php
session_start();
include_once('conn.php');
include_once('classes.php');
include_once('navbar.php');
include_once('cssLinks.php');
include_once "logInCheck.php";
$staff = new Company();
$edit_success = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['edit_values'] == "false") {
  $staff_ID = $_SESSION['staff_ID'];
  $staff_name = $_SESSION['staff_name'];
  $staff_email = $_SESSION['staff_email'];
  $staff_phone = $_SESSION['staff_phone'];
  $staff_role = $_SESSION['staff_role'];
}
else {
  $staff->updateStaff($_SESSION['staff_ID'],$_POST['staff_name'],$_POST['staff_email'],$_POST['staff_phone'],$_POST['staff_role']);
  $staff_name = $_POST['staff_name'];
  $staff_email = $_POST['staff_email'];
  $staff_phone = $_POST['staff_phone'];
  $staff_role = $_POST['staff_role'];
  $edit_success = "Staff ".$staff_name. "'s details have been updated!";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Staff</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Edit Staff</h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Enter details to edit</p>
                </div>
            </div>
        </div>

        <div class="container form-horizontal">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_name" placeholder="Staff Name" value = "<?php echo $staff_name?>" required>
                        <label for="staff_name">Staff Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_email" placeholder="Email" value = "<?php echo $staff_email?>" required>
                        <label for="staff_email">Staff Email</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="number" class='form-control' name="staff_phone" placeholder="Staff Phone Number" value = "<?php echo $staff_phone?>" required>
                        <label for="staff_phone">Staff Phone Number</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staff_role" placeholder="Staff role" value = "<?php echo $staff_role?>" required>
                        <label for="staff_role">Staff Role</label>
                    </div>
                </div>
            </div>
                <div class="form-group mt-3 text-center">
                    <input type ="hidden" name="edit_values" value = "true" />
                    <input type ="hidden" name="staff_ID" value =" <?php echo $_SESSION['staff_ID']?> "/>
                    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Save Changes">
                    <a class="btn btn-lg btn-primary" href="viewStaff.php">Back to Staff List</a>
                </div>
                  <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $edit_success;?></div>
            </form>
        </div>



    </body>
</html>
