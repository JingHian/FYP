<?php
  session_start();
  include_once ("conn.php");
  include_once ("classes.php");
  include_once ('navbar.php');
  include_once "logInCheck.php";

// echo '<pre>' . print_r($_SESSION) . '</pre>';

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $client_ID = $_POST["client_ID"];
    $client_name = $_POST["client_name"];
    $_SESSION["client_ID"] = $_POST["client_ID"];
    $_SESSION["client_name"] = $_POST["client_name"];
    $_SESSION["client_address"] = $_POST["client_address"];
    $_SESSION["client_postal_code"] = $_POST["client_postal_code"];

  }

  $bills = new Company();

  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: index.php");
      exit;

  }

?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>

		<title>View Bills</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Client <?php echo $client_name ?>'s  Bills</h1>
<div class="row justify-content-center">
  <div class="col-md-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail"></p>
</div>
<form method="POST" class="mb-0" action="generateBills.php">
    <input type ="hidden" value ="123" name ="randcheck"/>
    <input type="submit"  class="float-end btn btn-primary" value="New +"/>
</form>
</div>
</div>
		<div class="container mt-3">
			<div class="d-flex justify-content-around bg-secondary mb-3">
				<input class="form-control rounded-0 search-for" type="text" placeholder="Search..">
			</div>
		</div>
    <div class="container justify-content-center text-center">
    <?php
      $bills->listClientBillDetails();
      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>


</html>
