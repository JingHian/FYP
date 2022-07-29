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
            <tr class='table-padding text-white'>
              <th>Name</th>
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
             WHERE comp.verified = 1
             GROUP BY company_ID";
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
                  "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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
          <tr class='table-padding text-white'>
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
                  ".'<input type ="hidden" value ="'.$row["case_ID"].'" name ="case_ID"/>'.
                    '<input type ="hidden" value ="'.$row["case_subject"].'" name ="case_subject"/>'.
                    '<input type ="hidden" value ="'.$row["name"].'" name ="homeowner_name"/>'.
                    '<input type ="hidden" value ="'.$row["case_date"].'" name ="case_date"/>'.
                    '<input type ="hidden" value ="'.$row["case_status"].'" name ="case_status"/>'.
                    '<input type ="hidden" value ="'.$row["case_description"].'" name ="case_description"/>'.
                    '<input type ="hidden" value ="" name ="reply"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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
          <tr class='table-padding text-white'>
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
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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
          <tr class='table-padding text-white'>
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
      ."<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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
  <tr class='table-padding text-white'>
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
          ."<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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
            <tr class='table-padding text-white'>
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
                         "<td class ='align-middle'><input type='submit' class='btn  btn-primary' name='Details' value='Details'></td>".
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

function checkClientExists($homeowner_ID,$company_ID)
{
  $sql = "SELECT client_ID FROM Clients where homeowner_ID = '$homeowner_ID' and company_ID = '$company_ID'";
  $result = mysqli_query($this->conn, $sql);
  if (mysqli_num_rows($result) < 1) {
    return True;
  }
  else {
    return False;
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

function addClient($company_ID,$date)
{
  $homeowner_ID = $_SESSION['ID'];

  try
  {
    $sql = "SELECT discount_ID FROM discounts where company_ID = '$company_ID'";
    $result = mysqli_query($this->conn, $sql);

   if ($result->num_rows > 0) {
      $discount_ID = $row['discount_ID'];
      $sql = "INSERT INTO Clients (company_ID, homeowner_ID, discount_ID,start_date) VALUES ( '$company_ID', '$homeowner_ID', '$discount_ID', '$date')";
      $result = mysqli_query($this->conn, $sql);
    }
  else{
    $sql = "INSERT INTO Clients (company_ID, homeowner_ID,start_date) VALUES ( '$company_ID', '$homeowner_ID', '$date')";
    $result = mysqli_query($this->conn, $sql);
  }
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
          <tr class='table-padding text-white'>
            <th>Booking #</th>
            <th>Company Name</th>
            <th>Date</th>
            <th>Type</th>
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
                 <td>".$row["booking_type"]."</td>
                 <td>".$row["booking_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["booking_ID"].'" name ="booking_ID"/>'.
                   '<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                   '<input type ="hidden" value ="'.$row["booking_date"].'" name ="booking_date"/>'.
                   '<input type ="hidden" value ="'.$row["booking_description"].'" name ="booking_description"/>'.
                   '<input type ="hidden" value ="'.$row["booking_type"].'" name ="booking_type"/>'.
                   '<input type ="hidden" value ="'.$row["booking_status"].'" name ="booking_status"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
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



function tableHeaderBills()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding text-white'>
            <th>Bill #</th>
            <th>Company Name</th>
            <th>Bill Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}


function listBillsHomeowner(){
  $ID = $_SESSION['ID'];

 $query = "SELECT bill.*,comp.company_ID,comp.name,comp.address,comp.postal_code
           FROM Bills AS bill
           JOIN Company AS comp
           ON bill.company_ID = comp.company_ID
           WHERE homeowner_ID = '$ID'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBills();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action='viewBillDetails.php'>
                 <td>".$row["bill_ID"]."</td>
                 <td>".$row["name"]."</td>
                 <td>".$row["bill_date"]."</td>
                 <td>".$row["bill_due_date"]."</td>
                 <td>".$row["bill_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["bill_ID"].'" name ="bill_ID"/>'.
                   '<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                   '<input type ="hidden" value ="'.$row["bill_date"].'" name ="bill_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_due_date"].'" name ="bill_due_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_status"].'" name ="bill_status"/>'.
                   '<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                   '<input type ="hidden" value ="'.$row["address"].'" name ="company_address"/>'.
                   '<input type ="hidden" value ="'.$row["postal_code"].'" name ="company_postal"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
               </tr>
             </form>";
     }
     echo "
     </tbody></table>";
   } else {
     echo "No Bills Found";
   }

}


function tableHeaderBillDetails()
{
  echo "<table class='table table-borderless datatable_style2' >
          <thead>
            <tr class='table-padding text-white'>
              <th>Description</th>
              <th>Usage</th>
              <th>Date</th>
              <th>Price per m³</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody class='search-table'>";
}

function listBillDetailsHomeowner(){
  $ID = $_SESSION['ID'];
  $CID = $_SESSION['company_ID'];
  $month = $_SESSION['bill_month'];
  $total_price = 0;

// echo '<pre>' . print_r($_SESSION) . '</pre>';

  $query = "SELECT price FROM Company_services WHERE service_ID = '1' AND company_ID = '$CID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  $water_price = $row["price"];


  $query = "SELECT water.*,SUM(water.water_usage) AS total_water,comp.*
            FROM Water_Tracking AS water
            JOIN Company AS comp
            ON water.company_ID = comp.company_ID
            WHERE water.homeowner_ID = '$ID'
            AND comp.company_ID = '$CID'
            AND MONTH(water.usage_date) = '$month'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBillDetails();
      while($row = $result->fetch_assoc()) {
      echo "
              <tr class='table-padding' >
                <form method='post' action='viewBillDetails.php'>";
                echo "<td>Water Usage</td>";
                echo "<td>".$row["total_water"]."m³</td>";
                echo "<td></td>";
                echo "<td>".$water_price."</td>";
                echo "<td>".$water_price * $row["total_water"]."</td>";
                $total_price += $water_price * $row["total_water"]; //add up the prices


       echo "
                </tr>
              </form>";
      }
    } else {
      echo "<td>No Water usage found</td>";
    }




  $query = "SELECT price FROM Company_services WHERE service_ID = '2' AND company_ID = '$CID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  $maint_price = $row["price"];


 $query = "SELECT book.*,comp.*
           FROM Bookings AS book
           JOIN Company AS comp
           ON book.company_ID = comp.company_ID
           WHERE book.homeowner_ID = '$ID'
           AND comp.company_ID = '$CID'
           AND MONTH(book.booking_date) = '$month'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
             <tr class='table-padding' >
               <form method='post' action='viewBillDetails.php'>";
               if ($row["booking_type"] == 'installation' or $row["booking_type"] == 'problem')
               {
                 echo "<td>Maintenance Services";
                 echo "<td>".ucfirst($row["booking_type"])."</td>";
                 echo "<td>".$row["booking_date"]."</td>";
                 echo "<td>".$maint_price."</td>";
                 $total_price += $maint_price; //add up the prices
                 // echo $total_price;
               }

      echo "
               </tr>
             </form>";
     }
     echo "
     <tr class='table-padding' >
     <td></td>
     </tr>
     <tr class='table-padding' >
      <th></th>
      <th></th>
      <th></th>
      <th class = 'border border-dark border-start-0 border-end-0 border-3'>Total Price:</th>
      <th class = 'border border-dark border-start-0 border-end-0 border-3'>$total_price</th>
      </tr>

    </tbody> </table>";
   } else {
   echo "<td>No Maintenance usage found</td>";
   }

}



function addWaterUsage($company_name,$water_usage,$date)
{
  $homeowner_ID = $_SESSION['ID'];

  // get company_ID from company name
  $sql = "SELECT company_ID from Company where name= '$company_name'";
  $result = mysqli_query($this->conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $company_ID = $row['company_ID'];

  try
  {
    $sql = "SELECT * FROM Water_Tracking
    WHERE homeowner_ID ='$homeowner_ID'
    AND company_ID ='$company_ID '
    AND usage_date ='$date'";
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // echo $row['water_usage'];
   if ($result->num_rows > 0) {
      // echo "inside update";
      // echo $water_usage;
      $query = "UPDATE Water_Tracking
                SET
                water_usage ='$water_usage'
                WHERE homeowner_ID ='$homeowner_ID'
                AND company_ID ='$company_ID '
                AND usage_date ='$date'";
      $result = mysqli_query($this->conn, $query);
      // printf("Affected rows (INSERT): %d\n", $this->conn->affected_rows);
    }
  else{
    $sql = "INSERT INTO Water_Tracking (company_ID, homeowner_ID, usage_date, water_usage) VALUES ( '$company_ID', '$homeowner_ID', '$date','$water_usage')";
    $result = mysqli_query($this->conn, $sql);
  }
  }
  catch (mysqli_sql_exception $e)
  {
    echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
  }


}

}


class Admin{

private $conn = NULL;

function __construct() {
  include("conn.php");
  $this->conn = $conn;
}



function tableHeaderVerifyCompanies()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
            <tr class='table-padding text-white'>
              <th>Company ID</th>
              <th>Company Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Postal Code</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class='search-table'>";
}

function verifyCompanies(){
  try {
      $query = "select company_ID, name, email, phone, address, postal_code from company where verified = 0";

      $result = mysqli_query($this->conn, $query);

      if (mysqli_num_rows($result) < 1) {
          echo "<br><br>No companies are currently waiting for approval.<br><br>";
      } else {
          $this->tableHeaderVerifyCompanies();
          while (($row = mysqli_fetch_assoc($result)) != FALSE) {
              echo "<tr class='table-padding' >";
              echo "<form method='post' action='companyWaitingToBeVerified.php'>";
              echo "<td>" . $row['company_ID']?? "" . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td>" . $row['address'] ."</td>";
              echo "<td>" . $row['postal_code'] ."</td>";
              echo '<td>Awaiting</td>
              '.'<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                '<input type ="hidden" value ="'.$row["name"].'" name ="name"/>'.
                '<input type ="hidden" value ="'.$row["email"].'" name ="email"/>'.
                '<input type ="hidden" value ="'.$row["phone"].'" name ="phone"/>'.
                '<input type ="hidden" value ="'.$row["address"].'" name ="address"/>'.
                '<input type ="hidden" value ="'.$row["postal_code"].'" name ="postal_code"/>'.
              "<td class ='align-middle'><input type='submit' class='btn  btn-primary' value='Details'></td>
            </tr>
          </form>";


          }
          echo "  </tbody> </table>";
      }
  } catch (Exception $e){
      echo "<br><br>Companies is found<br><br>";
  }
}

function tableHeaderUserProfiles()
{
    echo "<table class='table table-hover datatable_style' >
    <thead>
    <tr class='table-padding text-white'>
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
}

function viewUserProfiles()
{

  $query = "SELECT ho.homeowner_ID AS ID, ho.username, ho.name, ho.email, ho.phone, ho.user_type, ho.suspended
            FROM homeowners AS ho
            WHERE ho.verified = '1'
            UNION
            SELECT comp.company_ID AS ID, comp.username, comp.name, comp.email, comp.phone, comp.user_type, comp.suspended
            FROM company AS comp
            WHERE comp.verified = '1'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderUserProfiles();
     while($row = $result->fetch_assoc()) {
            echo "
            <tr class='table-padding' >
              <form method='post' action='editUserProfiles.php'>
              <td>".$row["ID"]."</td>
              <td>".$row["username"]."</td>
              <td>".$row["name"]."</td>
              <td>".$row["email"]."</td>
              <td>".$row["phone"]."</td>
              <td>".$row["user_type"]."</td>";
              if($row["suspended"] == 0)
              {
                echo "<td>Active</td>";
              }
              else if($row["suspended"] == 1)
              {
                echo "<td>Suspended</td>";
              }
              echo '<input type ="hidden" value ="'.$row["ID"].'" name ="ID"/>'.
               '<input type="hidden" value ="'.$row["user_type"].'" name ="usertype"/>'.
               '<input type="hidden" value ="'.$row["suspended"].'" name ="suspended"/>'.
              "<td class ='align-middle'><input type='submit' class='btn btn-small btn-primary' name='Edit' value='Edit'></td>
            </tr>
          </form>";
        }



     echo "
     </tbody></table>";
   } else {
     echo "No Users Found";
   }

}



}

class Universal{

  private $conn = NULL;

  function __construct() {
    include("conn.php");
    $this->conn = $conn;
  }


  function servicesCheckBoxes(){
      $sql = "SELECT * FROM Services
              ORDER BY service_ID ASC";
      $result = mysqli_query($this->conn, $sql);

       if ($result->num_rows > 0) {
         // output data of each row
         while($row = $result->fetch_assoc()) {
           echo '
           <div class ="col-6 ">
           <div class="form-check form-check-inline">

             <input class="form-check-input" type="checkbox" name="services[]" value="'.$row["service_name"].'">
             <label class="form-check-label" for="services">'.$row["service_name"].'</label>
           </div>
           </div>

           ';
         }
         echo '
         <div class ="col-6 "></div>';
       }

  }
}
