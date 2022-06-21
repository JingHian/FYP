<?php
include 'cssLinks.php';
if(!isset($_SESSION))
{
    session_start();
}
// Class for handling Product SQL queries
class Company{
  private $conn = NULL;

  function __construct() {
    include("conn.php");
    $this->conn = $conn;
  }

  function tableHeader()
  {
    echo "<table class='table table-hover'>
            <thead>
            <tr class='table-padding'>
              <th>Company Name</th>
              <th>Services Offered</th>
              <th>Address</th>
              <th>Ratings</th>
              <th>Action</th>
            </tr>
            </thead>";
  }

 function listCompanies(){

   $query = "SELECT comp.name, comp.address, comp.postal_code, GROUP_CONCAT(serv.service_name) as service_grouped
             FROM Company AS comp
             JOIN Company_Services AS cs
             ON comp.company_ID = cs.company_ID
             JOIN Services As serv
             ON cs.service_ID = serv.service_ID
             GROUP BY name";
   $result = mysqli_query($this->conn, $query);

    if ($result->num_rows > 0) {
      $this->tableHeader();
      // output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<form method='post' action=''>
                <tr class='table-padding'>
                  <td>".$row["name"]."</td>
                  <td>".$row["service_grouped"]."</td>
                  <td>".$row["address"]."</td>
                  <td>"."4/5"." </td>
                  ".'<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' value='Details'></td>
                </tr>
              </form>";
      }
      echo "</table>";
    } else {
      echo "No Products Found";
    }



}

}
