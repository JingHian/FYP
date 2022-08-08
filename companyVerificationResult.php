<?php
    session_start();
    // Check if the user is logged in, if not then redirect him to login page

    include_once "logInCheck.php";
    include_once "conn.php";
    include_once('navbar.php');
    include_once('jsLinks.php');
    include_once('cssLinks.php');


     $company_ID = $_SESSION["company_ID"];
     $name = $_SESSION["name"];

?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Verification Result</title>
    </head>
    <body>

      <?php include_once('navbar.php');?>
      <div class="container" >
      <h1 class ="display-5 fw-bold text-center" style="margin-top:50px;">Company <?php echo $name; ?></h1>
      <div class="row justify-content-center">
        <div class="col-md-6 text-center">
      <?php
        if (isset($_POST['approve'])) {
            $query = "update Company set verified = 1 where company_id = $company_ID";
            $approve = mysqli_query($conn, $query);
            //mail($companyEmail,"Verification result",$approvalMsg);
            echo '<p class="alert alert-success booking-alert mt-3" role="alert">Company '.$name.'\'s verification request has been approved.</p>';

        } else if (isset($_POST['reject'])) {
            $query = "update Company set verified = 2 where company_id = $company_ID";
            $approve = mysqli_query($conn, $query);
            //mail($companyEmail,"Verification Result",$rejectionMsg);
            echo '<p class="alert alert-danger booking-alert mt-3" role="alert">Company '.$name.'\'s verification request has been rejected.</p>';
        }


      ?>
    </div>
      </div>
          <div class="form-group mb-2 mt-3 text-center">
              <a class="btn btn-lg btn-primary" href="verifyCompanies.php">Return to verification list</a>
          </div>
    </div>


    </body>



</html>

<?php

    // $query = "select email from company where company_id = $company_ID";
    // $email = mysqli_query($conn, $query);
    // $companyEmail = $email->fetch_array()[0] ?? '';


    //$approvalMsg = "Hello $name, your verification request has been approved";
    //$rejectionMsg = "Hello $name, unfortunately, your verification request has been declined";

    //var_dump($_SESSION);
?>
