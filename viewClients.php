<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $user_type = $_SESSION["user_type"];
    $_SESSION["rand"] = 123;

    $tables = new Company();


?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>

		<title>Customer Details</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 text-center" style="margin-top:50px;">Customers</h1>
<div class="row justify-content-center">
  <div class="col-md-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">View customers signed up with your company.</p>
</div>
<form method="POST" class="mb-0" action="insertStaff.php">
    <input type ="hidden" value ="123" name ="randcheck"/>
</form>
</div>
</div>
		<div class="container mt-3">
			<div class="d-flex justify-content-around bg-secondary mb-3">
				<input class="form-control rounded-0 search-for" type="text" placeholder="Search">

			</div>
		</div>
    <div class="container justify-content-center text-center">
      <?php
      $tables->listClients();
      ?>
    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>


</html>