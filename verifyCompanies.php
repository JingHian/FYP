<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
include_once('navbar.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
</head>
<body>
  <?php include_once('jsLinks.php');?>
  <?php
    try {
        $query = "select company_ID, name, email, phone, postal_code from company where verified = 0";
    
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) < 1) {
            echo "<br><br>No Companies is currently waiting for approval.<br><br>";
        } else {

            echo "<table border = '1px solid black' style='width:70%'>";
            echo "<th>Company ID</th>" . "<th>Company Name</th>" . "<th>Email</th>" . "<th>Phone</th>" . "<th>Postal Code</th>" . "<th>Status</th>" . "<th>Action</th>";
            while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

                echo "<tr><td>" . $Row['company_ID']?? "" . "</td>";
                echo "<td>" . $Row['name'] . "</td>";
                echo "<td>" . $Row['email'] . "</td>";
                echo "<td>" . $Row['phone'] . "</td>";
                echo "<td>" . $Row['postal_code'] ."</td>";
                echo "<td>" . "Awaiting" ."</td>";
                //echo "<td>" . "<a href = 'companyWaitingToBeVerified.php?id'>View</a>" . "</td>";
                //echo "<td>" . $Row['extendedcostper. "</td></tr>";
                ?> 
                        
                <td>
                    <a href="companyWaitingToBeVerified.php?id=<?php echo $Row['company_ID'];?>">View</a>
                </td>
                </tr>

                <?php
            }
            echo "</table>";
        }
    } catch (Exception $e){
        echo "<br><br>Companies is found<br><br>";
    }
  ?>

</body>
</html>