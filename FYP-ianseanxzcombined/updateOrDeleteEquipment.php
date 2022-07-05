<?php 
session_start(); 
 include_once('navbar.php');
 include_once('cssLinks.php');
 //include_once "logInCheck.php";

if (isset($_POST['submit']) || isset($_POST['remove'])) {
    $_SESSION['equipmentid'] = $_POST['equipmentid']??"";
    $equipmentID = $_POST['equipmentid'] ?? "";
} else {
    $equipmentID = $_GET['id'];
}

?>
 
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fyp";

    // Create connection
    try {
    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    } catch ( mysqli_sql_exception $e) {
        die("Connection failed: " . mysqli_connect_error());
    }    

    try {
        $selectQuery = "select * from maintenance_equipment where equipment_id = $equipmentID";
        $result = mysqli_query($conn, $selectQuery);

    } catch (Exception $e){
        echo "<br><br>No enquiries are found.<br><br>";
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }

    while (($Row = mysqli_fetch_assoc($result)) != FALSE) {
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Edit Equipment</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Edit Existing Equipment</h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Enter Equipment Details</p>
                </div>
            </div>
        </div>

        <div class="container form-horizontal">
            <form id="equipmentdetails" action="updateOrDeleteEquipment.php" method="post">
                
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="equipmentname" placeholder="Equipment Name"  value = <?php echo $Row['equipment_name']?> required>
                        <label for="equipmentname">Equipment Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <input type="number" class='form-control' name="equipmentquantity" placeholder="Quantity" value = <?php echo $Row['quantity']?> required> 
                        <label for="equipmentquantity">Quantity</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                    <input type="date" class='form-control' name="installationdate" placeholder="Installation Date" value = <?php echo $Row['installation_date']?> equired>
                        <label for="installationdate">Installation Date</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <input type="date" class='form-control' name="warrantydate" placeholder="Warranty Date" value = <?php echo $Row['warranty_date']?> required>
                        <label for="warrantydate">Warranty Date</label>
                    </div>
                </div>

                <div class="col">
                    <div class="form-floating mb-3">
                    <input type="date" class='form-control' name="expirydate" placeholder="Expiry Date" value = <?php echo $Row['expirydate']?> required>
                        <label for="expirydate">Expiry Date</label>
                    </div>
                </div>
            </div>

                <div class="form-group mt-3 text-center">
                    <input type ="hidden" name="equipmentid" value = <?php echo $equipmentID?> />
                    <input type="submit" class="btn btn-primary" name="submit" value="Edit">
                    <input type="submit" class="btn btn-primary" name="remove" value="Remove">
                </div>
            </form>
        </div>

        <style>
            .row {
                width: 800px;
                margin: 0 auto;
            }
        </style>

        <?php
            }//end of the big while loop

            $equipmentName = $_POST['equipmentname'] ?? "";
            $equipmentQuantity = $_POST['equipmentquantity'] ?? "";
            $installationDate = $_POST['installationdate'] ?? "";
            $warrantyDate = $_POST['warrantydate'] ?? "";
            $expiryDate = $_POST['expirydate'] ?? "";
            $tableName = "maintenance_equipment";
        
            if (isset($_POST['submit'])) {
                if ($equipmentName == "") {
                    echo "";
                } else {
                    try {
                        $sql = "UPDATE maintenance_equipment set equipment_name = '$equipmentName', quantity = $equipmentQuantity, installation_date = '$installationDate', warranty_date = '$warrantyDate', expirydate = '$expiryDate' where equipment_ID = '$equipmentID'";
                        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
                        mysqli_query($conn, $sql);
                        echo "<p class=text-center>Equipment $equipmentName details has been updated</p>";

                    }  catch (mysqli_sql_exception $e) {
                        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
                    }
                }
                
            }

            if (isset($_POST['remove'])) {
                if ($equipmentName == "") {
                    echo "";
                } else {
                    try {
                        $sql = "DELETE from maintenance_equipment where `equipment_ID` = '$equipmentID'";
                        mysqli_query($conn, $sql);
                        echo "<p class=text-center>Equipment $equipmentName has been deleted</p>"; 

                    }  catch (mysqli_sql_exception $e) {
                        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
                    }
                }
                
            }
            
        ?>


    </body>
</html>