<?php
    session_start();
    include ("conn.php");
    include_once ('navbar.php');
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];
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
		<div class="container-sm">
			<table class="table table-hover">
			<thead>
				<tr class="header">
				<th scope="col"></th>
				<th scope="col">Company Name</th>
				<th scope="col">Services offered</th>
				<th scope="col">Address</th>
				<th scope="col">Ratings</th>
				<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody id="companyTable">
				<tr>
				<th scope="row">1</th>
				<td>Company 1</td>
				<td>Water Supply, Maintainance</td>
				<td>123 some avenue #12-521</td>
				<td><span id="rateMe1" class="empty-stars"></span>3/5</td>
				<td><button type="button" class="btn btn-light"><a href="company_details.php">Details</a></button></td>
				</tr>
				<tr>
				<th scope="row">2</th>
				<td>Company 2</td>
				<td>Water</td>
				<td>345</td>
				<td><span id="rateMe1" class="empty-stars"></span>5/5</td>
				<td><button type="button" class="btn btn-light"><a href="company_details.php">Details</a></button></td>
				</tr>
				<tr>
				<th scope="row">3</th>
				<td>Company 3</td>
				<td>Supply</td>
				<td>789</td>
				<td><span id="rateMe1" class="empty-stars"></span>4/5</td>
				<td><button type="button" class="btn btn-light"><a href="company_details.php">Details</a></button></td>
				</tr>
			</tbody>
			</table>
		</div>
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
	</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
