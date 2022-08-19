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
  $HID = $_SESSION['ID'];
  $CompID = "";
  $getCompanyID = mysqli_query($this->conn, "SELECT * from Clients WHERE homeowner_ID = '$HID'");
  if(($Row = mysqli_fetch_assoc($getCompanyID)) == TRUE)
  {
      $CompID = $Row['company_ID'];
      $getcompanyname = mysqli_query($this->conn, "SELECT * FROM Company WHERE company_ID = '$CompID'");
      if(($Row = mysqli_fetch_assoc($getcompanyname)) == TRUE)
      {
          $name = $Row['name'];
          echo "<div class=\"form-floating mb-3\">
                      <input type = \"text\" id=\"company_name\" class=\"form-control\" name=\"company_name\" required value = '$name' READONLY>
                      <label for=\"company_name\">Company Name</label></div>";
      }
  }
  }

  function StaffDropDown(){

      $ID = $_SESSION['ID'];
      $getcompanyname = mysqli_query($this->conn, "SELECT * FROM Maintenance_Staff WHERE company_ID = '$ID' AND status = \"Not Assigned\"");

    echo '<div class="condi-dropdown mb-3">
      <select id="staff_name_ID" class="form-select" name="staff_name_ID" required>
          <option value="" default disabled>Assign a Staff</option>';
          while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) {
                       $name = $Row['staff_name'];
                       $staff_id = $Row['staff_ID'];
                       $role = $Row['staff_role'];
                      echo "<option value=$staff_id>$name - $role</option>";
                     };
          echo'  </select>
          </div>';
  }

  function tableHeader()
  {
    echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding text-white'>
              <th>Name</th>
              <th class='hide-box'>Services Offered</th>
              <th>Address</th>
              <th class='hide-box'>Ratings</th>
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

       //calcualte the average rating of a particular company
       $companyID = $row['company_ID'];
          try {
            $getAverageRating = mysqli_query($this->conn, "select avg(score) from Ratings where company_ID = $companyID");
            $averageRating = $getAverageRating->fetch_array()[0] ?? '';
            //echo $averageRating;

          } catch (mysqli_sql_exception $e) {
            echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
          }
      echo "
                <tr class='table-padding' >
                  <form method='post' action=''>
                  <td>".$row["name"]."</td>
                  <td class='hide-box'>".$row["service_grouped"]."</td>
                  <td>".$row["address"]."</td> <td class='hide-box'>".number_format(floatval($averageRating), 1)." </td>
                  ".'<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                    '<input type ="hidden" value ="'.$row["email"].'" name ="company_email"/>'.
                    '<input type ="hidden" value ="'.$row["phone"].'" name ="company_phone"/>'.
                    '<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                    '<input type ="hidden" value ="'.$row["address"].'" name ="company_address"/>'.
                    '<input type ="hidden" value ="'.$row["postal_code"].'" name ="company_postal"/>'.
                    '<input type ="hidden" value ="'.$row["description"].'" name ="company_description"/>'.
                    '<input type ="hidden" value ="'.$row["service_grouped"].'" name ="service_grouped"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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
            <th class='hide-box'>Enquiry #</th>
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
                  <td class='hide-box'>".$row["case_ID"]."</td>
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
                    '<input type ="hidden" value ="'.$row["case_reply"].'" name ="case_reply"/>'.
                    '<input type ="hidden" value ="" name ="reply"/>'.
                  "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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
            <th class='hide-box'>Booking #</th>
            <th>Client Name</th>
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
                 <td class='hide-box'>".$row["booking_ID"]."</td>
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
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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

function closeCase($case_ID){
  $query = "UPDATE Cases
            SET
            case_status = 'Closed'
            WHERE case_ID ='$case_ID'";

  $result = mysqli_query($this->conn, $query);

  }


function tableHeaderStaff()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding text-white'>
            <th class='hide-box'>Staff ID</th>
            <th>Name</th>
            <th class='hide-box'>Email</th>
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
            JOIN Company AS comp
            ON staff.company_ID = comp.company_ID
            WHERE staff.company_ID = $company_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderStaff();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='viewStaffDetails.php'>";
      echo "<td class='hide-box'>".$row["staff_ID"]."</td>";
      echo "<td>".$row["staff_name"]."</td>";
      echo "<td class='hide-box'>".$row["email"]."</td>";
      echo "<td>".$row["phone"]."</td>";
      echo "<td>".$row["staff_role"]."</td>";
      echo '<td>'.$row["status"].'</td>'
      .'<input type ="hidden" value ="'.$row["staff_ID"].'" name ="staff_ID"/>'
      .'<input type ="hidden" value ="'.$row["staff_name"].'" name ="staff_name"/>'
      .'<input type ="hidden" value ="'.$row["email"].'" name ="staff_email"/>'
      .'<input type ="hidden" value ="'.$row["phone"].'" name ="staff_phone"/>'
      .'<input type ="hidden" value ="'.$row["staff_role"].'" name ="staff_role"/>'
      .'<input type ="hidden" value ="'.$row["status"].'" name ="staff_status"/>'
      ."<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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

  $sql = "UPDATE Maintenance_Staff set staff_role = '$staff_role', staff_name = '$staff_name', email = '$staff_email', phone = '$staff_phone' where staff_ID = $staff_ID";
  //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
  mysqli_query($this->conn, $sql);

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

}

function deleteStaff($staff_ID){
    try {
        $sql = "DELETE FROM Maintenance_Staff WHERE staff_ID =$staff_ID";
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
    <th class='hide-box'>ID</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Installation Date</th>
    <th class='hide-box'>Warranty Date</th>
    <th class='hide-box'>Expiry Date</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody class='search-table'>";
}

function listEquipment(){
  $company_ID = $_SESSION['ID'];
    $query = "SELECT equip.equipment_ID, equip.company_ID, equip.equipment_name, equip.quantity, equip.installation_date, equip.warranty_date, equip.expiry_date
              FROM Maintenance_Equipment AS equip
              JOIN Company AS comp
              ON equip.company_ID = comp.company_ID
              WHERE equip.company_ID = $company_ID";
    $result = mysqli_query($this->conn, $query);

     if ($result->num_rows > 0) {

       $this->tableHeaderEquipment();
       // output data of each row
       while($row = $result->fetch_assoc()) {
          echo "<tr class='table-padding' >";
          echo "<form method='post' action='viewEquipmentDetails.php'>";
          echo "<td class='hide-box'>".$row["equipment_ID"]."</td>";
          echo "<td>".$row["equipment_name"]."</td>";
          echo "<td>".$row["quantity"]."</td>";
          echo "<td>".$row["installation_date"]."</td>";
          echo "<td class='hide-box'>".$row["warranty_date"]."</td>";
          echo "<td class='hide-box'>".$row["expiry_date"]."</td>"
          .'<input type ="hidden" value ="'.$row["equipment_ID"].'" name ="equipment_ID"/>'
          .'<input type ="hidden" value ="'.$row["equipment_name"].'" name ="equipment_name"/>'
          .'<input type ="hidden" value ="'.$row["quantity"].'" name ="quantity"/>'
          .'<input type ="hidden" value ="'.$row["installation_date"].'" name ="installation_date"/>'
          .'<input type ="hidden" value ="'.$row["warranty_date"].'" name ="warranty_date"/>'
          .'<input type ="hidden" value ="'.$row["expiry_date"].'" name ="expiry_date"/>'
          ."<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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

  $sql = "UPDATE Maintenance_Equipment set  equipment_name = '$equipment_name', quantity = '$quantity', installation_date = '$installation_date' ,warranty_date = '$warranty_date' ,expiry_date = '$expiry_date' where equipment_ID = $equipment_ID";
  //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
  mysqli_query($this->conn, $sql);

}  catch (mysqli_sql_exception $e) {
  echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
}

}

function deleteEquipment($equipment_ID){
    try {
        $sql = "DELETE FROM Maintenance_Equipment WHERE equipment_ID =$equipment_ID";
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



function tableHeaderClient()
{
  echo "<table class='table table-hover datatable_style' >
  <thead>
  <tr class='table-padding text-white'>
    <th>Client ID</th>
    <th>Name</th>
    <th>Start Date</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody class='search-table'>";
}

function listClients(){
  $company_ID = $_SESSION['ID'];
  $query = "SELECT cl.client_ID, cl.homeowner_ID,cl.start_date,ho.name
            FROM Clients as cl
            JOIN Homeowners AS ho
            ON cl.homeowner_ID = ho.homeowner_ID
            WHERE cl.company_ID = $company_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderClient();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='ViewClientDetails.php'>";
      echo "<td>".$row["client_ID"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo '<td>'.$row["start_date"].'</td>'
      .'<input type ="hidden" value ="'.$row["client_ID"].'" name ="client_ID"/>'
      .'<input type ="hidden" value ="'.$row["name"].'" name ="name"/>'
      .'<input type ="hidden" value ="'.$row["start_date"].'" name ="start_date"/>'."</td>
      <td class ='align-middle'><input type='submit' class='btn btn-mobile btn-primary' value='Details'></td>
          </tr>
        </form>";
     }
     echo "</tbody></table>";
   } else {
     echo "No Customers Found";
   }

}

function tableHeaderClientQuick()
{
  echo "<table class='table table-hover datatable_style3' >
  <thead>
  <tr class='table-padding text-white'>
    <th>Client ID</th>
    <th>Name</th>
    <th>Start Date</th>
  </tr>
  </thead>
  <tbody class='search-table'>";
}

function listClientsQuick(){
  $company_ID = $_SESSION['ID'];
  $query = "SELECT cl.client_ID, cl.homeowner_ID,cl.start_date,ho.name
            FROM Clients as cl
            JOIN Homeowners AS ho
            ON cl.homeowner_ID = ho.homeowner_ID
            WHERE cl.company_ID = $company_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderClientQuick();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='ViewClientDetails.php'>";
      echo "<td>".$row["client_ID"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo '<td>'.$row["start_date"].'</td>'
      ."  </tr>
        </form>";
     }
     echo "</tbody></table>";
   } else {
     echo "No Customers Found";
   }

}


function tableHeaderListClientBills()
{
  echo "<table class='table table-hover datatable_style' >
  <thead>
  <tr class='table-padding text-white'>
    <th>Client ID</th>
    <th>Name</th>
    <th>Contract Date</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody class='search-table'>";
}

function listClientsBills(){
  $company_ID = $_SESSION['ID'];
  $query = "SELECT cl.client_ID, cl.homeowner_ID,cl.start_date,ho.name,ho.address,ho.postal_code
            FROM Clients as cl
            JOIN Homeowners AS ho
            ON cl.homeowner_ID = ho.homeowner_ID
            WHERE cl.company_ID = $company_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderListClientBills();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='viewBillsClients.php'>";
      echo "<td>".$row["client_ID"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo '<td>'.$row["start_date"].'</td>'
      .'<input type ="hidden" value ="'.$row["client_ID"].'" name ="client_ID"/>'
      .'<input type ="hidden" value ="'.$row["name"].'" name ="client_name"/>'
      .'<input type ="hidden" value ="'.$row["start_date"].'" name ="start_date"/>'
      .'<input type ="hidden" value ="'.$row["address"].'" name ="client_address"/>'
      .'<input type ="hidden" value ="'.$row["postal_code"].'" name ="client_postal_code"/>'
      ."<td class ='align-middle'><input type='submit' class='btn btn-primary btn-mobile me-2' name='viewbills' value='View Bills'></td>
  </tr>
</form>";
     }
     echo "</tbody></table>";
   } else {
     echo "No Customers Found";
   }

}

function tableHeaderClientBillDetails()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding text-white'>
            <th>Bill #</th>
            <th>Client Name</th>
            <th>Bill Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

function listClientBillDetails()
{
  $ID = $_SESSION['ID'];
  $client_ID = $_SESSION["client_ID"];
  $client_name = $_SESSION["client_name"];

 $query = "SELECT bill.*
           FROM Bills AS bill
           WHERE client_ID = '$client_ID'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderClientBillDetails();
     // output data of each row
     while($row = $result->fetch_assoc()) {

     echo "
               <tr class='table-padding' >
                 <form method='post' action='viewBillDetailsComp.php'>
                 <td>".$row["bill_ID"]."</td>
                 <td>".$client_name."</td>
                 <td>".$row["bill_date"]."</td>
                 <td>".$row["bill_due_date"]."</td>
                 <td>".$row["bill_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["bill_ID"].'" name ="bill_ID"/>'.
                   '<input type ="hidden" value ="'.$client_name.'" name ="company_name"/>'.
                   '<input type ="hidden" value ="'.$row["bill_date"].'" name ="bill_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_due_date"].'" name ="bill_due_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_status"].'" name ="bill_status"/>'.
                   '<input type ="hidden" value ="'.$row["homeowner_ID"].'" name ="homeowner_ID"/>'.
                   '<input type ="hidden" value ="'.$_SESSION["address"].'" name ="company_address"/>'.
                   '<input type ="hidden" value ="'.$_SESSION["postal_code"].'" name ="company_postal"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'>
                 </td>
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

function listBillDetailsCompany(){
  $ID = $_SESSION['ID'];
  $HID = $_SESSION['homeowner_ID'];
  $month = $_SESSION['bill_month'];
  $total_price = 0;
  $no_maint = 0;
  $no_water = 0;


  $query = "SELECT price FROM Company_Services WHERE service_ID = '1' AND company_ID = '$ID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  $water_price = $row["price"];


  $query = "SELECT water.*,SUM(water.water_usage) AS total_water,comp.*
            FROM Water_Tracking AS water
            JOIN Company AS comp
            ON water.company_ID = comp.company_ID
            WHERE water.homeowner_ID = '$HID'
            AND comp.company_ID = '$ID'
            AND MONTH(water.usage_date) = '$month'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBillDetails();
     while($row = $result->fetch_assoc()) {
       if (is_null($row["total_water"]))
       {
         echo "
           <tr class='table-padding' ><td>No Water usage found</td>
           </tr>";
           $no_water = 1;
       }
       else {
         echo "<tr class='table-padding' >
                 <form method='post' action=''>";
                 echo "<td>Water Usage</td>";
                 echo "<td>".$row["total_water"]."m³</td>";
                 echo "<td></td>";
                 echo "<td>".$water_price."</td>";
                 echo "<td>".$water_price * $row["total_water"]."</td>";
                 $total_price += $water_price * $row["total_water"]; //add up the prices
                 $_SESSION['total_price'] = $total_price;

                 // <input type="submit" class="btn btn-lg btn-primary me-4  float-end" value="Make Payment">
                 echo "</tr></form>";

       }

     }
   } else {
     echo "
       <tr class='table-padding' ><td>No Water usage found</td>
       </tr>";
     $no_water = 1;
   }




  $query = "SELECT price FROM Company_Services WHERE service_ID = '2' AND company_ID = '$ID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  if($result->num_rows > 0)
  {
    $maint_price = $row["price"];
  }


 $query = "SELECT book.*,comp.*
           FROM Bookings AS book
           JOIN Company AS comp
           ON book.company_ID = comp.company_ID
           WHERE book.homeowner_ID = '$HID'
           AND comp.company_ID = '$ID'
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


    $query = "SELECT discount_ID FROM Clients WHERE homeowner_ID = '$HID' AND company_ID = '$ID'";
    $result = mysqli_query($this->conn, $query);
    $row = $result->fetch_assoc();
    $discount_ID = $row["discount_ID"];


    $query = "SELECT discount_name,discount_modifier
              FROM Discounts
              WHERE discount_ID ='$discount_ID'
              AND company_ID = '$ID'";

    $result = mysqli_query($this->conn, $query);

     if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr class='table-padding' >
                    <form method='post' action=''>";
                    echo "<td>Discount</td>";
                    echo "<td>".$row["discount_name"]."</td>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td>".$row["discount_modifier"]."%</td>";
                    // <input type="submit" class="btn btn-lg btn-primary me-4  float-end" value="Make Payment">
                    echo "</tr></form>";
                   $total_price = $total_price * ((100 - $row["discount_modifier"])/100); //get discounted price


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
         <th class = 'border border-dark border-start-0 border-end-0 border-3'>$".number_format($total_price, 2)."</th>
         </tr>

       </tbody> </table>";
      } else {
      echo" </tbody> </table>";
      }

    if ($no_maint == 1 && $no_water == 1)
    {
      return 1;
    }
    else {
      return 0;
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
              <th class='hide-box'>Enquiry #</th>
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
                          <td class='hide-box'>" . $Row['case_ID'] . "</td>".
                         "<td>" . $Row['case_subject'] . "</td>".
                         "<td>" . $Row['name'] . "</td>".
                         "<td>" . $Row['case_date'] ."</td>".
                         "<td>" . $Row['case_status'] ."</td>".
                         "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' name='Details' value='Details'></td>".
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
  $sql = "SELECT client_ID FROM Clients where homeowner_ID = '$homeowner_ID'";
  $result = mysqli_query($this->conn, $sql);
  if (mysqli_num_rows($result) < 1) {
    return True;
  }
  else {
    return False;
  }
}

function insertBooking($company_name,$date,$details,$booking_type,$booking_image)
{
  // get company_ID from company name
  $sql = "SELECT company_ID from Company where name = '$company_name'";
  $result = mysqli_query($this->conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $company_ID = $row['company_ID'];
  $ID = $_SESSION['ID'];


  $sql = "SELECT client_ID from Clients where company_ID = '$company_ID' AND homeowner_ID='$ID'";
  $result = mysqli_query($this->conn, $sql);
  if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $client_ID = $row['client_ID'];

    try
    {
      $sql = "INSERT INTO Bookings (company_ID, homeowner_ID,client_ID, booking_date,booking_description,booking_type,booking_status,booking_image) VALUES ( '$company_ID', '$ID','$client_ID', '$date', '$details', '$booking_type', 'In Progress','$booking_image')";
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
  else {
    return False;
  }


}

function addClient($company_ID,$date)
{
  $homeowner_ID = $_SESSION['ID'];

  try
  {
    $sql = "SELECT discount_ID FROM Discounts where company_ID = '$company_ID'";
    $result = $this->conn->query($sql);
   if ($result->num_rows > 0) {
     $row = mysqli_fetch_assoc($result);
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
    echo "<p>Error " . mysqli_errno($this->conn). ":!!!! " . mysqli_error($this->conn) . "</p>";
    return False;
  }


}


function tableHeaderBookingHome()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding text-white'>
            <th class='hide-box'>Booking #</th>
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
                 <td class='hide-box'>".$row["booking_ID"]."</td>
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
                 "<td class ='align-middle'><input type='submit' class='btn btn-primary btn-mobile'name='details' value='Details'></td>
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
            <th class='hide-box'>Bill #</th>
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
           WHERE homeowner_ID = '$ID' AND bill_status = \"pending\"";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderBills();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action='viewBillDetails.php'>
                 <td class='hide-box'>".$row["bill_ID"]."</td>
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
                 "<td class ='align-middle'><input type='submit' class='btn btn-primary btn-mobile' value='Details'></td>
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
              <th>Price</th>
              <th>Total Price</th>
            </tr>
          </thead>
          <tbody class='search-table'>";
}

function listBillDetailsHomeowner(){
  $ID = $_SESSION['ID'];
  $CID = $_SESSION['company_ID'];
  $month = $_SESSION['bill_month'];
  $total_price = 0;
  $no_maint = 0;
  $no_water = 0;


  $query = "SELECT price FROM Company_Services WHERE service_ID = '1' AND company_ID = '$CID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  $water_price = $row["price"];


  $query = "SELECT water.*,SUM(water.water_usage) AS total_water
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
        if (is_null($row["total_water"]))
        {
          echo "
            <tr class='table-padding' ><td>No Water usage found</td>
            </tr>";
            $no_water = 1;
        }
        else {
          echo "<tr class='table-padding' >
                  <form method='post' action=''>";
                  echo "<td>Water Usage</td>";
                  echo "<td>".$row["total_water"]."m³</td>";
                  echo "<td></td>";
                  echo "<td>".$water_price."</td>";
                  echo "<td>".$water_price * $row["total_water"]."</td>";
                  $total_price += $water_price * $row["total_water"]; //add up the prices
                  $_SESSION['total_price'] = $total_price;

                  // <input type="submit" class="btn btn-lg btn-primary me-4  float-end" value="Make Payment">
                  echo "</tr></form>";

        }

      }
    } else {
      echo "
        <tr class='table-padding' ><td>No Water usage found</td>
        </tr>";
      $no_water = 1;
    }


  $query = "SELECT price FROM Company_Services WHERE service_ID = '2' AND company_ID = '$CID'";
  $result = mysqli_query($this->conn, $query);
  $row = $result->fetch_assoc();
  if($result->num_rows > 0)
  {
    $maint_price = $row["price"];
  }

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
   } else {
   echo "<td>No Maintenance usage found</td>";
    $no_maint = 1;
   }


   $query = "SELECT discount_ID FROM Clients WHERE homeowner_ID = '$ID' AND company_ID = '$CID'";
   $result = mysqli_query($this->conn, $query);
   $row = $result->fetch_assoc();
   $discount_ID = $row["discount_ID"];


   $query = "SELECT discount_name,discount_modifier
             FROM Discounts
             WHERE discount_ID ='$discount_ID'
             AND company_ID = '$CID'";

   $result = mysqli_query($this->conn, $query);

    if ($result->num_rows > 0) {
       while($row = $result->fetch_assoc()) {
           echo "<tr class='table-padding' >
                   <form method='post' action=''>";
                   echo "<td>Discount</td>";
                   echo "<td>".$row["discount_name"]."</td>";
                   echo "<td></td>";
                   echo "<td></td>";
                   echo "<td>".$row["discount_modifier"]."%</td>";
                   // <input type="submit" class="btn btn-lg btn-primary me-4  float-end" value="Make Payment">
                   echo "</tr></form>";
                  $total_price = $total_price * ((100 - $row["discount_modifier"])/100); //get discounted price


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
        <th class = 'border border-dark border-start-0 border-end-0 border-3'>$".number_format($total_price, 2)."</th>
        </tr>

      </tbody> </table>";
     } else {
     echo" </tbody> </table>";
     }

   if ($no_maint == 1 && $no_water == 1)
   {
     return 1;
   }
   else {
     return 0;
   }

}



function addWaterUsage($company_name,$water_usage,$date)
{
  $homeowner_ID = $_SESSION['ID'];
  $date_time = strtotime($date);
  $month= date("F",$date_time); //get name of month
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
    AND usage_date ='$date'"; //check if data for selected date already exists
    $result = mysqli_query($this->conn, $sql);
    $row = mysqli_fetch_assoc($result);
    // echo $row['water_usage'];
   if ($result->num_rows > 0) { //if it exists, update the data in the row
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
  else{ // if it doesn't exist, insert new data into the table
    $sql = "INSERT INTO Water_Tracking (company_ID, homeowner_ID, usage_date, month ,water_usage) VALUES ( '$company_ID', '$homeowner_ID', '$date','$month','$water_usage')";
    $result = mysqli_query($this->conn, $sql);
  }
  }
  catch (mysqli_sql_exception $e)
  {
    echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
  }


}

function tableHeaderPaid()
{
  echo "<table class='table table-hover datatable_style' >
          <thead>
          <tr class='table-padding text-white'>
            <th>Bill #</th>
            <th>Company Name</th>
            <th>Bill Date</th>
            <th>Date Paid</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
          </thead>
          <tbody class='search-table'>";
}

function listPaidHomeowner(){
  $ID = $_SESSION['ID'];

 $query = "SELECT bill.*,comp.company_ID,comp.name,comp.address,comp.postal_code
           FROM Bills AS bill
           JOIN Company AS comp
           ON bill.company_ID = comp.company_ID
           WHERE homeowner_ID = '$ID' AND bill_status = \"Paid\"";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderPaid();
     // output data of each row
     while($row = $result->fetch_assoc()) {
     echo "
               <tr class='table-padding' >
                 <form method='post' action='viewBillDetails.php'>
                 <td>".$row["bill_ID"]."</td>
                 <td>".$row["name"]."</td>
                 <td>".$row["bill_date"]."</td>
                 <td>".$row["bill_payment_date"]."</td>
                 <td>".$row["bill_status"]."</td>
                 ".'<input type ="hidden" value ="'.$row["bill_ID"].'" name ="bill_ID"/>'.
                   '<input type ="hidden" value ="'.$row["name"].'" name ="company_name"/>'.
                   '<input type ="hidden" value ="'.$row["bill_date"].'" name ="bill_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_due_date"].'" name ="bill_due_date"/>'.
                   '<input type ="hidden" value ="'.$row["bill_status"].'" name ="bill_status"/>'.
                   '<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                   '<input type ="hidden" value ="'.$row["address"].'" name ="company_address"/>'.
                   '<input type ="hidden" value ="'.$row["postal_code"].'" name ="company_postal"/>'.
                 "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
               </tr>
             </form>";
     }
     echo "
     </tbody></table>";
   } else {
     echo "No Bills Found";
   }

}

function tableHeaderContracted()
{
  echo "<table class='table table-hover datatable_style' >
  <thead>
  <tr class='table-padding text-white'>
    <th>Company ID</th>
    <th>Company Name</th>
    <th>Start Date</th>
    <th>Action</th>
  </tr>
  </thead>
  <tbody class='search-table'>";
}

function listContracted(){
  $homeowner_ID = $_SESSION['ID'];
  $query = "SELECT cl.company_ID, cl.homeowner_ID, cl.start_date, co.name
            FROM Clients as cl
            JOIN Company AS co
            ON cl.company_ID = co.company_ID
            WHERE cl.homeowner_ID = $homeowner_ID";
  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderContracted();
     // output data of each row
     while($row = $result->fetch_assoc()) {
      echo "<tr class='table-padding' >";
      echo "<form method='post' action='cancelContract.php'>";
      echo "<td>".$row["company_ID"]."</td>";
      echo "<td>".$row["name"]."</td>";
      echo '<td>'.$row["start_date"].'</td>'
      .'<input type ="hidden" value ="'.$row["company_ID"].'" name ="client_ID"/>'
      .'<input type ="hidden" value ="'.$row["name"].'" name ="name"/>'
      .'<input type ="hidden" value ="'.$row["start_date"].'" name ="start_date"/>'."</td>
      <td class ='align-middle'><input type='submit' class='btn btn-mobile btn-primary' value='Cancel Contract'></td>
          </tr>
        </form>";
     }
     echo "</tbody></table>";
   } else {
     echo "Not currently contracted to a company";
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
              <th class='hide-box'>Company ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th class='hide-box'>Postal Code</th>
              <th class='hide-box'>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class='search-table'>";
}

function verifyCompanies(){
  try {
      $query = "SELECT company_ID, name, email, phone, address, postal_code from Company where verified = 0";

      $result = mysqli_query($this->conn, $query);

      if (mysqli_num_rows($result) < 1) {
          echo "<br><br>No companies are currently waiting for approval.<br><br>";
      } else {
          $this->tableHeaderVerifyCompanies();
          while (($row = mysqli_fetch_assoc($result)) != FALSE) {
              echo "<tr class='table-padding' >";
              echo "<form method='post' action='companyWaitingToBeVerified.php'>";
              echo "<td class='hide-box'>" . $row['company_ID']?? "" . "</td>";
              echo "<td>" . $row['name'] . "</td>";
              echo "<td>" . $row['email'] . "</td>";
              echo "<td>" . $row['phone'] . "</td>";
              echo "<td>" . $row['address'] ."</td>";
              echo "<td class='hide-box'>" . $row['postal_code'] ."</td>";
              echo '<td class="hide-box">Awaiting</td>
              '.'<input type ="hidden" value ="'.$row["company_ID"].'" name ="company_ID"/>'.
                '<input type ="hidden" value ="'.$row["name"].'" name ="name"/>'.
                '<input type ="hidden" value ="'.$row["email"].'" name ="email"/>'.
                '<input type ="hidden" value ="'.$row["phone"].'" name ="phone"/>'.
                '<input type ="hidden" value ="'.$row["address"].'" name ="address"/>'.
                '<input type ="hidden" value ="'.$row["postal_code"].'" name ="postal_code"/>'.
              "<td class ='align-middle'><input type='submit' class='btn  btn-primary btn-mobile' value='Details'></td>
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
      <th class='hide-box'>User ID</th>
      <th>Username</th>
      <th>Name</th>
      <th class='hide-box'>Email</th>
      <th class='hide-box'>Phone</th>
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
            FROM Homeowners AS ho
            WHERE ho.verified = '1'
            UNION
            SELECT comp.company_ID AS ID, comp.username, comp.name, comp.email, comp.phone, comp.user_type, comp.suspended
            FROM Company AS comp
            WHERE comp.verified = '1'";

  $result = mysqli_query($this->conn, $query);

   if ($result->num_rows > 0) {
     $this->tableHeaderUserProfiles();
     while($row = $result->fetch_assoc()) {
            echo "
            <tr class='table-padding' >
              <form method='post' action='editUserProfiles.php'>
              <td class='hide-box'>".$row["ID"]."</td>
              <td>".$row["username"]."</td>
              <td>".$row["name"]."</td>
              <td class='hide-box'>".$row["email"]."</td>
              <td class='hide-box'>".$row["phone"]."</td>
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
               '<input type="hidden" value ="'.$row["user_type"].'" name ="user_type"/>'.
               '<input type="hidden" value ="'.$row["suspended"].'" name ="suspended"/>'.
              "<td class ='align-middle'><input type='submit' class='btn btn-mobile btn-primary' name='Edit' value='Edit'></td>
            </tr>
          </form>";
        }



     echo "
     </tbody></table>";
   } else {
     echo "No Users Found";
   }

}


function tableHeaderEnquiriesAdmin()
  {
    echo "<table class='table table-hover  datatable_style' >
            <thead>
            <tr class='table-padding text-white'>
              <th class='hide-box'>Enquiry #</th>
              <th class='hide-box'>User #</th>
              <th>Name</th>
              <th>User Type</th>
			        <th>Subject</th>
              <th>Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
  }

  function viewEnquiriesAdmin(){

   $ID = $_SESSION['ID'];

    try { //Get all homeowner enquiries and display them
       $query = "SELECT * FROM Enquiries_Homeowner as eq
                 JOIN Homeowners as ho
                 ON eq.homeowner_ID = ho.homeowner_ID
                 WHERE eq.user_type ='homeowner'";
                 // SELECT eq.*,comp.name as company_name  FROM Enquiries as eq
                 // JOIN Company as comp
                 // ON eq.user_ID = comp.company_ID";

       $result = mysqli_query($this->conn, $query);

       if (mysqli_num_rows($result) < 1) {
           echo "<br><br>No enquiries are found.<br><br>";
       } else {
          $this->tableHeaderEnquiriesAdmin();
           while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

             if(  $Row['user_type'] == 'homeowner')
             {
               echo "
                       <tr class='table-padding'>
                       <form method='post' action='replyEnquiry.php'>
                          <td class='hide-box'>" . $Row['eh_ID'] . "</td>".
                         "<td class='hide-box'>" . $Row['homeowner_ID'] . "</td>".
                         "<td>" . $Row['name'] . "</td>".
                         "<td>" . $Row['user_type'] . "</td>".
                         "<td>" . $Row['enquiry_subject'] . "</td>".
                         "<td>" . $Row['enquiry_date'] ."</td>".
                         "<td>" . $Row['enquiry_status'] ."</td>".
                         "<input type ='hidden' value ='".$Row['eh_ID']."' name ='enquiry_ID'/>".
                         "<input type ='hidden' value ='".$Row['homeowner_ID']."' name ='user_id'/>".
                         "<input type ='hidden' value ='".$Row['name']."' name ='name'/>".
                         "<input type ='hidden' value ='".$Row['enquiry_subject']."' name ='enquiry_subject'/>".
                         "<input type ='hidden' value ='".$Row['enquiry_date']."' name ='enquiry_date'/>".
                         "<input type ='hidden' value ='".$Row['enquiry_description']."' name ='enquiry_description'/>".
                         "<input type ='hidden' value ='".$Row['user_type']."' name ='user_type'/>".
                         "<input type ='hidden' value ='".$Row['enquiry_status']."' name ='enquiry_status'/>".
                         "<input type ='hidden' value ='".$Row['enquiry_reply']."' name ='enquiry_reply'/>".
                         "<td class ='align-middle'><input type='submit' class='btn btn-mobile btn-primary' name='Details' value='Details'></td>".
                      " </tr>
                     </form>";
              }
           }

        // get all company enquiries and display them
        $query = "SELECT eq.*,comp.name FROM Enquiries_Company as eq
                  JOIN Company as comp
                  ON eq.company_ID = comp.company_ID
                  WHERE eq.user_type ='company'";

         $result = mysqli_query($this->conn, $query);

         if (mysqli_num_rows($result) < 1) {
             echo "<br><br>No enquiries are found.<br><br>";
         } else {
             while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

               if(  $Row['user_type'] == 'company')
               {
                 echo "
                         <tr class='table-padding'>
                         <form method='post' action='replyEnquiry.php'>
                            <td class='hide-box'>" . $Row['ec_ID'] . "</td>".
                           "<td class='hide-box'>" . $Row['company_ID'] . "</td>".
                           "<td>" . $Row['name'] . "</td>".
                           "<td>" . $Row['user_type'] . "</td>".
                           "<td>" . $Row['enquiry_subject'] . "</td>".
                           "<td>" . $Row['enquiry_date'] ."</td>".
                           "<td>" . $Row['enquiry_status'] ."</td>".
                           "<td class ='align-middle'><input type='submit' class='btn btn-mobile btn-primary' name='Details' value='Details'></td>".
                           "<input type ='hidden' value ='".$Row['ec_ID']."' name ='enquiry_ID'/>".
                           "<input type ='hidden' value ='".$Row['company_ID']."' name ='user_id'/>".
                           "<input type ='hidden' value ='".$Row['name']."' name ='name'/>".
                           "<input type ='hidden' value ='".$Row['enquiry_subject']."' name ='enquiry_subject'/>".
                           "<input type ='hidden' value ='".$Row['enquiry_date']."' name ='enquiry_date'/>".
                           "<input type ='hidden' value ='".$Row['enquiry_description']."' name ='enquiry_description'/>".
                           "<input type ='hidden' value ='".$Row['user_type']."' name ='user_type'/>".
                           "<input type ='hidden' value ='".$Row['enquiry_status']."' name ='enquiry_status'/>"."
                         </tr>
                       </form>";
                }
             }
           }


           echo "</tbody></table>";
       }
    } catch (Exception $e){
       echo "<br><br>No enquiries are found.<br><br>";
       echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
    }
  }

  function closeEnquiry($enquiry_ID,$admin_ID,$enquiry_user_type){
      if ($enquiry_user_type == "homeowner")
      {
        $query = "UPDATE Enquiries_Homeowner
                  SET
                  admin_ID ='$admin_ID' ,
                  enquiry_status = \"Closed\"
                  WHERE eh_ID ='$enquiry_ID'";

        $result = mysqli_query($this->conn, $query);
      }
      else if ($enquiry_user_type == "company")
      {
        $query = "UPDATE Enquiries_Company
                  SET
                  admin_ID ='$admin_ID' ,
                  enquiry_status = \"Closed\"
                  WHERE ec_ID ='$enquiry_ID'";

        $result = mysqli_query($this->conn, $query);
      }

      }

   function tableHeaderServiceAdmin()
  {
    echo "<table class='table table-hover datatable_style' >
            <thead>
            <tr class='table-padding text-white'>
              <th>Service ID #</th>
              <th>Service Name</th>
              <th>Action</th>
            </tr>
            </thead>
            <tbody class='search-table'>";
  }

  function viewServiceAdmin(){
   $count = 0;
   $ID = $_SESSION['ID'];

   $query = "SELECT * FROM Services
             ORDER BY service_ID";

   // $query = "SELECT serv.service_name, cs.service_ID, COUNT(*) as total
   //           FROM Services as serv
   //           LEFT JOIN
   //           Company_Services as cs
   //           ON serv.service_ID = cs.service_ID
   //           GROUP BY service_ID
   //           ORDER BY service_ID";

   $result = mysqli_query($this->conn, $query);

    if ($result->num_rows > 0) {
      $this->tableHeaderServiceAdmin();
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $count += 1;
      echo "
                <tr class='table-padding' >
                  <form method='post' action='deleteServiceAdmin.php'>
                  <td>".$row["service_ID"]."</td>
                  <td>".$row["service_name"]."</td>
                  ".'<input type ="hidden" value ="'.$row["service_ID"].'" name ="service_ID"/>'.
                    '<input type ="hidden" value ="'.$row["service_name"].'" name ="service_name"/>';
              if($count < 3)
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
    } else {
      echo "No Companies Found";
    }
}

  function deleteService($service_ID){
    try {
        $sql = "DELETE FROM Services WHERE service_ID= $service_ID";
        //printf("Affected rows (INSERT): %d\n", $conn->affected_rows);
        mysqli_query($this->conn, $sql);
	}

    catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn);
    }
  }



  function updateEnquiry($reply,$enquiry_ID,$admin_ID,$enquiry_user_type){
    if ($enquiry_user_type == "homeowner")
    {
      $query = "UPDATE Enquiries_Homeowner
                SET
                enquiry_reply ='$reply' ,
                admin_ID ='$admin_ID' ,
                enquiry_status = 'Replied'
                WHERE eh_ID ='$enquiry_ID'";

      $result = mysqli_query($this->conn, $query);
    }
    else if ($enquiry_user_type == "company")
    {
      $query = "UPDATE Enquiries_Company
                SET
                enquiry_reply ='$reply' ,
                admin_ID ='$admin_ID' ,
                enquiry_status = 'Replied'
                WHERE ec_ID ='$enquiry_ID'";

      $result = mysqli_query($this->conn, $query);
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
           <div class ="col-md-6 ">
           <div class="form-check form-check-inline">

             <input class="form-check-input" type="checkbox" name="services[]" value="'.$row["service_name"].'">
             <label class="form-check-label" for="services">'.$row["service_name"].'</label>
           </div>
           </div>

           ';
         }
         echo '
         <div class ="col-md-6 "></div>';
       }

  }



  function MonthDropDown(){

    echo '<div class="condi-dropdown mb-3">
      <select id="bill_month" class="form-select" name="bill_month" required>
          <option value="January" >January</option>
          <option value="February" >February</option>
          <option value="March" >March</option>
          <option value="April" >April</option>
          <option value="May" >May</option>
          <option value="June" >June</option>
          <option value="July" >July</option>
          <option value="August" >August</option>
          <option value="September" >September</option>
          <option value="October" >October</option>
          <option value="November" >November</option>
          <option value="December" >December</option></select>
          </div>';
  }

  function SendMail($subject, $msg, $recipient_email)
  {
    $header ="From: fypscom@fyp-22-s2-27.com" . "\r\n" . "Content-Type: text/plain; charset=utf-8";

    // use wordwrap() if lines are longer than 70 characters
    $msg = wordwrap($msg,70);

    if (!empty($msg)) {
    // send email

        if (mail($recipient_email,$subject,$msg, $header,"-ffypscom@fyp-22-s2-27.com"))
        {
          return "success";
        } else {
          return "failed";
        }

    }

  }

  function getLastestImage($img_name)
  {

    // check which file is newer and display that one.
    $filenamepng = "img/" . $img_name . ".png";
    // echo $filenamepng;
    if (file_exists($filenamepng)) {
        $file_time_png = filemtime($filenamepng);
    }
    else {
      $file_time_png = 0;
    }
    $filenamejpg = "img/" . $img_name . ".jpg";
    // echo $filenamejpg;
    if (file_exists($filenamejpg)) {
        $file_time_jpg = filemtime($filenamejpg);
    }
    else {
      $file_time_jpg = 0;
    }

    if ($file_time_jpg > $file_time_png)
    {
      $ext = ".jpg";
      return $ext;
    }

    else if ($file_time_jpg < $file_time_png)
    {
      $ext =".png";
      return $ext;
    }

    else if ($file_time_jpg == $file_time_png)
    {
      $ext = "no_image";
      return $ext;
    }


  }

  function getImageName($files,$file_name)
  {
    $target_dir = "img/";
    $target_file = $target_dir . basename($files["fileToUpload"]["name"]);
    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $extension = end($temp);
    if ($extension == 'jpeg' || $extension == 'JPEG')
    {
      $extension = 'jpg';
    }
    $filename = $_SESSION['ID'] . $file_name . "." . $extension;
    return $filename;
  }

  function imageUpload($files,$file_name)
  {
    $target_dir = "img/";
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($files["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      // echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      $uploadOk = 0;
      return "not_image";
    }

  // Check if file already exists
  // if (file_exists($target_file)) {
  //   echo "Sorry, file already exists.";
  //   $uploadOk = 0;
  // }

  // Check file size
  if ($files["fileToUpload"]["size"] > 2000000) {
    $uploadOk = 0;
    return "file_too_big";
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" ) {
    $uploadOk = 0;
    return "wrong_file";
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($files["fileToUpload"]["tmp_name"], $target_dir.$file_name)) {
      // echo $files["fileToUpload"]["tmp_name"];
      // echo $filename;
      return "upload_success";
    } else {
      return "upload_failed";
    }
  }
  }
}
