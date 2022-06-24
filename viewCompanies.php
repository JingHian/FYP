<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];

    $tables = new Company();

    if($_SERVER["REQUEST_METHOD"] == "POST") {
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
<h1 class ="display-5 text-center" style="margin-top:50px;">Companies</h1>
<div class="row justify-content-center">
  <div class="col-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Here you can view companies currently registered on our platform.</p>
</div>
</div>
</div>
		<div class="container mt-3">
			<div class="d-flex justify-content-around bg-secondary mb-3">
				<input class="form-control" id="myInput" type="text" placeholder="Search..">
				<div class="dropdown d-flex justify-content-end">
					<button class="btn btn-secondary dropdown-toggle align-text-top" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
						Category
					</button>
					<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						<li><a class="dropdown-item" href="#">Category1</a></li>
						<li><a class="dropdown-item" href="#">Category2</a></li>
						<li><a class="dropdown-item" href="#">Category3</a></li>
					</ul>
				</div>
			</div>
		</div>
    <div class="container justify-content-center text-center">
    <?php
      $tables->listCompanies();
      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>

  <script>
  $(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#companyTable tr").filter(function() {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
  });
  </script>
</html>
