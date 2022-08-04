<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $user_type = $_SESSION["user_type"];
      // echo '<pre>' . print_r($_SESSION) . '</pre>';
    $bills = new Homeowner();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;

    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION['bill_ID'] = $_POST['bill_ID'];
      $_SESSION['company_name'] = $_POST['company_name'];
      $_SESSION['bill_date'] = $_POST['bill_date'];
      $_SESSION['bill_due_date'] = $_POST['bill_due_date'];
      $_SESSION['bill_status'] = $_POST['bill_status'];
      $_SESSION['company_ID'] = $_POST['company_ID'];
      $_SESSION['company_name'] = $_POST['company_name'];
      $_SESSION['company_address'] = $_POST['company_address'];
      $_SESSION['company_postal'] = $_POST['company_postal'];
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
    <div class="container " style ="margin-top:120px;">
      <div class="row" style="height: 200px;">
        <div class="col-4 ">
          <h2 class ="fw-bold mb-0"><?php echo $_SESSION['company_name'];?></h2>
          <h5 class =" mb-0"><?php echo $_SESSION['company_address'];?> </h5 >
          <h5 class =" mb-0"><?php echo $_SESSION['company_postal'];?> </h5 >
          <h5 class =" mb-0">Due Date: <?php echo $_SESSION['bill_due_date'];?> </h5 >
        </div>
        <div class="col-4 ms-auto">
        <?php
          $date = strtotime($_SESSION['bill_date']);
          $month=date("F",$date);
          $month_no=date("m",$date);
          $_SESSION['bill_month'] = $month_no;
        ?>
        <h2 class ="fw-bold mb-0"><?php echo $month;?> Bill</h2>
        <h5 class ="mb-0"><?php echo $name;?></h5>
        <h5 class ="mb-0"><?php echo $_SESSION['address'];?></h5>
        <h5 class ="mb-0"><?php echo $_SESSION['postal_code'];?></h5>

        </div>
      </div>
      <div class="row">
        <?php $bills->listBillDetailsHomeowner(); ?>
      </div>
    </div>
    <?php include_once('jsLinks.php');?>
</body>
</html>
