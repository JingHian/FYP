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
   $equipmentTable = "CREATE TABLE IF NOT EXISTS Maintenance_Staff (
        staff_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        company_ID int(11) NOT NULL,
        staff_role varchar(30) NOT NULL,
        staff_name VARCHAR(60) NOT NULL,
        email VARCHAR(30) NOT NULL,
        phone int(20) NOT NULL)";

    mysqli_query($conn, $equipmentTable);
 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Add New Staff</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Add New Staff</h1>
            <div class="row justify-content-center">
                <div class="col-6 text-center">
                    <p class ="display-6 fs-5">Enter Staff Details</p>
                </div>
            </div>
        </div>

        <div class="container form-horizontal">
            <form id="staffdetails" action="insertStaff.php" method="post">
                
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staffname" placeholder="Staff Name" required>
                        <label for="staffname">Staff Name</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staffemail" placeholder="Email" required>
                        <label for="staffemail">Staff Email</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="number" class='form-control' name="staffphonenumber" placeholder="Staff Phone Number" required>
                        <label for="phonenumber">Staff Phone Number</label>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="staffrole" placeholder="Staff role" required>
                        <label for="staffrole">Staff Role</label>
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
                width: 700px;
                margin: 0 auto;
            }
        </style>

        <?php
            $CID = $_SESSION['ID'];
            $name = $_POST['staffname'] ?? "";
            $email = $_POST['staffemail'] ?? "";
            $phoneNumber = $_POST['staffphonenumber'] ?? "";
            $role = $_POST['staffrole'] ?? "";
            $tableName = "maintenance_staff";
            $companyName = $_SESSION['name'] ?? "";
        
            if (isset($_POST['submit'])) {
                if ($name == "") {
                    echo "";
                } else {
                    try {
                        $sql = "INSERT INTO $tableName (company_ID, staff_role, staff_name, email, phone) VALUES " . "('$CID', '$role', '$name', '$email', '$phoneNumber')";
                        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
                        mysqli_query($conn, $sql);
                        echo "<p class=text-center>Staff $name has been inserted to $companyName</p>"; 

                    }  catch (mysqli_sql_exception $e) {
                        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
                    }
                }
                
            }
            
        ?>


    </body>
</html>