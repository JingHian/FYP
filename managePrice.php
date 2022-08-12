<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";

$company = new Company();

$CID = $_SESSION['ID'];
try
{
  //get prices of water supply
 $query = "SELECT price FROM Company_Services as cs
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
   $query = "SELECT price FROM Company_Services as cs
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
   }  catch (mysqli_sql_exception $e)
     {
       echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
     }



if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $water_price = $_POST['water_price'];
    $maintenance_price = $_POST['maintenance_price'];

    try
    {
        $wprice = "UPDATE Company_Services SET price = '$water_price' WHERE company_ID = '$CID' AND service_ID = '1'";
        $mprice = "UPDATE Company_Services SET price = '$maintenance_price' WHERE company_ID = '$CID' AND service_ID = '2'";
        @mysqli_query($conn, $wprice);
        @mysqli_query($conn, $mprice);

    }
    catch (Exception $ex)
    {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }

}
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Manage Pricing</title>
    </head>

    <body>
        <?php include_once('navbar.php');?>
        <div class="container" >
            <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Manage Pricing</h1>
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <p class ="display-6 fs-5" name = "product" value ="avail">Change Pricing</p>
                </div>
            </div>
        </div>
        <div class="container">
            <form id="ManagePrice" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <div class="row">
            <div class="col-md-6">
              <div class="form-floating mb-3">
               <input type="text" class="form-control" id="water_price" name="water_price" placeholder="water_price"  value = "<?php if($water_price != "none"){echo $water_price;}?>" <?php if($water_price == "none"){echo "disabled";}else{echo "required";}?>>
               <label for="water_price">Water Price</label>
             </div>
           </div>
           <div class="col">
             <div class="form-floating mb-3">
              <input type="text" class="form-control" id="maintenance_price" name="maintenance_price" placeholder="maintenance_price"  value = "<?php if($maintenance_price != "none"){echo $maintenance_price;}?>" <?php if($maintenance_price == "none"){echo "disabled";}else{echo "required";}?>>
              <label for="maintenance_price">Maintenance Fee</label>
            </div>
          </div>
        </div>
                <?php


                            //     $name = $row['service_name'];
                            //     echo "<div class=\"col\">
                            //     <div class=\"form-floating mb-3\">
                            //     <input type=\"text\" class=\"form-control\" id=\"$name\" name=\"$name\" placeholder=\"WaterPrice\" required value = " . $row['Price'] . ">
                            //     <label for=\"$name\">" . $name. "</label>
                            //     </div>
                            //     </div>
                            //     <input type=\"hidden\" id= " . $name . "1 name =  " . $name . "1 value = " . $row['service_ID'] . ">
                            //     ";

                ?>
                <div class="form-group mb-2 mt-3 text-center">
                    <input type="submit" class="btn btn-lg btn-primary" value="change">
                </div>
            </form>
        </div>
    </body>
    <?php include_once ("jsLinks.php"); ?>

</html>
