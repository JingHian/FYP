<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";
$review_success ="";


$homeownerID = $_SESSION['ID'];

$companiesList = "SELECT Company.name from Clients join Company on Clients.company_ID = Company.company_ID where Clients.homeowner_ID = $homeownerID";
$result = mysqli_query($conn, $companiesList);

$chosenCompany = $_POST['companyname'] ?? "";
$ratingGiven = $_POST['companyrating'] ?? "";
$reviewDetails = $_POST['reviewdetails'] ?? "";

if (isset($_POST['submit']) && $_POST['randcheck']==$_SESSION['rand']) {

    $getCompanyID = mysqli_query($conn, "SELECT company_ID from Company where name = '$chosenCompany'");
    $companyID = $getCompanyID->fetch_array()[0] ?? '';

    try {
        $storeReview = "INSERT into Ratings (company_ID, homeowner_ID, score, review) values ($companyID, $homeownerID, $ratingGiven, '$reviewDetails')";
        mysqli_query($conn, $storeReview);

        $review_success = "Review has been sent to $chosenCompany!";

    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }

}
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
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Rate and Review a Company</h1>
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <p class ="display-6 fs-5">Please select, rate, and review a company.</p>
                    </div>
                </div>
        </div>
        <div class="container">
            <form class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <?php
               $rand=rand();
               $_SESSION['rand']=$rand;
              ?>
              <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                <div class="container text-center">
                      <div class="condi-dropdown mb-3">
                        <select name="companyname" id="companyname" class="form-select" required>
                            <option value="">Select a company</option>
                            <?php
                                while (($Row = mysqli_fetch_assoc($result)) != FALSE) { ?>
                                <option value="<?php echo $Row['name'];?>"><?php echo $Row['name'];?></option>
                            <?php } ?>
                        </select>
                      </div>
                      <div class="condi-dropdown mb-3">
                          <select id="companyrating" name="companyrating" class="form-select" required>
                            <option value="" default disabled>Rate</option>
                            <option value="1">★☆☆☆☆</option>
                            <option value="2">★★☆☆☆</option>
                            <option value="3">★★★☆☆</option>
                            <option value="4">★★★★☆</option>
                            <option value="5">★★★★★</option>
                        </select>
                        </div>


                <div class="col">
                    <div class="form-floating  mb-3 ">
                        <textarea class="form-control" id="reviewdetails" name="reviewdetails" placeholder="reviewdetails" style="height: 200px"></textarea>
                        <label for="enquirydetails">Review Details</label>
                    </div>
                    </div>
                </div>

                <div class="form-group mb-2 mt-3 text-center">
                    <input type="submit" name="submit" class="btn btn-lg btn-primary" value="Submit Review">
                </div>
                <div class="alert alert-success  text-center booking-alert mt-3" role="alert"><?php echo $review_success;?></div>

            </form>
            </div>
        </div>
    </body>
    <?php include_once ("jsLinks.php"); ?>
</html>
