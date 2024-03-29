<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $user_type = $_SESSION["user_type"];

    $bills = new Homeowner();

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

		<title>View Past Bills</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Bill History</h1>
<div class="row justify-content-center">
  <div class="col-md-12 text-center">
  <p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">View your paid bills</p>
  </div>
  <div class="col-12 text-center">
  <a class="float-end btn btn-success" href="viewBills.php" type="submit">Current Bills</a>
  </div>
</div>
</div>
		<div class="container mt-3">
			<div class="d-flex justify-content-around bg-secondary mb-3">
				<input class="form-control rounded-0 search-for" type="text" placeholder="Search..">
			</div>
		</div>
    <div class="container justify-content-center text-center table-responsive">
    <?php
      $bills->listPaidHomeowner();
      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>


</html>
