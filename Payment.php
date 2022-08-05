<?php
session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];
    $paid = 0;
    $payment_success='';
      // echo '<pre>' . print_r($_SESSION) . '</pre>';

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }
    $billsID = $_SESSION['bill_ID'];
    $total = $_SESSION['total_price'];
    $duedate = $_SESSION['bill_due_date'];
    $enquiry_success = "";
    if(isset($_POST['payment']))
    {
        $date = date("Y/m/d");
        $payment = "UPDATE bills SET bill_status =\"Paid\", bill_payment_date = '$date' WHERE bill_ID = $billsID";
        try
        {
            if(mysqli_query($conn, $payment) == TRUE)
            {
                $paid = 1;
                $payment_success = "Payment Successful!";
            }
        } catch (Exception $ex) {
           echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
        }
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Make Payment</title>
    </head>
    <body>
        <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Make Payment for</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
            <br>
      <p class ="display-6 fs-5" name = "details" value ="details">Bill ID: #<?php echo $billsID;?></p>
      <p class ="display-6 fs-5" name = "details" value ="details">Due by: <?php echo $duedate;?></p>
      <p class ="display-6 fs-5" name = "details" value ="details">Outstanding Amount: $<?php echo $total;?></p>
      <br>
      <p class ="display-6 fs-5" name = "details" value ="details">Enter card details:</p>
    </div>
      </div>
    </div>
        <div class="container">
            <form id="MakePayment" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <?php
         $rand=rand();
         $_SESSION['rand']=$rand;
        ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="cardName" name="cardName" placeholder="cardName" required>
            <label for="cardName">Name on Card</label>
          </div>
        </div>
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="cardNum" name="cardNum" placeholder="cardNum" required>
            <label for="cardNum">Card Number</label>
          </div>
        </div>
        <div class="row">
        <div class="col-6">
          <div class="form-floating mb-3">
            <input type="date" class="form-control" id="date" name = "ExpDate" >
            <label for="ExpDate">Expiry Date</label>
          </div>
        </div>
        <div class="col-6">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="CCV" name="CCV" placeholder="CCV" required>
            <label for="CCV">CCV</label>
          </div>
        </div>
        </div>
        <div class="form-group mb-2 mt-3 text-center">
          <?php if($paid == 0)
           {
              echo'  <button type="submit" name="payment" class="btn btn-lg btn-primary" value="Make Payment">Make Payment</button>';
           }
          ?>
          <div class="alert alert-primary text-center booking-alert mt-3" role="alert"><?php echo $payment_success;?></div>
          <a class='btn btn-lg btn-primary text-white ' href="viewBills.php" value='Back'>Back</a>
                </div>
            </form>
        </div>
    </body>
</html>
