<html>
    <?php session_start()?>

    <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <title>Enquiry</title>
    </head>

    <body>

        <?php include_once('navbar.php');?>
        <div class ="container">
        </div>

        <div class=pagetitle>
            <h2>Send an Enquiry</h2>
            <h6>Please Enter Details</h6>
        </div>

        <br>

        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "fyp";
            //$searchedName = $_SESSION['inputid'] ?? "";

            // Create connection
            try {
            $conn = mysqli_connect($servername, $username, $password, $dbname); 
            } catch ( mysqli_sql_exception $e) {
                die("Connection failed: " . mysqli_connect_error());
            }

            try {
                $conn = mysqli_connect($servername, $username, $password, $dbname); 
            } catch ( mysqli_sql_exception $e) {
                    die("Connection failed: " . mysqli_connect_error());
            }

            $getcompanyname = mysqli_query($conn, "select name from company");
            //$companyname = $getcompanyname->fetch_array()[0] ?? '';
            
        ?>

        <div class="selectcompany">
            <select id="company" name="company" form="enquirydetails" required>
                <option value="" default>Select a Company</option>
                <?php while (($Row = mysqli_fetch_assoc($getcompanyname)) != FALSE) { ?>
                    <option value="<?php echo $Row['name'];?>"> <?php echo $Row['name'];}?> </option>
            </select>
        </div> 
        <br>

        <form action="enquiry.php" method="post" id="enquirydetails">
            <input type="text" name ="enquirysubject" placeholder="Subject" class="enquirysubject" required> <br> <br>
            <textarea name ="details" placeholder="Enquiry Details" class="enquirydetails" required></textarea> <br> <br>

            <input type="submit" name="submit" value="Send Enquiry" class="enquirysubject">
        </form>

        <?php
            $companyName = $_POST['company'] ?? "";
            $subject = $_POST['enquirysubject'] ?? "";
            $details = $_POST['details'] ?? "";
            $homeownerName = $_SESSION['name'] ?? "";
            $tableName = "Cases";

            $getHID = mysqli_query($conn, "select homeowner_ID from homeowners where name = ". "'$homeownerName'");
            $HID = $getHID->fetch_array()[0] ?? '';

            $getCID = mysqli_query($conn, "select company_ID from company where name = ". "'$companyName'");
            $CID = $getCID->fetch_array()[0] ?? '';

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


            //if (isset($_POST['submit'])) { 

            if ($companyName == "") {
                echo "";
            } else {
                try {
                    $sql = "INSERT INTO $tableName (case_subject, company_ID, homeowner_ID, case_date, case_status, case_description) VALUES " . "('$subject', '$CID', '$HID', curdate(), 'Awaiting', '$details')";
                    @mysqli_query($conn, $sql);
                    echo "<br> <p class='successmessage'> Enquiry to $companyName has been sent from homeowner id $HID named $homeownerName. </p>";

                }  catch (mysqli_sql_exception $e) {
                    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
                } 
            //}
            }

        ?>

        <style>
            .pagetitle {
                text-align: center;
                margin-top: 8%;
            }

            .selectcompany {
                text-align: center;
                margin-top: 0%;
            }

            #enquirydetails {
                text-align: center;
            }

            .enquirysubject {
                width: 200px;
                height: 30px;
                border-radius: 10px;
            }

            ::placeholder {
                font-size:18px;
            }

            .enquirydetails {
                width: 400px;
                height: 150px;
            }

            .successmessage {
                text-align: center;
            }

        </style>
    
    </body>



</html>