<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
include_once('navbar.php');
include_once('jsLinks.php');
include_once('cssLinks.php');
echo "<title>Company Details</title>";


// $companyId = $_GET['id'];
$_SESSION['companyId'] = $_GET['id'];
$companyId = $_SESSION['companyId'];
//$_SESSION['companyId'] = $companyId; 
//echo $companyId;

try {
    $query = "select name, address, postal_code from company where company_ID = '$companyId'";
    $details = mysqli_query($conn, $query);
    while (($Row = mysqli_fetch_array($details)) != FALSE) {
        $name = $Row['name'];
        $address = $Row['address'];
        $postalCode = $Row['postal_code'];
        echo "<h1>$name</h1>" . $address . " " . $postalCode;
    }

} catch (Exception $e){
    echo "<br><br>No companies are found.<br><br>";
}

echo "<br>";

try {
    $query = "SELECT serv.service_name
    FROM Company AS comp
    JOIN Company_Services AS cs
    ON comp.company_ID = cs.company_ID
    JOIN Services As serv
    ON cs.service_ID = serv.service_ID
    where comp.company_ID = $companyId";

    $getService = mysqli_query($conn, $query);

    echo "<h1>Services</h1>";
    while (($Row = mysqli_fetch_array($getService)) != FALSE) {
        $serviceName = $Row['service_name'];
        echo "<br>" . $serviceName;
    }
} catch (Exception $e){
    echo "<br><br>No services are found.<br><br>";
}

try {
    $query = "select email, phone from company where company_ID = $companyId";
    $contactDetails = mysqli_query($conn, $query);
    echo "<h1>Contact Details</h1>";
    while (($Row = mysqli_fetch_array($contactDetails)) != FALSE) {
        $email = $Row['email'];
        $phone = $Row['phone'];
        echo $email . " " . $postalCode;
    }

} catch (Exception $e){
    echo "<br><br>No companies are found.<br><br>";
}

?>

<h3>Action</h3>
    <form action="companyVerificationResult.php" method="post">
        <input type="hidden" name="companyid" value="<?php echo $companyId;?>">
        <input type="submit" name="approve" value="Approve ✔️">
    </form>     
        
    <form action="companyVerificationResult.php" method="post">
        <input type="hidden" name="companyid" value="<?php echo $companyId;?>">
        <input type="submit" name="reject" value="Reject ❌">
    </form>     





