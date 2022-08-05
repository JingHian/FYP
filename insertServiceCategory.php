<?php
session_start();
include_once ("conn.php");
include_once ("classes.php");
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";
 $insertService_success = "";

    //automatically create the services table if not exist yet when the company clicks add service category
   $servicesTable = "CREATE TABLE IF NOT EXISTS services (
        service_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
        service_name VARCHAR(60) NOT NULL)";

    mysqli_query($conn, $servicesTable);

    $name = $_POST['servicename'] ?? "";
    $tableName = "services";

  if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){
        if ($name == "") {
            echo "";
        } else {
            try {
                $sql = "INSERT INTO $tableName (service_name) VALUES " . "('$name')";
                //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
                mysqli_query($conn, $sql);

              $insertService_success = "Service Category $name has been added.";

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

        <title>Add New Service Category</title>
    </head>
    <body>
        <div class="container" >
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Add New Service Category</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class ="display-6 fs-5">Enter Service Name</p>
                </div>
            </div>
        </div>

        <div class="container ">
            <form id="servicedetails" class="form-horizontal-2" action="insertServiceCategory.php" method="post">
            <?php
             $rand=rand();
             $_SESSION['rand']=$rand;
            ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
            <div class="row">
                <div class="col">
                    <div class="form-floating mb-3 ">
                        <input type="text" class='form-control' name="servicename" placeholder="Service Name" required>
                        <label for="servicename">Service Name</label>
                    </div>
                </div>
            </div>

                <div class="form-group mt-3 text-center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Add">
                </div>
                  <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $insertService_success;?></div>
            </form>
        </div>

    <?php include_once('jsLinks.php');?>
    </body>
</html>
