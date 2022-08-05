<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$Packname = "";
$Packdesc = "";
$SDate = "";
$EDate = "";
$Modifier = "";
$have_discount = "";
$discount_success = "";
$discount_edit = "";
$discount_deleted ="";
$CID = $_SESSION['ID'];
try {

    $sql = "SELECT * FROM Discounts WHERE company_ID = '$CID'";
    $result = $conn->query($sql);
    $row = $result -> fetch_assoc();
    if ($result->num_rows > 0) {
      $Packname = $row['discount_name'];
      $Packdesc = $row['discount_description'];
      $SDate = $row['discount_start_date'];
      $EDate = $row['discount_end_date'];
      $Modifier = $row['discount_modifier'];
      $have_discount = 1;
    } else {
      $have_discount = 0;
    }

}catch (mysqli_sql_exception $e) {
      echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }



if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand'] && isset($_POST['Add'])){
  $Packname = $_POST['PackageName'];
  $Packdesc = $_POST['packdesc'];
  $SDate = $_POST['SDate'];
  $EDate = $_POST['EDate'];
  $Modifier = $_POST['discount'];

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
        $sql = "SELECT * FROM Discounts WHERE company_ID = '$CID'";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows < 1) {
          $sql = "INSERT INTO Discounts (company_ID, discount_name, discount_start_date, discount_end_date, discount_description, discount_modifier) VALUES "
                  . "('$CID', '$Packname', '$SDate', '$EDate', '$Packdesc', '$Modifier')";
          @mysqli_query($conn, $sql);
          $have_discount = 1;
          $discount_success = "Discount has been created!";
      }

    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
}

if($_SERVER["REQUEST_METHOD"] == "POST"&& $_POST['randcheck']==$_SESSION['rand'] && isset($_POST['Edit'])){
    $Packname = $_POST['PackageName'];
    $Packdesc = $_POST['packdesc'];
    $SDate = $_POST['SDate'];
    $EDate = $_POST['EDate'];
    $Modifier = $_POST['discount'];


      //adds a new entry
      try {
         $sql = " UPDATE Discounts
                  SET discount_name= '$Packname',
                      discount_description= '$Packdesc',
                      discount_start_date= '$SDate',
                      discount_end_date= '$EDate',
                      discount_modifier= '$Modifier'
                  WHERE company_ID = '$CID' ";
          $result = mysqli_query($conn, $sql);
          $discount_edit = "Discount has been Edited!";


      }  catch (mysqli_sql_exception $e) {
          echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
      }

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Delete']))
      {
            $sql = "DELETE FROM Discounts WHERE company_ID = '$CID'";
            if ($conn->query($sql) === TRUE) {
              $discount_deleted = "Discount has been Deleted!";
            } else {
              echo "Error deleting record: " . $conn->error;
            }
            $have_discount = 0;
      }

?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Add/Edit Discount</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Add/Edit Discount</h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Enter/Edit Discount details or delete discount here.</p>
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
            <input type="text" class="form-control" id="PackageName" name="PackageName" placeholder="PackageName" value="<?php echo $Packname;  ?>" required>
            <label for="PackageName">Discount Name</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating  mb-3 ">
            <textarea class="form-control" id="packdesc" name="packdesc" placeholder="packdesc" style="height: 200px"><?php echo $Packdesc;  ?></textarea>
            <label for="packdesc">Discount Description</label>
          </div>
        </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="date" name = "SDate" value="<?php echo $SDate;  ?>">
            <label for="SDate">Start Date</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="date" name = "EDate" value="<?php echo $EDate;  ?>">
            <label for="EDate">End Date</label>
          </div>
        </div>
      <div class="col-md-6">
          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="discount" name="discount" placeholder="discount" required min ="1" max="100" value="<?php echo $Modifier;  ?>">
            <label for="discount">Modifier</label>
          </div>
        </div>
        </div>


    <div class="form-group mb-2 mt-3 text-center">
      <?php
      if($have_discount == 0)
      {
        echo '<input type="submit" class="btn btn-lg btn-primary" name="Add" value="Add Discount">';
      }
      else if ($have_discount == 1)
      {
        echo '<input type="submit" class="btn btn-lg btn-primary me-5" name="Edit" value="Edit Discount">';
        echo '<input type="submit" class="btn btn-lg  btn-danger" name="Delete" value="Delete Discount">';
      }
        ?>
    </div>
    <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $discount_success;?></div>
    <div class="alert alert-primary booking-alert mt-3" role="alert"><?php echo $discount_edit;?></div>
    <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $discount_deleted;?></div>
  </form>
</div>


    </body>



</html>
