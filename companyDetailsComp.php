<?php
 session_start();
 include_once('conn.php');
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";
 // echo '<pre>' . print_r($_SESSION) . '</pre>';
 $CID = $_SESSION['ID'];

 try
 {
   //get prices of water supply
  $query = "SELECT price FROM Company_services as cs
            JOIN Services as serv
            ON cs.service_ID = serv.service_ID
            WHERE company_ID =$CID AND service_name ='Water Supply'";
  $result =  mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $water_price = $row["price"];
        }
    }
    else{
      $water_price = "none";
    }
   //get prices Maintenance
    $query = "SELECT price FROM Company_services as cs
              JOIN Services as serv
              ON cs.service_ID = serv.service_ID
              WHERE company_ID =$CID AND service_name ='Maintenance'";
    $result =  mysqli_query($conn, $query);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $maintenance_price = $row["price"];
          }
      }
      else{
        $maintenance_price = "none";
      }

    //get discounts
    $query = "SELECT * FROM Discounts
              WHERE company_ID =$CID";
    $result =  mysqli_query($conn, $query);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $discount_name = $row["discount_name"];
            $discount_start_date= $row["discount_start_date"];
            $discount_end_date= $row["discount_end_date"];
            $discount_description= $row["discount_description"];
            $discount_modifier= $row["discount_modifier"];
          }
      }
      else{
        $discount_name = "none";
        $discount_start_date= "none";
        $discount_end_date= "none";
        $discount_description= "none";
        $discount_modifier= "none";
      }
      //get services
      $query = "SELECT GROUP_CONCAT(serv.service_name SEPARATOR ', ') as service_grouped
                FROM Company AS comp
                JOIN Company_Services AS cs
                ON comp.company_ID = cs.company_ID
                JOIN Services As serv
                ON cs.service_ID = serv.service_ID
                WHERE comp.company_ID = $CID";
      $result =  mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $service_grouped = $row["service_grouped"];
            }
        }
  }
  catch (mysqli_sql_exception $e)
  {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }


 if($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($_POST['goTo'] == 'Hire')

   {
     header("location:installation.php");
   }
   else if ($_POST['goTo'] == 'Send Enquiry')
   {
     header("location:sendEnquiry.php");
   }
 }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Company Details</title>
</head>
<body>
<style>

.innerReviewTable, td {
    border: 1px solid black;
    margin-bottom: 20px;
}

.review {
  height:700px;
    overflow: auto;
    border-radius:10px;
    shape-outside: content-box;
    padding: 20px;
    background-color: white;
}

</style>
<div class ="container  bg-dark ps-3 p-4">
<div class="row">
  <div class="col  text-white ">
    <h1 class ="fw-bold mb-0"><?php echo $_SESSION['name'];?></h1>
    <h5 class =" mb-0"><?php echo $_SESSION['address'] ." ". $_SESSION['postal_code'];?> </h5 >
    <h5 class="float-start">4.5 </h5>
    <h5 class="float-start material-symbols-outlined">star</h5>
    <h5 class="float-start material-symbols-outlined">star</h5>
    <h5 class="float-start material-symbols-outlined">star</h5>
    <h5 class="float-start material-symbols-outlined">grade</h5>
    <h5 class="float-start">(12 reviews) </h5>
  </div>
</div>
</div>
<div class ="container">
    <div class="row">
      <div class="col-8 ">
        <div class="aboutUs mt-3">
            <h2 class ="fw-bold">About Us</h2>
            <p><?php echo $_SESSION['home_type'];?>
            </p>
        </div>

        <br>

        <div class="serviceNPrice">
            <h2 class ="fw-bold mb-3">Services and prices</h2>
            <h3 style="font-size:20px;font-weight:bold;">Services Offered</h3>
            <p><?php echo $service_grouped;?></p>
            <h3 style="font-size:20px;font-weight:bold;">Prices</h3>
            <pre><?php if($water_price != "none"){echo "Water Supply price: $". $water_price . "/m³     ";} if($maintenance_price != "none"){echo "Maintenance Fee: $". $maintenance_price . " per job     ";}?></pre>
        </div>

        <br>

        <div class="packages">
          <h2 class ="fw-bold mb-3">Discounts</h2>
          <h3 style="font-size:20px;font-weight:bold;"><?php if($discount_name != "none") {echo $discount_name;}?></h3>
          <p class="mb-2"><?php echo $discount_description;?></p>
          <pre><?php if($discount_start_date != "none"){echo "Start Date: ". $discount_start_date . "     ";} if($discount_end_date != "none"){echo "End Date: ". $discount_end_date ;}?></pre>
        </div>

        <br>

        <div class="contactUs">

          <h2 class ="fw-bold mb-3">Contact Us</h2>
          <pre>Email: <?php echo $_SESSION['email'];?>     Phone Number: <?php echo $_SESSION['phone'] ;?></pre>
            <a class='btn btn-small btn-primary text-white me-4' href="userInfo.php" value='Back'>Back</a>

        </div>
    </div>

<div class="col-4 ">
    <div class="review boxshadow mt-3"> <!-- can use overflow-->
        <table class="outerReviewTable">
            <tr><th><h2>Reviews</h2></th><tr>
            <tr>
                <td> <!-- later change this to php mysql select code to retrieve the data from the database-->
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner1</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="eachreview">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner2</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><h5 class="eachreview">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </h5></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner3</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><h5 class="eachreview">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </h5></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner4</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><h5 class="eachreview">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </h5></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

</div>
</div>
</div>


</body>
</html>
