<?php
session_start();
include_once "conn.php";
include_once "logInCheck.php";
include_once "classes.php";
include_once "navbar.php";

$id = $_SESSION["ID"] ?? "";
$name = $_POST["servicename"] ?? "";
$userType = $_SESSION["user_type"] ?? "";

if (!empty($_POST["servicename"])) {

    //if there is no records in the service table
    $checkServiceTable = mysqli_query($conn, "SELECT * from Services where service_name = '$name'");
    $numRowsServices = mysqli_num_rows($checkServiceTable);

    if ($userType == "homeowner") {
        try {
            if ($numRowsServices == 0){
                $insertToServices = "INSERT INTO Services " . "(service_name) VALUES " . "('$name')";
                @mysqli_query($conn, $insertToServices);

                $successMessage = "Service $name has been added to the system.";

                $getServiceID = mysqli_query($conn, "SELECT service_ID from Services where service_name = '$name'");
                $serviceID = $getServiceID->fetch_array()[0] ?? '';

                $insertToHomeownerServices = "INSERT INTO Homeowner_Services " . "(service_ID, homeowner_ID) VALUES " . "('$serviceID', '$id')";
                @mysqli_query($conn, $insertToHomeownerServices);

            } else if ($numRowsServices > 0) {

                $getServiceID = mysqli_query($conn, "SELECT service_ID from Services where service_name = '$name'");
                $serviceID = $getServiceID->fetch_array()[0] ?? '';

                //check if service exist to avoid duplicate input
                //check if service exist to avoid duplicate input
                $checkExist = mysqli_query($conn, "SELECT * from Homeowner_Services join Services on Homeowner_Services.service_id = Services.service_id
                where Services.service_name = '$name' and Homeowner_Services.homeowner_id = {$_SESSION['ID']}");
                $numRowsServicesHomeowner = mysqli_num_rows($checkExist);

                if ($numRowsServicesHomeowner >= 1) {
                      $fail_message ="Service $name already exists!";
                } else if ($numRowsServicesHomeowner < 1) {
                    $sql = "INSERT INTO Homeowner_Services " . "(service_ID, homeowner_ID) VALUES " . "('$serviceID', '$id')";
                    @mysqli_query($conn, $sql);

                    $successMessage = "Service $name has been added";
                }
            }

        }

        catch (mysqli_sql_exception $e) {
            echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn) ."</p>";

        }

    } else if ($userType == "company") {

        try {
            if ($numRowsServices == 0){
                $insertToServices = "INSERT INTO Services " . "(service_name) VALUES " . "('$name')";
                @mysqli_query($conn, $insertToServices);

                $successMessage = "A new service $name has been inserted to the system.";

                $getServiceID = mysqli_query($conn, "SELECT service_ID from Services where service_name = '$name'");
                $serviceID = $getServiceID->fetch_array()[0] ?? '';

                $insertToCompanyServices = "INSERT INTO Company_Services " . "(service_ID, company_ID) VALUES " . "('$serviceID', '$id')";
                @mysqli_query($conn, $insertToCompanyServices);

            } else if ($numRowsServices > 0) {

                $getServiceID = mysqli_query($conn, "SELECT service_ID from Services where service_name = '$name'");
                $serviceID = $getServiceID->fetch_array()[0] ?? '';

                //check if service exist to avoid duplicate input
                $checkExist = mysqli_query($conn, "SELECT * from Company_Services join Services on Company_Services.service_id = Services.service_id
                where Services.service_name = '$name' and Company_Services.company_id = {$_SESSION['ID']}");
                $numRowsServicesCompany = mysqli_num_rows($checkExist);

                if ($numRowsServicesCompany >= 1) {
                    $fail_message = "Service $name already exists.";
                } else if ($numRowsServicesCompany < 1) {
                    $sql = "INSERT INTO Company_Services " . "(service_ID, company_ID) VALUES " . "('$serviceID', '$id')";
                    @mysqli_query($conn, $sql);

                    $successMessage = "Service $name has been inserted";
                }
            }

        }

        catch (mysqli_sql_exception $e) {
            echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn) ."</p>";

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
            <form id="servicedetails" class="form-horizontal-2" action="insertServiceHomeownerAndCompany.php" method="post">
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
                <div class="alert alert-success text-center booking-alert mt-3" role="alert"><?php echo $successMessage ?? "";?></div>
                <div class="alert alert-danger text-center booking-alert mt-3" role="alert"><?php echo $fail_message ?? "";?></div>
            </form>
        </div>

    <?php include_once('jsLinks.php');?>
    </body>


</html>
