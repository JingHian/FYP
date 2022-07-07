<?php 
session_start(); 
 include_once('navbar.php');
 include_once('cssLinks.php');
 //include_once "logInCheck.php";
?>
 
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fyp";
    //$searchedName = $_SESSION['inputid'] ?? "";

    // Create connection
    try {
    $conn = mysqli_connect($servername, $username, $password, $dbname); 
    } catch ( mysqli_sql_exception $e) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //automatically create the equipment table if not extist yet when the company clicks add equipment
   $equipmentTable = "CREATE TABLE IF NOT EXISTS Maintenance_Equipment (
    equipment_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    company_ID int(11) NOT NULL,
    equipment_name varchar(30) NOT NULL,
    quantity int(15) NOT NULL,
    installation_date VARCHAR(15) NOT NULL,
    warranty_date VARCHAR(15) NOT NULL,
    expirydate VARCHAR(15) NOT NULL)";

mysqli_query($conn, $equipmentTable);
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Add New Equipment</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Add New Equipment</h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Enter Equipment Details</p>
                </div>
            </div>
        </div>

        <div class="container form-horizontal">
            <form id="equipmentdetails" action="insertEquipment.php" method="post">
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
                    <input type="date" class='form-control' name="expirydate" placeholder="Expiry Date" required>
                        <label for="expirydate">Expiry Date</label>
                    </div>
                </div>
            </div>


                <!-- <input type="text" name="equipmentname" placeholder="Equipment Name" required> <br> <br>
                <input type="number" name="equipmentquantity" placeholder="Quantity" required> 
                <input type="date" name="installationdate" placeholder="Installation Date" required> <br> <br> 
                <input type="date" name="warrantydate" placeholder="Warranty Date" required>
                <input type="date" name="expirydate" placeholder="Expiry Date" required> <br> <br> 
                <input type="submit" name="submit" value="Add"> -->

                <div class="form-group mt-3 text-center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
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
            $CID = $_SESSION['ID'];
            $equipmentName = $_POST['equipmentname'] ?? "";
            $equipmentQuantity = $_POST['equipmentquantity'] ?? "";
            $installationDate = $_POST['installationdate'] ?? "";
            $warrantyDate = $_POST['warrantydate'] ?? "";
            $expiryDate = $_POST['expirydate'] ?? "";
            $tableName = "maintenance_equipment";

            // echo $CID;
            // echo $equipmentName;
            // echo $equipmentQuantity;
            // echo $installationDate;
            // echo $warrantyDate;
            // echo $expiryDate;
        
            if (isset($_POST['submit'])) {
                if ($equipmentName == "") {
                    echo "";
                } else {
                    try {
                        $sql = "INSERT INTO $tableName (company_ID, equipment_name, quantity, installation_date, warranty_date, expirydate) VALUES " . "('$CID', '$equipmentName', '$equipmentQuantity', '$installationDate', '$warrantyDate', '$expiryDate')";
                        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
                        mysqli_query($conn, $sql);
                        echo "<p class=text-center>Equipment $equipmentName has been inserted</p>"; 

                    }  catch (mysqli_sql_exception $e) {
                        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
                    }
                }
                
            }
            
        ?>


    </body>
</html>