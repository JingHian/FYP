<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $user_type = $_SESSION["user_type"];

    $tables = new Company();

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;

    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $_SESSION['company_ID'] = $_POST['company_ID'];
      $_SESSION['company_name'] = $_POST['company_name'];
      $_SESSION['company_email'] = $_POST['company_email'];
      $_SESSION['company_phone'] = $_POST['company_phone'];
      $_SESSION['company_address'] = $_POST['company_address'];
      $_SESSION['company_postal'] = $_POST['company_postal'];
      $_SESSION['company_description'] = $_POST['company_description'];
      $_SESSION['service_grouped'] = $_POST['service_grouped'];
      header("location:companyDetails.php");
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>

		<title>Company Details</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Companies</h1>
<div class="row justify-content-center">
  <div class="col-md-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">View companies currently registered on our platform.</p>
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
      $tables->listCompanies();
      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>


</html>
