<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $user_type = $_SESSION["user_type"];
      // echo '<pre>' . print_r($_SESSION) . '</pre>';
    $bills = new Company();


  if($_SERVER["REQUEST_METHOD"] == "POST" && ISSET($_POST['Delete'])){
    $sqlQuery  =  "DELETE FROM Bills WHERE bill_ID=?";
    $statement = $conn->prepare($sqlQuery);
    $statement->bind_param("i", $_SESSION['bill_ID']);
    $statement->execute();
    header("location: viewBillsComp.php");
  }
   else if($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['bill_ID'] = $_POST['bill_ID'];
    $_SESSION['bill_date'] = $_POST['bill_date'];
    $_SESSION['bill_due_date'] = $_POST['bill_due_date'];
    $_SESSION['bill_status'] = $_POST['bill_status'];
    $_SESSION['homeowner_ID'] = $_POST['homeowner_ID'];
  }

?>

<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Bill Details
        </title>
    </head>

    <body>

      <style>
      /* .container{
        background-color: red;
      } */
      </style>
    <div class="container clearfix boxshadow p-5" style ="margin-top:100px;">
      <div class="row" style="height: 200px;">
        <div class="col-md-4 ">
          <h2 class ="fw-bold mb-0"><?php echo $_SESSION['name'];?></h2>
          <h5 class =" mb-0"><?php echo $_SESSION['address'];?> </h5 >
          <h5 class =" mb-0"><?php echo $_SESSION['postal_code'];?> </h5 >
          <h5 class =" mb-0">Due Date: <?php echo $_SESSION['bill_due_date'];?> </h5 >
        </div>
        <div class="col-md-4 ms-auto">
        <?php
          $date = strtotime($_SESSION['bill_date']);
          $month=date("F",$date);
          $month_no=date("m",$date);
          $_SESSION['bill_month'] = $month_no;
        ?>
        <h2 class ="fw-bold mb-0"><?php echo $month;?> Bill</h2>
        <h5 class ="mb-0"><?php echo $_SESSION['client_name'];?></h5>
        <h5 class ="mb-0"><?php echo $_SESSION['client_address'];?></h5>
        <h5 class ="mb-0"><?php echo $_SESSION['client_postal_code'];?></h5>

        </div>
      </div>
      <div class="row">
        <?php $bills->listBillDetailsCompany(); ?>
      </div>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <a class='btn btn-lg btn-primary text-white float-end mt-5' href="viewBillsComp.php" value='Back'>Back</a>
        <input type="submit" class="btn btn-lg btn-danger me-4 mt-5 float-end" name="Delete" value="Delete Bill">

      </form>
    </div>
    <?php include_once('jsLinks.php');?>
</body>
</html>
