<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

//automatically create the table if not exists yet when the user clicks the review company menu
$ratingTable = "CREATE TABLE IF NOT EXISTS Ratings (
    rating_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    company_ID INT(10) NULL,
    homeowner_ID int(10) NOT NULL,
    score decimal(5,1) NOT NULL,
    review VARCHAR(500) NOT NULL)";

mysqli_query($conn, $ratingTable);

$homeownerID = $_SESSION['ID'];

$companiesList = "select company.name from clients join company on clients.company_ID = company.company_ID where clients.homeowner_ID = $homeownerID";
$result = mysqli_query($conn, $companiesList);
?>

<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Rate and Review Company</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
        <div class="container" >
            <h1 class ="display-5 text-center" style="margin-top:50px;">Rate and Review a Company</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <p class ="display-6 fs-5">Please select, rate, and review a company.</p>
                    </div>
                </div>
        </div>
        <br>
        <div class="container">
            <form class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <div class="container text-center">
                    <div class="form-floating mb-3">
                        <select name="companyname" id="companyname" required>
                            <option value="">Select a company</option>
                            <?php
                                while (($Row = mysqli_fetch_assoc($result)) != FALSE) { ?>
                                <option value="<?php echo $Row['name'];?>"><?php echo $Row['name'];?></option>
                            <?php } ?>
                        </select>
                        <br> <br>
                          <select id="companyrating" name="companyrating" required>
                            <option value="" default disabled>Rate</option>
                            <option value="1">★☆☆☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="4">★★★★☆</option>
                            <option value="5">★★★★★</option>
                        </select>
                    </div>
                </div>

                <br>

                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <textarea class="form-control" id="reviewdetails" name="reviewdetails" placeholder="reviewdetails" style="height: 200px"></textarea>
                        <label for="enquirydetails">Review Details</label>
                    </div>
                </div>

                <div class="form-group mb-2 mt-3 text-center">
                    <input type="submit" name="submit" class="btn  btn-primary" value="Submit Review">
                </div>

            </form>
        </div>
    </body>
</html>

<?php
$chosenCompany = $_POST['companyname'] ?? "";
$ratingGiven = $_POST['companyrating'] ?? "";
$reviewDetails = $_POST['reviewdetails'] ?? "";

if (isset($_POST['submit'])) {

    $getCompanyID = mysqli_query($conn, "select company_ID from company where name = '$chosenCompany'");
    $companyID = $getCompanyID->fetch_array()[0] ?? '';

    try {
        $storeReview = "insert into ratings (company_ID, homeowner_ID, score, review) values ($companyID, $homeownerID, $ratingGiven, '$reviewDetails')";
        mysqli_query($conn, $storeReview);

        echo "review has been sent to $chosenCompany";

    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }

}

?>
