<?php
session_start();
 include_once "conn.php";
 include_once "logInCheck.php";
 include_once "classes.php";
 include_once "navbar.php";
?>

<html lang="en">
  <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <?php include_once('cssLinks.php');?>
      <title>Services</title>
  </head>
  <body>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Services</h1>
      <div class="row justify-content-center">
        <div class="col text-center">
          <p class ="display-6 fs-5 text-secondary" name = "product" value ="avail">View and edit Services currently in use.</p>
        </div>
    <div class="col-md-12 text-center">
        <a class="float-end btn btn-primary" href="insertServiceHomeownerAndCompany.php" type="submit">Add +</a>
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
            $count =  0;
            $ID = $_SESSION['ID'];
            $userType = $_SESSION['user_type'];

            if ($userType == "homeowner") {
                $query = "SELECT Homeowner_Services.service_ID, Services.service_name from Homeowner_Services
                        join Services on Homeowner_Services.service_ID = Services.service_ID
                        where Homeowner_Services.homeowner_ID = $ID";
            } else if ($userType == "company") {
                $query = "SELECT Company_Services.service_ID, Services.service_name from Company_Services
                join Services on Company_Services.service_ID = Services.service_ID
                where Company_Services.company_ID = $ID";
            }

            $result = mysqli_query($conn, $query);
            echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding text-white'>
              <th>Service ID #</th>
              <th>Service Name</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";

                // output data of each row
                while($row = $result->fetch_assoc()) {
                $count += 1;
                echo "
                        <tr class='table-padding' >
                            <form method='post' action='deleteServiceHomeownerAndCompany.php'>
                            <td>".$row["service_ID"]."</td>
                            <td>".$row["service_name"]."</td>
                            ".'<input type ="hidden" value ="'.$row["service_ID"].'" name ="service_ID"/>'.
                            '<input type ="hidden" value ="'.$row["service_name"].'" name ="service_name"/>';
                        // if($count < 3)
                        if($row ["service_name"] == "Water Supply" || $row ["service_name"] == "Maintenance")
                        {
                        echo "<td></td>";
                        }
                        else{
                        echo "<td class ='align-middle'><input type='submit' class='btn btn-mobile btn-danger' name='Remove' value='Remove'></td>";
                        }
                        echo"</tr>
                        </form>";
                }
                echo "
                </tbody></table>";
          ?>
      </div>

      <?php include_once('jsLinks.php');?>
  </body>
  </html>
