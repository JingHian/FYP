<?php session_start();?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Company Details</title>
    </head>
    <body>

        <?php include_once('navbar.php');?>
        <div class ="container">
        </div>

        <div class="topofpage">
            <h2>My Enquiries</h2> <br>
            <!--<button name="newenquiry" href="enquiry.php">New +</button> <br><br> -->
            <form method="post" action="enquiry.php">
                <button type="submit">New +</button>
            </form>

            <br> <br>

        </div>

        <?php
          include("conn.php");

             //automatically create the table if not extist yet when the homeowner clicks the eqnuries menu
             $casesTable = "CREATE TABLE IF NOT EXISTS Cases (
                case_ID INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
                case_subject VARCHAR(30) NOT NULL,
                company_ID int(11) NOT NULL,
                homeowner_ID int(11) NOT NULL,
                case_date VARCHAR(15) NOT NULL,
                case_status VARCHAR(10) NOT NULL,
                case_description VARCHAR(500) NOT NULL)";

            mysqli_query($conn, $casesTable);

            $homeownerName = $_SESSION["name"];
            $homeowner_ID = $_SESSION['ID'];

            try {
                $query = "SELECT cas.case_ID, cas.case_subject, cas.company_ID, cas.homeowner_ID, cas.case_date, cas.case_status,comp.name
                          FROM Cases AS cas
                          JOIN Company AS comp
                          ON cas.company_ID = comp.company_ID
                          WHERE homeowner_id = '$homeowner_ID'";
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) < 1) {
                    echo "<br><br>No enquiries are found.<br><br>";
                } else {

                    echo "<table class='enquirytable' border = '1px solid black'>";
                    echo  "<th>Subject</th>" . "<th>To</th>" . "<th>From</th>" . "<th>Date</th>" . "<th>Status</th>" . "<th>Action</th>";
                    while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

                        echo "<tr>";
                        echo "<td>" . $Row['case_subject'] . "</td>";
                        echo "<td>" . $Row['name'] . "</td>";
                        echo "<td>" . $homeownerName . "</td>";
                        echo "<td>" . $Row['case_date'] ."</td>";
                        echo "<td>" . $Row['case_status'] ."</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            } catch (Exception $e){
                echo "<br><br>No products are found.<br><br>";
                echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
            }

        ?>

        <style>
            .topofpage {
                text-align:center;
                margin-top:100px;
            }

            .enquirytable {
                text-align:center;
                margin-left: auto;
                margin-right:auto;
                width: 60%;
                height: 20;
                line-height: 40px;
                border-left: none;
                border-right: none;
                border-top: 5px solid #000;
                border-bottom: 5px solid #000;
            }
        </style>

    </body>
