<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";
$discount_success = "";

$company = new Company();

if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand']){
  $Packname = $_POST['PackageName'];
  $Packdesc = $_POST['packdesc'];
  $SDate = $_POST['SDate'];
  $EDate = $_POST['EDate'];
  $Modifier = $_POST['discount'];
  $CID = $_SESSION['ID'];

   //creates a table if does not yet exist
   $PackTable = "CREATE TABLE IF NOT EXISTS Discounts (
      discount_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
      company_ID int(11) NOT NULL,
      homeowner_ID int(11),
      discount_name VARCHAR(100) NOT NULL,
      discount_start_date VARCHAR(15) NOT NULL,
      discount_end_date VARCHAR(15) NOT NULL,
      discount_description VARCHAR(500) NOT NULL,
      discount_modifier int(3) NOT NULL
      )";

  mysqli_query($conn, $PackTable);

    //adds a new entry
    try {
        $sql = "INSERT INTO Discounts (company_ID, discount_name, discount_start_date, discount_end_date, discount_description, discount_modifier) VALUES "
                . "('$CID', '$Packname', '$SDate', '$EDate', '$Packdesc', '$Modifier')";
        @mysqli_query($conn, $sql);
        $discount_success = "Discount  has been created!";

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
        <title>Add Discount</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 text-center" style="margin-top:50px;">Add Discount</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Enter details.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="AddPackage" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <?php
         $rand=rand();
         $_SESSION['rand']=$rand;
        ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="PackageName" name="PackageName" placeholder="PackageName" required>
            <label for="PackageName">Discount Name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="packdesc" name="packdesc" placeholder="packdesc" style="height: 200px"></textarea>
            <label for="packdesc">Discount Description</label>
          </div>
        </div>
      <div class="row">
        <div class="col-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="date" name = "SDate" >
            <label for="SDate">Start Date</label>
          </div>
        </div>
        <div class="col-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="date" name = "EDate">
            <label for="EDate">End Date</label>
          </div>
        </div>
      <div class="col-6">
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="discount" name="discount" placeholder="discount" required min ="1" max="100">
            <label for="discount">Modifier</label>
          </div>
        </div>
        </div>


    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn  btn-primary" value="Add Discount">
    </div>
    <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $discount_success;?></div>
  </form>
</div>


    </body>



</html>
