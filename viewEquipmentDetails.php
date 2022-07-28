<?php
session_start();
 include_once('conn.php');
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['equipment_ID'] = $_POST['equipment_ID'];
    $_SESSION['equipment_name'] = $_POST['equipment_name'];
    $_SESSION['quantity'] = $_POST['quantity'];
    $_SESSION['installation_date'] = $_POST['installation_date'];
    $_SESSION['warranty_date'] = $_POST['warranty_date'];
    $_SESSION['expiry_date'] = $_POST['expiry_date'];
    $equipment_ID = $_SESSION['equipment_ID'];
    $equipment_name = $_SESSION['equipment_name'];
    $quantity = $_SESSION['quantity'];
    $installation_date = $_SESSION['installation_date'];
    $warranty_date = $_SESSION['warranty_date'];
    $expiry_date = $_SESSION['expiry_date'];
  }
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title><?php echo "Equipment " . $equipment_name . "'s Details";?></title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Equipment #<?php echo $equipment_ID;?></h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Equipment Details</p>
                </div>
            </div>
        </div>
        <div class="container form-horizontal">
            <form action="editEquipment.php" method="post">

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="equipment_name" placeholder="Equipment Name" value = "<?php echo $equipment_name?>" disabled>
                        <label for="equipment_name">Equipment Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="quantity" placeholder="Email" value =" <?php echo $quantity?> "disabled>
                        <label for="quantity">Equipment Quantity</label>
                    </div>
                </div>
            </div>

            <div class="row">
              <div class="col">
                  <div class="form-floating mb-3 ">
                      <input type="date" class='form-control' name="installation_date" placeholder="Installation Date" value = "<?php echo $installation_date?>" disabled>
                      <label for="installation_date">Installation Date</label>
                  </div>
              </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="date" class='form-control' name="warranty_date" placeholder="Warranty Date" value = "<?php echo $warranty_date?>" disabled>
                        <label for="warranty_date">Warranty Dat</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="date" class='form-control' name="expiry_date" placeholder="Expiry Date" value = "<?php echo $expiry_date?>" disabled>
                        <label for="expiry_date">Expiry Date</label>
                    </div>
                </div>
            </div>
                <div class="form-group mt-3 text-center">
                  <input type ="hidden" name="edit_values" value = "false" />
                  <input type ="hidden" name="equipment_ID" value = "<?php echo $_SESSION['equipment_ID']?>" />
                  <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Edit">
                  <a href="deleteEquipment.php" class="btn btn-lg btn-primary" name="remove" value="Remove">Delete</a>
                </div>
            </form>
        </div>

    </body>
</html>
