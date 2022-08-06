<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();
$uni = new Universal();
$already_exists = "";

// echo '<pre>' . print_r($_SESSION) . '</pre>';

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['generate'])) {
  $CID = $_SESSION['ID'];
  $bill_month = $_POST['bill_month'];
  $bill_month_no = date('m', strtotime("$bill_month"));
  echo $bill_month_no;
  $current_year = date("Y");
  $client_ID = $_SESSION["client_ID"];
  $last_day =  date("Y-m-d", strtotime("Last day of $bill_month $current_year"));
  $payment_date =  date("Y-m-d", strtotime("last day of $bill_month+1 month $current_year"));
  // echo $last_day;
    $stmt = $conn->prepare("SELECT * FROM Bills WHERE client_ID = ? AND Month(bill_date)  = ?");
    $stmt->bind_param("ii",$client_ID,$bill_month_no);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows < 1) {
         $stmt = $conn->prepare("SELECT homeowner_ID FROM Clients Where client_ID = ?");
         $stmt->bind_param("i",$client_ID);
         $stmt->execute();
         $result = $stmt->get_result();
         $row = $result->fetch_assoc();
         $HID = $row['homeowner_ID'];
         echo $HID;
         $stmt = $conn->prepare("INSERT INTO Bills (company_ID,homeowner_ID,client_ID,bill_date,bill_due_date,bill_status) VALUES ( ?,?,?,?,?,?)");
         $pending = "pending";
         $stmt->bind_param("iiisss", $CID,$HID,$client_ID,$last_day,$payment_date,$pending);
         $stmt->execute();
    } else {
      $already_exists = "A bill for ". $bill_month. " for this client has already been generated!";
    }

}


?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Generate Bills</title>
    </head>

    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Generate Bill for Client <?php echo $_SESSION['client_name'];?>.</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
      <p class ="display-6 fs-5" name = "product" value ="avail">Bills will be auto generated for the last day of the month and due the last day of next month.</p>
    </div>
      </div>
    </div>
<div class="container">
  <form id="generate_bill" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="client_ID" name="client_ID" placeholder="client_ID" value ="<?php echo $_SESSION['client_ID'];?>" disabled>
            <label for="client_ID">Client ID</label>
          </div>
        </div>
        <div class="col">
          <?php  $uni->MonthDropDown();?>
          </div>
    <div class="form-group mb-2 mt-3 text-center">
        <button type="submit" class="btn  btn-primary" name ="generate">Generate</button>
        <a class='btn  btn-primary text-white me-4' href="viewBillsComp.php" value='Back'>Back</a>
    </div>
    <div class="alert alert-primary booking-alert mt-3" role="alert"><?php echo $already_exists;?></div>
  </form>
</div>
    </body>

</html>
<?php
//once do assign staff, pull from company staff records, once assigned shoot email, also add in change status
?>
