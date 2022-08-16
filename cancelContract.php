<?php
session_start();
    include_once ("conn.php");
    include_once ("classes.php");
    include_once ('navbar.php');
    include_once "logInCheck.php";
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];
    $ID = $_SESSION["ID"];
    $payment_success = "";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: index.php");
        exit;
    }

    $sql = "SELECT * from Clients INNER JOIN Company ON Clients.company_ID = Company.company_ID WHERE homeowner_ID = '$ID'";
    try
    {
        $select = mysqli_query($conn, $sql);
        if($select == TRUE)
        {
            if(($row = mysqli_fetch_assoc($select)) != FALSE)
            {
                $company_name = $row['name'];
                $start_date = $row['start_date'];
            }
        }
    } catch (Exception $ex) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
    }
    
    if(isset($_POST['cancel']))
    {
        $cancel = "INSERT INTO Past_clients(client_ID, company_ID, homeowner_ID) SELECT client_ID, company_ID, homeowner_ID FROM Clients WHERE homeowner_ID = $ID";
        $delete = "DELETE FROM Clients WHERE homeowner_ID = $ID";
        $date = "UPDATE Past_clients set cancellation_date= CURRENT_DATE() WHERE homeowner_ID = $ID";
        try
        {
            if(mysqli_query($conn, $cancel) == TRUE)
            {
                if(mysqli_query($conn, $delete) == TRUE)
                {
                    if(mysqli_query($conn, $date) == TRUE)
                    {
                        $payment_success = "Contract cancelled";
                    }
                }
            }
        } catch (Exception $ex) {
               echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
        }
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Cancel Contract</title>
    </head>
    <body>
        <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Confirm Cancellation of Contract with</h1>
      <div class="row justify-content-center">
        <div class="col-6 text-center">
            <br>
      <p class ="display-6 fs-5" name = "details" value ="details">Company: <?php echo $company_name;?></p>
      <p class ="display-6 fs-5" name = "details" value ="details">Contracted since: <?php echo $start_date;?></p>

    </div>
      </div>
    </div>
        <div class="container">
            <form id="MakePayment" class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <?php
         $rand=rand();
         $_SESSION['rand']=$rand;
        ?>
        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
        <div class="form-group mb-2 mt-3 text-center">
        <button type="submit" name="cancel" class="btn btn-lg btn-primary" value="Cancel">Cancel Contract</button>

          <div class="alert alert-primary text-center booking-alert mt-3" role="alert"><?php echo $payment_success;?></div>
          <a class='btn btn-lg btn-primary text-white ' href="servicesHomeowner.php" value='Back'>Back</a>
                </div>
            </form>
        </div>
    </body>
</html>
