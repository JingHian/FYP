<?php
include_once 'cssLinks.php';
if(!isset($_SESSION))
{
    session_start();
}

class Company{
  private $conn = NULL;

  function __construct() {
    include("conn.php");
    $this->conn = $conn;
  }

  function CompanyDropDown(){

    $getcompanyname = mysqli_query($this->conn, "SELECT name FROM Company");

    echo '<div class="condi-dropdown mb-3">
      <select id="company_name" class="form-select" name="company_name" form="enquirydetails" required>
          <option value="" default>Select a Company</option>';
          while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) {
              echo '<option value="'.$Row["name"].'">'. $Row["name"].'</option>';
            };
          echo'  </select>
          </div>';
  }

  function tableHeader()
  {
    echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding'>
              <th>Company Name</th>
              <th>Services Offered</th>
              <th>Address</th>
              <th>Ratings</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
  }

 function listCompanies(){
   $query = "SELECT comp.name, comp.address, comp.postal_code, GROUP_CONCAT(serv.service_name SEPARATOR ', ') as service_grouped
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
      echo "
                <tr class='table-padding' >
                  <form method='post' action=''>
                  <td>".$row["name"]."</td>
                  <td>".$row["service_grouped"]."</td>
                  <td>".$row["address"]."</td>
                  <td>"."4/5"." </td>
                  ".'<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' value='Details'></td>
                </tr>
              </form>";
      }
      echo "
      </tbody></table>";
    } else {
      echo "No Companies Found";
    }

}

function tableHeaderStaff()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding'>
            <th>Staff ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

function listStaff(){
  $query = "SELECT staff.staff_ID, staff.staff_name, staff.email, staff.phone, staff.staff_role, staff.status
            FROM Maintenance_Staff as staff
            GROUP BY staff_name";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderStaff();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action=''>
                 <td>".$row["staff_ID"]."</td>
                 <td>".$row["staff_name"]."</td>
                 <td>".$row["email"]."</td>
                 <td>".$row["phone"]."</td>
                 <td>".$row["staff_role"]."</td>
                 <td>".$row["status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["staff_name"].'" name ="staff_name"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' value='Edit'></td>
               </tr>
             </form>";
     }
     echo "
     </tbody></table>";
   } else {
     echo "No Staff Found";
   }

}
}

class Homeowner{
  private $conn = NULL;

  function __construct() {
    include("conn.php");
    $this->conn = $conn;
  }

  function tableHeaderEnquiries()
  {
    echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding'>
              <th>Enquiry #</th>
              <th>Subject</th>
              <th>To</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
  }

 function viewEnquiries(){

    //automatically create the table if not extist yet when the homeowner clicks the eqnuries menu
    $casesTable = "CREATE TABLE IF NOT EXISTS Cases (
       case_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
       case_subject VARCHAR(30) NOT NULL,
       company_ID int(11) NOT NULL,
       homeowner_ID int(11) NOT NULL,
       case_date VARCHAR(15) NOT NULL,
       case_status VARCHAR(10) NOT NULL,
       case_description VARCHAR(500) NOT NULL)";

    mysqli_query($this->conn, $casesTable);

    $homeownerName = $_SESSION["name"];
    $homeowner_ID = $_SESSION['ID'];

    try {
       $query = "SELECT cas.case_ID, cas.case_subject,cas.case_description, cas.company_ID, cas.homeowner_ID, cas.case_date, cas.case_status,comp.name
                 FROM Cases AS cas
                 JOIN Company AS comp
                 ON cas.company_ID = comp.company_ID
                 WHERE homeowner_id = '$homeowner_ID'";
       $result = mysqli_query($this->conn, $query);

       if (mysqli_num_rows($result) < 1) {
           echo "<br><br>No enquiries are found.<br><br>";
       } else {
          $this->tableHeaderEnquiries();
           while (($Row = mysqli_fetch_assoc($result)) != FALSE) {
               echo "
                       <tr class='table-padding'>
                       <form method='post' action='viewEnquiryDetails.php'>
                          <td>" . $Row['case_ID'] . "</td>".
                         "<td>" . $Row['case_subject'] . "</td>".
                         "<td>" . $Row['name'] . "</td>".
                         "<td>" . $Row['case_date'] ."</td>".
                         "<td>" . $Row['case_status'] ."</td>".
                         "<td class ='align-middle'><input type='submit' class='btn btn-small btn-light' name='Details' value='Details'></td>".
                         "<input type ='hidden' value ='".$Row['case_subject']."' name ='case_subject'/>".
                         "<input type ='hidden' value ='".$Row['name']."' name ='company_name'/>".
                         "<input type ='hidden' value ='".$Row['case_description']."' name ='case_description'/>".
                         "<input type ='hidden' value ='".$Row['case_date']."' name ='case_date'/>".
                         "<input type ='hidden' value ='".$Row['case_status']."' name ='case_status'/>".
                         "<input type ='hidden' value ='".$Row['case_ID']."' name ='case_ID'/>"."
                       </tr>
                     </form>";
           }
           echo "</tbody></table>";
       }
    } catch (Exception $e){
       echo "<br><br>No products are found.<br><br>";
       echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
    }

}

function insertBooking($company_name,$date,$details,$booking_type)
{
  // get company_ID from company name
  $sql = "SELECT company_ID from Company where name= '$company_name'";
  $result = mysqli_query($this->conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $company_ID = $row['company_ID'];
  $ID = $_SESSION['ID'];
  //
  // echo '<pre>' . print_r($_SESSION) . '</pre>';
  // echo $date;
  // echo $details;
  // echo $booking_type;
  // echo $company_name;
  // echo $company_ID;

  try
  {
    $sql = "INSERT INTO Bookings (company_ID, homeowner_ID, booking_date,booking_description,booking_type,booking_status) VALUES ( '$company_ID', '$ID', '$date', '$details', '$booking_type', 'In Progress')";
    $result = mysqli_query($this->conn, $sql);
    // printf("Affected rows (INSERT): %d\n", $this->conn->affected_rows);
    return True;

  }
  catch (mysqli_sql_exception $e)
  {
    echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    return False;
  }
}

}
