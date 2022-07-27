<?php
    session_start();
    // Check if the user is logged in, if not then redirect him to login page

    include_once "logInCheck.php";
    include_once "conn.php";
    include_once('navbar.php');
    include_once('jsLinks.php');
    include_once('cssLinks.php');
    
?>

<title>Verifiation Result</title>
<?php

    $companyId = $_POST['companyid'];

    $query = "select name from company where company_id = $companyId";
    $name = mysqli_query($conn, $query);
    $companyName = $name->fetch_array()[0] ?? '';

    // $query = "select email from company where company_id = $companyId";
    // $email = mysqli_query($conn, $query);
    // $companyEmail = $email->fetch_array()[0] ?? '';


    //$approvalMsg = "Hello $companyName, your verification request has been approved";
    //$rejectionMsg = "Hello $companyName, unfortunately, your verification request has been declined";

    //var_dump($_SESSION);
    if (isset($_POST['approve'])) {
        $query = "update company set verified = 1 where company_id = $companyId";
        $approve = mysqli_query($conn, $query);
        //mail($companyEmail,"Verification result",$approvalMsg);
        echo "Company $companyName verification request has been approved. An e-mail will be send to the company";

    } else if (isset($_POST['reject'])) {
        $query = "update company set verified = 2 where company_id = $companyId";
        $approve = mysqli_query($conn, $query);
        //mail($companyEmail,"Verification Result",$rejectionMsg);
        echo "Company $companyName verification request has been rejected. An e-mail will be send to the company";
    }
    

    echo "<br><a href=verifyCompanies.php>Go back to view list of companies page.</a>"
?>