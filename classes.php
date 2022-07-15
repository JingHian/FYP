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
          <option value="" default disabled >Select a Company</option>';
          while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) {
              echo '<option value="'.$Row["name"].'">'. $Row["name"].'</option>';
            };
          echo'  </select>
          </div>';
  }

  function StaffDropDown(){

    $getcompanyname = mysqli_query($this->conn, "SELECT name FROM Company");

    echo '<div class="condi-dropdown mb-3">
      <select id="staff_name" class="form-select" name="staff_name" form="staff_name" required>
          <option value="" default disabled>Assign a Staff</option>';
          // while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) {
          //     echo '<option value="'.$Row["name"].'">'. $Row["name"].'</option>';
          //   };
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
   $query = "SELECT comp.company_ID,comp.name, comp.email,comp.phone, comp.address,comp.postal_code, comp.description, GROUP_CONCAT(serv.service_name SEPARATOR ', ') as service_grouped
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
                    '<input type ="hidden" value ="'.$row["email"].'" name ="company_email"/>'.
                    '<input type ="hidden" value ="'.$row["phone"].'" name ="company_phone"/>'.
                    '<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                    '<input type ="hidden" value ="'.$row["address"].'" name ="company_address"/>'.
                    '<input type ="hidden" value ="'.$row["postal_code"].'" name ="company_postal"/>'.
                    '<input type ="hidden" value ="'.$row["description"].'" name ="company_description"/>'.
                    '<input type ="hidden" value ="'.$row["service_grouped"].'" name ="service_grouped"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
                </tr>
              </form>";
      }
      echo "
      </tbody></table>";
    } else {
      echo "No Companies Found";
    }

}

function tableHeaderCases()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding'>
            <th>Enquiry #</th>
            <th>Subject</th>
            <th>From</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

 function listCases(){
   $ID = $_SESSION['ID'];

  $query = "SELECT cas.*,home.name
            FROM Cases AS cas
            JOIN Homeowners AS home
            ON cas.homeowner_ID = home.homeowner_ID
            WHERE company_ID = '$ID'";

   $result = mysqli_query($this->conn, $query);

    if ($result->num_rows > 0) {
      $this->tableHeaderCases();
      // output data of each row
      while($row = $result->fetch_assoc()) {
      echo "
                <tr class='table-padding' >
                  <form method='post' action='replyCase.php'>
                  <td>".$row["case_ID"]."</td>
                  <td>".$row["case_subject"]."</td>
                  <td>".$row["name"]."</td>
                  <td>".$row["case_date"]."</td>
                  <td>".$row["case_status"]."</td>
                  <td>"."4/5"." </td>
                  ".'<input type ="hidden" value ="'.$row["case_ID"].'" name ="case_ID"/>'.
                    '<input type ="hidden" value ="'.$row["case_subject"].'" name ="case_subject"/>'.
                    '<input type ="hidden" value ="'.$row["name"].'" name ="homeowner_name"/>'.
                    '<input type ="hidden" value ="'.$row["case_date"].'" name ="case_date"/>'.
                    '<input type ="hidden" value ="'.$row["case_status"].'" name ="case_status"/>'.
                    '<input type ="hidden" value ="'.$row["case_description"].'" name ="case_description"/>'.
                    '<input type ="hidden" value ="" name ="reply"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
                </tr>
              </form>";
      }
      echo "
      </tbody></table>";
    } else {
      echo "No Companies Found";
    }

}


function tableHeaderBookingComp()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding'>
            <th>Booking #</th>
            <th>Homeowner Name</th>
            <th>Date</th>
            <th>Assigned Staff</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

function listBookingsComp(){
  $ID = $_SESSION['ID'];

 $query = "SELECT book.*,home.name
           FROM Bookings AS book
           JOIN Homeowners AS home
           ON book.homeowner_ID = home.homeowner_ID
           WHERE company_ID = '$ID'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBookingComp();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action='assignStaff.php'>
                 <td>".$row["booking_ID"]."</td>
                 <td>".$row["name"]."</td>
                 <td>".$row["booking_date"]."</td>
                 <td>".$row["staff_ID"]."</td>
                 <td>".$row["booking_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["booking_ID"].'" name ="booking_ID"/>'.
                   '<input type ="hidden" value ="'.$row["name"].'" name ="homeowner_name"/>'.
                   '<input type ="hidden" value ="'.$row["booking_date"].'" name ="booking_date"/>'.
                   '<input type ="hidden" value ="'.$row["staff_ID"].'" name ="booking_subject"/>'.
                   '<input type ="hidden" value ="'.$row["booking_status"].'" name ="booking_status"/>'.
                   '<input type ="hidden" value ="'.$row["booking_description"].'" name ="booking_description"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
               </tr>
             </form>";
     }
     echo "
     </tbody></table>";
   } else {
     echo "No Homeowner Bookings Found";
   }

}

function updateCase($reply,$case_ID){
  $query = "UPDATE Cases
            SET
            case_reply ='$reply' ,
            case_status = 'Replied'
            WHERE case_ID ='$case_ID'";

  $result = mysqli_query($this->conn, $query);

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
  $company_ID = $_SESSION['ID'];
  $query = "SELECT staff.staff_ID, staff.staff_name, staff.email, staff.phone, staff.staff_role, staff.status
            FROM Maintenance_Staff as staff
            JOIN company AS comp
            ON staff.company_ID = comp.company_ID
            WHERE staff.company_ID = $company_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderStaff();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='viewStaffDetails.php'>";
      echo "<td>".$row["staff_ID"]."</td>";
      echo "<td>".$row["staff_name"]."</td>";
      echo "<td>".$row["email"]."</td>";
      echo "<td>".$row["phone"]."</td>";
      echo "<td>".$row["staff_role"]."</td>";
      echo '<td>'.$row["status"].'</td>'
      .'<input type ="hidden" value ="'.$row["staff_ID"].'" name ="staff_ID"/>'
      .'<input type ="hidden" value ="'.$row["staff_name"].'" name ="staff_name"/>'
      .'<input type ="hidden" value ="'.$row["email"].'" name ="staff_email"/>'
      .'<input type ="hidden" value ="'.$row["phone"].'" name ="staff_phone"/>'
      .'<input type ="hidden" value ="'.$row["staff_role"].'" name ="staff_role"/>'
      .'<input type ="hidden" value ="'.$row["status"].'" name ="staff_status"/>'
      ."<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
  </tr>
</form>";
     }
     echo "</tbody></table>";
   } else {
     echo "No Staff Found";
   }

}

function updateStaff($staff_ID,$staff_name,$staff_email,$staff_phone,$staff_role){

try {

  $sql = "UPDATE maintenance_staff set staff_role = '$staff_role', staff_name = '$staff_name', email = '$staff_email', phone = '$staff_phone' where staff_ID = $staff_ID";
  //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
  mysqli_query($this->conn, $sql);

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

}

function deleteStaff($staff_ID){
    try {
        $sql = "DELETE FROM maintenance_staff WHERE staff_ID =$staff_ID";
        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
        mysqli_query($this->conn, $sql);


    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
    }
}

function tableHeaderEquipment()
{
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
}

function listEquipment(){
  $company_ID = $_SESSION['ID'];
    $query = "SELECT equip.equipment_ID, equip.company_ID, equip.equipment_name, equip.quantity, equip.installation_date, equip.warranty_date, equip.expiry_date
              FROM maintenance_equipment AS equip
              JOIN company AS comp
              ON equip.company_ID = comp.company_ID
              WHERE equip.company_ID = $company_ID";
    $result = mysqli_query($this->conn, $query);

     if ($result->num_rows > 0) {

       $this->tableHeaderEquipment();
       // output data of each row
       while($row = $result->fetch_assoc()) {
          echo "<tr class='table-padding' >";
          echo "<form method='post' action='viewEquipmentDetails.php'>";
          echo "<td>".$row["equipment_ID"]."</td>";
          echo "<td>".$row["equipment_name"]."</td>";
          echo "<td>".$row["quantity"]."</td>";
          echo "<td>".$row["installation_date"]."</td>";
          echo "<td>".$row["warranty_date"]."</td>";
          echo "<td>".$row["expiry_date"]."</td>"
          .'<input type ="hidden" value ="'.$row["equipment_ID"].'" name ="equipment_ID"/>'
          .'<input type ="hidden" value ="'.$row["equipment_name"].'" name ="equipment_name"/>'
          .'<input type ="hidden" value ="'.$row["quantity"].'" name ="quantity"/>'
          .'<input type ="hidden" value ="'.$row["installation_date"].'" name ="installation_date"/>'
          .'<input type ="hidden" value ="'.$row["warranty_date"].'" name ="warranty_date"/>'
          .'<input type ="hidden" value ="'.$row["expiry_date"].'" name ="expiry_date"/>'
          ."<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
          </tr>
        </form>";

       }
       echo "
       </tbody></table>";
     } else {
       echo "No Equipments Found";
     }
}

function updateEquipment($equipment_ID,$equipment_name,$quantity,$installation_date,$warranty_date,$expiry_date){

try {

  $sql = "UPDATE maintenance_equipment set  equipment_name = '$equipment_name', quantity = '$quantity', installation_date = '$installation_date' ,warranty_date = '$warranty_date' ,expiry_date = '$expiry_date' where equipment_ID = $equipment_ID";
  //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
  mysqli_query($this->conn, $sql);

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

}

function deleteEquipment($equipment_ID){
    try {
        $sql = "DELETE FROM maintenance_equipment WHERE equipment_ID =$equipment_ID";
        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
        mysqli_query($this->conn, $sql);


    }  catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
    }
}


function updateInfoComp($name,$phone,$email,$address,$postal_code,$description,$password){
try {
  $ID = $_SESSION['ID'];
  if ($password == '')
  {
    $sql = "UPDATE Company SET name = '$name', phone = '$phone', email = '$email', address = '$address', postal_code = '$postal_code' , description = '$description' WHERE company_ID = $ID";
    mysqli_query($this->conn, $sql);
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['postal_code'] = $postal_code;
    $_SESSION['home_type'] = $description;
  } else{
    $sql = "UPDATE Company SET name = '$name', phone = '$phone', email = '$email', address = '$address', postal_code = '$postal_code' , description = '$description', password = '$password' WHERE company_ID = $ID";
    mysqli_query($this->conn, $sql);
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['postal_code'] = $postal_code;
    $_SESSION['home_type'] = $description;
    $_SESSION['password'] = $password;
  }

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
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
       $query = "SELECT cas.*,comp.name
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
                         "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' name='Details' value='Details'></td>".
                         "<input type ='hidden' value ='".$Row['case_subject']."' name ='case_subject'/>".
                         "<input type ='hidden' value ='".$Row['name']."' name ='company_name'/>".
                         "<input type ='hidden' value ='".$Row['case_description']."' name ='case_description'/>".
                         "<input type ='hidden' value ='".$Row['case_reply']."' name ='case_reply'/>".
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

function tableHeaderBookingHome()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding'>
            <th>Booking #</th>
            <th>Company Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

function listBookingsHomeowner(){
  $ID = $_SESSION['ID'];

 $query = "SELECT book.*,comp.name
           FROM Bookings AS book
           JOIN Company AS comp
           ON book.company_ID = comp.company_ID
           WHERE homeowner_ID = '$ID'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBookingHome();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action='viewBookingDetailsHomeowner.php'>
                 <td>".$row["booking_ID"]."</td>
                 <td>".$row["name"]."</td>
                 <td>".$row["booking_date"]."</td>
                 <td>".$row["booking_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["booking_ID"].'" name ="booking_ID"/>'.
                   '<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                   '<input type ="hidden" value ="'.$row["booking_date"].'" name ="booking_date"/>'.
                   '<input type ="hidden" value ="'.$row["booking_status"].'" name ="booking_status"/>'.
                   '<input type ="hidden" value ="'.$row["booking_description"].'" name ="booking_description"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' value='Details'></td>
               </tr>
             </form>";
     }
     echo "
     </tbody></table>";
   } else {
     echo "No Homeowner Bookings Found";
   }

}

function updateInfoHome($name,$phone,$email,$address,$postal_code,$home_type,$password){
try {
  $ID = $_SESSION['ID'];
  if ($password == '')
  {
    $sql = "UPDATE Homeowners SET name = '$name', phone = '$phone', email = '$email', address = '$address', postal_code = '$postal_code' , home_type = '$home_type' WHERE homeowner_ID = $ID";
    mysqli_query($this->conn, $sql);
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['postal_code'] = $postal_code;
    $_SESSION['home_type'] = $home_type;
  } else{
    $sql = "UPDATE Homeowners SET name = '$name', phone = '$phone', email = '$email', address = '$address', postal_code = '$postal_code' , home_type = '$home_type', password = '$password' WHERE homeowner_ID = $ID";
    mysqli_query($this->conn, $sql);
    $_SESSION['name'] = $name;
    $_SESSION['phone'] = $phone;
    $_SESSION['email'] = $email;
    $_SESSION['address'] = $address;
    $_SESSION['postal_code'] = $postal_code;
    $_SESSION['home_type'] = $home_type;
    $_SESSION['password'] = $password;
  }

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

}

}
