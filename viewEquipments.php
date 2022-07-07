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

		<title>Equipments Details</title>
    </head>
	<body>


<div class="container" >
<h1 class ="display-5 text-center" style="margin-top:50px;">Equipment List</h1>
<div class="row justify-content-center">
  <div class="col-6 text-center">
<p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">Here you can view equipments currently registered on the companies.</p>
</div>
</div>
</div>
		<div class="container mt-3">
      <div class="col-md-12 text-right">
          <!-- <button type="button" class="btn btn-light">New+</button>  -->
        <form method="POST" action="insertEquipment.php">
            <input type="submit"  class="btn btn-light" value="New +"/>
        </form>

      </div>
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
      //$tables->listEquipments($conn){
      $name = $_SESSION["name"];
      
        $query = "SELECT equip.equipment_ID, equip.company_ID, equip.equipment_name, equip.quantity, equip.installation_date, equip.warranty_date, equip.expirydate
                  FROM maintenance_equipment AS equip
                  JOIN company AS comp
                  ON equip.company_ID = comp.company_ID
                  WHERE comp.name = '$name'";
                
                  //UNION
                  //(SELECT comp.company_ID, comp.name
                  //FROM company AS comp
                  //where comp.name = $id
                  //)";
                  
                  //JOIN company AS comp
                  //ON equip.company_ID = comp.company_ID";
                  //GROUP BY company_ID";
        $result = mysqli_query($conn, $query);
     
         if ($result->num_rows > 0) {
            echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding'>
              <th>ID</th>
              <th>Name</th>
              <th>Quantity</th>
              <th>Installation Date</th>
              <th>Warranty Date</th>
              <th>Expiry Date</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
           // output data of each row
           while($row = $result->fetch_assoc()) {
              echo "<tr class='table-padding' ><td>".$row["equipment_ID"]."</td>";
              echo "<td>".$row["equipment_name"]."</td>";
              echo "<td>".$row["quantity"]."</td>";
              echo "<td>".$row["installation_date"]."</td>";
              echo "<td>".$row["warranty_date"]."</td>";
              echo "<td>".$row["expirydate"]."</td>";
              ?>
              <td>
                <a href="updateOrDeleteEquipment.php?id=<?php echo $row["equipment_ID"];?>">Details</a>
              </td>
              <?php

           }
           echo "
           </tbody></table>";
         } else {
           echo "No Equipments Found";
         }
        
    // }
    

      ?>


    </div>

	</body>
    <?php include_once ("jsLinks.php"); ?>
  

</html>
