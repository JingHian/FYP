<?php
session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $CID = $_SESSION['ID'];
    $user_type = $_SESSION["user_type"];
    $_SESSION["rand"] = 123;
   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
       $client_ID = $_POST['client_ID'];
       $name = $_POST['name'];
       $getdetails = mysqli_query($conn,"SELECT * FROM Clients INNER JOIN Homeowners ON Clients.homeowner_ID = Homeowners.homeowner_ID WHERE client_ID = $client_ID AND company_ID = $CID");
       try 
       {
           if(($row = mysqli_fetch_assoc($getdetails)) == TRUE)
           {
               $name = $row['name'];
               $phone = $row['phone'];
               $email = $row['email'];
               $address = $row['address'];
               $postcode = $row['postal_code'];
               $hometype = $row['home_type'];
           }
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
        <title>Client Details</title>
    </head>
    <body>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Client Details</h1>
    </div>
    <div class="container justify-content-center"  style="text-align: center;">
    <div class="container">
        <form class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  enctype="multipart/form-data">
        <?php
         $rand=rand();
         $_SESSION['rand']=$rand;
        ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />

            <div class="col">
              <div class="form-floating  mb-3 ">
                  <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>"disabled>
                <label for="name">Name</label>
              </div>
            </div>

            <div class="col">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="phone" name="phone"placeholder="phone" value="<?php echo $phone; ?>"disabled>
              <label for="phone">Phone</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating  mb-3 ">
              <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>"disabled>
              <label for="email">Email</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating  mb-3 ">
              <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>"disabled>
              <label for="address">Address</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating mb-3">
              <input type="number" class="form-control" id="postal_code" name="postal_code"placeholder="postal_code" value="<?php echo $postcode; ?>" disabled>
              <label for="postal_code">Postal Code</label>
            </div>
          </div>
        
        <div class="col">
            <div class="form-floating  mb-3 ">
              <input type="text" class="form-control" id="hometype" name="hometype" placeholder="hometype" value="<?php echo $hometype; ?>"disabled>
              <label for="hometype">Housing Type</label>
            </div>
          </div>
    </div>
      </form>
        <div class="form-group mb-2 mt-3 text-center">
            <button onclick="location.href='viewClients.php'" class="btn btn-lg btn-primary" value="back">Return to list</button>
        </div>
</div>
    <?php include_once('jsLinks.php');?>
    </body>
</html>
