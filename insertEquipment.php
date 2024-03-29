<?php
session_start();
include_once ("conn.php");
include_once ("classes.php");
include_once('navbar.php');
include_once('cssLinks.php');
include_once "logInCheck.php";
$insertEquipment_success = "";

    //automatically create the equipment table if not extist yet when the company clicks add equipment
   $equipmentTable = "CREATE TABLE IF NOT EXISTS Maintenance_Equipment (
    equipment_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    company_ID int(11) NOT NULL,
    equipment_name varchar(30) NOT NULL,
    quantity int(15) NOT NULL,
    installation_date VARCHAR(15) NOT NULL,
    warranty_date VARCHAR(15) NOT NULL,
    expiry_date VARCHAR(15) NOT NULL)";

mysqli_query($conn, $equipmentTable);


$CID = $_SESSION['ID'];
$equipmentName = $_POST['equipmentname'] ?? "";
$equipmentQuantity = $_POST['equipmentquantity'] ?? "";
$installationDate = $_POST['installationdate'] ?? "";
$warrantyDate = $_POST['warrantydate'] ?? "";
$expiry_date = $_POST['expiry_date'] ?? "";
$tableName = "Maintenance_Equipment";
$companyName = $_SESSION['name'] ?? "";

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['randcheck']==$_SESSION['rand']){
    if ($equipmentName == "") {
        echo "";
    } else {
        try {
            $sql = "INSERT INTO $tableName (company_ID, equipment_name, quantity, installation_date, warranty_date, expiry_date) VALUES " . "('$CID', '$equipmentName', '$equipmentQuantity', '$installationDate', '$warrantyDate', '$expiry_date')";
            //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
            mysqli_query($conn, $sql);

            $insertEquipment_success = "Equipment $equipmentName has been added to $companyName.";

        }  catch (mysqli_sql_exception $e) {
            echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
        }
    }

}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Add New Equipment</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Add New Equipment</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class ="display-6 fs-5">Enter Equipment Details</p>
                </div>
            </div>
        </div>

        <div class="container">
            <form class=" form-horizontal-2" action="insertEquipment.php" method="post">
            <?php
             $rand=rand();
             $_SESSION['rand']=$rand;
            ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="equipmentname" placeholder="Equipment Name" required>
                        <label for="equipmentname">Equipment Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <input type="number" class='form-control' name="equipmentquantity" placeholder="Quantity" required>
                        <label for="equipmentquantity">Quantity</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                    <input type="date" class='form-control' name="installationdate" placeholder="Installation Date" required>
                        <label for="installationdate">Installation Date</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <input type="date" class='form-control' name="warrantydate" placeholder="Warranty Date" required>
                        <label for="warrantydate">Warranty Date</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                    <input type="date" class='form-control' name="expiry_date" placeholder="Expiry Date" required>
                        <label for="expiry_date">Expiry Date</label>
                    </div>
                </div>
            </div>


                <div class="form-group mt-3 text-center">
                    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Submit">
                </div>
                  <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $insertEquipment_success;?></div>
            </form>
        </div>

    </body>
</html>
