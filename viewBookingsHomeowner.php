<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $user_type = $_SESSION["user_type"];

    $tables = new Homeowner();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;

    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>

		<title>Homeowner Bookings</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Homeowner Bookings</h1>
<div class="row justify-content-center">
  <div class="col-md-12 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">View Homeowner bookings and assign staff.</p>
</div>
<div class="col-md-12 text-center">
    <a class="float-end btn btn-primary" href="bookHomeowner.php" type="submit">New +</a>
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
      $tables->listBookingsHomeowner();
      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>


</html>
