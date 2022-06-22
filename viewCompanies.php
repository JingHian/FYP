<?php
    session_start();
    include ("conn.php");
    include ("classes.php");
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
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
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
