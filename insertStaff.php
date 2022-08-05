<?php
session_start();
include_once ("conn.php");
include_once ("classes.php");
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";
 $insertStaff_success = "";

    //automatically create the equipment table if not exist yet when the company clicks add equipment
   $equipmentTable = "CREATE TABLE IF NOT EXISTS Maintenance_Staff (
        staff_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        company_ID int(11) NOT NULL,
        staff_role varchar(30) NOT NULL,
        staff_name VARCHAR(60) NOT NULL,
        email VARCHAR(30) NOT NULL,
        status VARCHAR(30) NOT NULL,
        phone int(20) NOT NULL)";

    mysqli_query($conn, $equipmentTable);


    $CID = $_SESSION['ID'];
    $name = $_POST['staffname'] ?? "";
    $email = $_POST['staffemail'] ?? "";
    $phoneNumber = $_POST['staffphonenumber'] ?? "";
    $role = $_POST['staffrole'] ?? "";
    $tableName = "maintenance_staff";
    $companyName = $_SESSION['name'] ?? "";

  if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){
        if ($name == "") {
            echo "";
        } else {
            try {
                $sql = "INSERT INTO $tableName (company_ID, staff_role, staff_name, email, phone,status) VALUES " . "('$CID', '$role', '$name', '$email', '$phoneNumber','Not Assigned')";
                //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
                mysqli_query($conn, $sql);

              $insertStaff_success = "Staff $name has been added to $companyName.";

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
        <title>Add New Staff</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Add New Staff</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class ="display-6 fs-5">Enter Staff Details</p>
                </div>
            </div>
        </div>

        <div class="container ">
            <form id="staffdetails" class="form-horizontal-2" action="insertStaff.php" method="post">
            <?php
             $rand=rand();
             $_SESSION['rand']=$rand;
            ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
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

                <div class="form-group mt-3 text-center">
                    <input type="submit" class="btn btn-lg btn-primary" name="submit" value="Submit">
                </div>
                  <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $insertStaff_success;?></div>
            </form>
        </div>

    </body>
</html>
