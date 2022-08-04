<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";
//print_r($_SESSION);

$enquiry_success = "";


//automatically create the table if not exists yet when the user clicks the add enquiry menu
$enquiryTable = "CREATE TABLE IF NOT EXISTS Enquiries (
enquiry_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
admin_ID INT(10) NULL, /*The id of the admin who replies the enquiry*/
`user_ID` int(11) NOT NULL,
user_type VARCHAR(15) NOT NULL,
enquiry_date VARCHAR(15) NOT NULL,
enquiry_subject VARCHAR(30) NOT NULL,
enquiry_description VARCHAR(500) NOT NULL,
enquiry_status VARCHAR(10) NOT NULL,
enquiry_reply VARCHAR(500) NULL)";

mysqli_query($conn, $enquiryTable);

if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){

$enquirySubject = $_POST['enquirysubject'] ?? "";
$enquiryDetails = $_POST['enquirydetails'] ?? "";
$userID = $_SESSION['ID'] ?? "";
$user_type = $_SESSION['user_type'] ?? "";

$tableName = "enquiries";

if ($enquirySubject == "") {
    echo "";
} else {
    try {
        //userid can be homeownerid and companyid
        $sql = "INSERT INTO $tableName (`user_ID`, user_type, enquiry_date, enquiry_subject, enquiry_description, enquiry_status) VALUES " . "('$userID', '$user_type' , curdate(), '$enquirySubject', '$enquiryDetails', 'Awaiting')";
        // printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
        @mysqli_query($conn, $sql);
        $enquiry_success = "Your enquiry has been sent to our Platform!";

    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}
}


?>

<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Enquiry To Platform</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Send an Enquiry to Us!</h1>
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <p class ="display-6 fs-5" name = "product" value ="avail">Please enter details.</p>
                    </div>
                </div>
        </div>
        <div class="container">
            <form id="enquirydetails" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <?php
             $rand=rand();
             $_SESSION['rand']=$rand;
            ?>
            <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                    <div class="col">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="enquirysubject" name="enquirysubject" placeholder="enquirysubject" required>
                            <label for="enquirysubject">Subject</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-floating  mb-3 ">
                            <textarea class="form-control" id="enquirydetails" name="enquirydetails" placeholder="enquirydetails" style="height: 200px"></textarea>
                            <label for="enquirydetails">Enquiry Details</label>
                        </div>
                    </div>

                    <div class="form-group mb-2 mt-3 text-center">
                        <input type="submit" class="btn  btn-primary" value="Submit Enquiry">
                    </div>
                    <div class="alert alert-success booking-alert text-center  mt-3" role="alert"><?php echo $enquiry_success;?></div>
            </form>
        </div>
    </body>
</html>
