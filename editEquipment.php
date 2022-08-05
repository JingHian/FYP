<?php
session_start();
include_once('conn.php');
include_once('classes.php');
include_once('navbar.php');
include_once('cssLinks.php');
include_once "logInCheck.php";
$equipment = new Company();
$edit_success = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['edit_values'] == "false") {
  $equipment_ID = $_SESSION['equipment_ID'];
  $equipment_name = $_SESSION['equipment_name'];
  $quantity = $_SESSION['quantity'];
  $installation_date = $_SESSION['installation_date'];
  $warranty_date = $_SESSION['warranty_date'];
  $expiry_date = $_SESSION['expiry_date'];
}
else {
  $equipment->updateEquipment($_SESSION['equipment_ID'],$_POST['equipment_name'],$_POST['quantity'],$_POST['installation_date'],$_POST['warranty_date'],$_POST['expiry_date']);
  $equipment_name = $_POST['equipment_name'];
  $quantity = $_POST['quantity'];
  $installation_date = $_POST['installation_date'];
  $warranty_date = $_POST['warranty_date'];
  $expiry_date = $_POST['expiry_date'];
  $edit_success = "Equipment ".$equipment_name. "'s details have been updated!";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Edit Equipment</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Edit Equipment</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class ="display-6 fs-5">Enter details to edit</p>
                </div>
            </div>
        </div>

        <div class="container form-horizontal">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="equipment_name" placeholder="Equipment Name" value = "<?php echo $equipment_name?>" required>
                        <label for="equipment_name">Equipment Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="quantity" placeholder="Quantity" value = "<?php echo $quantity?>" required>
                        <label for="quantity">Equipment Email</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="date" class='form-control' name="installation_date" placeholder="Installation Date" value = "<?php echo $installation_date?>" required>
                        <label for="installation_date">Installation Date</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="date" class='form-control' name="warranty_date" placeholder="Warranty Date" value = "<?php echo $warranty_date?>" required>
                        <label for="warranty_date">Warranty Date</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="date" class='form-control' name="expiry_date" placeholder="Expiry Date" value = "<?php echo $expiry_date?>" required>
                        <label for="expiry_date">Expiry Date</label>
                    </div>
                </div>
            </div>
                <div class="form-group mt-3 text-center">
                    <input type ="hidden" name="edit_values" value = "true" />
                    <input type ="hidden" name="equipment_ID" value =" <?php echo $_SESSION['equipment_ID']?> "/>
                    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Save Changes">
                    <a class="btn btn-lg btn-primary" href="viewEquipment.php">Back to Equipment List</a>
                </div>
                  <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $edit_success;?></div>
            </form>
        </div>



    </body>
</html>
