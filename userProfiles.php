<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<?php
    session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];

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

		<title>User Profiles Details</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 text-center" style="margin-top:50px;">User Profiles List</h1>
<div class="row justify-content-center">
  <div class="col-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Here you can view user profiles list currently registered on our platform.</p>
</div>
</div>
</div>
		<div class="container mt-3">
			<div class="d-flex justify-content-around bg-secondary mb-3">
				<input class="form-control search-for" type="text" placeholder="Search..">
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
        $query = "SELECT ho.homeowner_ID AS ID, ho.username, ho.name, ho.email, ho.phone, ho.user_type, ho.suspended
                  FROM homeowners AS ho
                  UNION
                  SELECT comp.company_ID AS ID, comp.username, comp.name, comp.email, comp.phone, comp.user_type, comp.suspended
                  FROM company AS comp";

        $result = mysqli_query($conn, $query);
     
         if ($result->num_rows > 0) {
            echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding'>
              <th>User ID</th>
              <th>Username</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>User Type</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
          
           while($row = $result->fetch_assoc()) {     
            $arr = array($row['suspended']);
            foreach ($arr as $value) {
              if ($value == 0) {
                  echo "
                  <tr class='table-padding' >
                    <form method='post' action=''>
                    <td>".$row["ID"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["phone"]."</td>
                    <td>".$row["user_type"]."</td>
                    <td>Active</td>
                    ".'<input type ="hidden" value ="'.$row["ID"].'" name ="ID"/>'.
                    "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' value='Edit'></td>
                  </tr>
                </form>";
              } else {
                  echo "
                  <tr class='table-padding' >
                    <form method='post' action=''>
                    <td>".$row["ID"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["phone"]."</td>
                    <td>".$row["user_type"]."</td>
                    <td>Suspended</td>
                    ".'<input type ="hidden" value ="'.$row["ID"].'" name ="ID"/>'.
                    "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' value='Edit'></td>
                  </tr>
                </form>";
              }

            } 
           
           }
           
           echo "
           </tbody></table>";
         } else {
           echo "No Users Found";
         }

    ?>

    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>
  

</html>

