<?php session_start(); ?>
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

        echo "<div class=pageHeading>";

        try {
            $query = "select name, address from company where name = 'company3'";
            $result = mysqli_query($conn, $query);

            while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

                echo "<tr><td><h1><b>" . $Row['name'] . "</b></h1></td>";
                echo "<br>";
                echo "<tr><td>" . $Row['address'] . "</td>";

            }
            echo "</table>";
            

        } catch (Exception $e){
            echo "<br><br>Company not found.<br><br>";
        }

        echo "</div>";
        echo "<hr class='hrtop'>";
    ?>

    <!-- later i'll change the text into php and mysql codes when
     the database abt company info (about us), packages, service n price are ready. -->

    <div class="details">

        <div class="aboutUs">
            <h2>About Us</h2>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. <br><br><br>
            </h4>
        </div>

        <br>

        <div class="serviceNPrice">
            <h2>Services and prices</h2>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br><br>
            </h4>
        </div>

        <br>

        <div class="packages">
            <h2>Packages</h2>
            <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, 
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo 
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.<br><br><br>
            </h4>
        </div>

        <br>

        <div class="contactUs">
            <h2>Contact Us</h2>
            <h4>
                <?php
                    try {
                        $query = "select email, phone from company where name = 'company3'";
                        $result = mysqli_query($conn, $query);

                        while (($Row = mysqli_fetch_assoc($result)) != FALSE) {

                            echo "Email: " . "<tr><td>" . $Row['email'] . "</td>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp";
                            echo "Phone: ". "<tr><td>" . $Row['phone'] . "</td>";
                        }

                        echo "</table>";

                    } catch (Exception $e){
                        echo "<br><br>Company not found.<br><br>";
                    }
                ?>
            </h4>
        </div>
    </div>

    <div class="review"> <!-- can use overflow-->
        <table class="outerReviewTable">
            <tr><th><h2>Reviews</h2><br></th><tr>
            <tr>
                <td> <!-- later change this to php mysql select code to retrieve the data from the database-->
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner1</h4>
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


    <div class="buttons">
        <form action="installation.php" method="post">
            <input type="submit" value="Hire" class="hire">
        </form>

        <form action="enquiry.php" method="post">
            <input type="submit" value="Send Enquiry" class="enquiry">
        </form>
    </div>
    

    <style>
        .aboutUs, .serviceNPrice, .packages, .contactUs {
            float: left;
            margin-left:15px;
            margin-right: 750px;
        }
        
        .hrtop {
            border-top: 5px solid black;
        }

        .pageHeading{
            background-color: #f0f0f0;
            margin-left: 20px;
        }

        .review {
            width: 700px;
            height: 800px;
            overflow: auto;
            border: 5px solid black;
            border-radius:20px;
            position: absolute;
            right: 10px;
            shape-outside: content-box;
            float: right;
            padding: 30px;
        }

        .details {
            margin-left: 40px;
        }


        .innerReviewTable, td {
            border: 1px solid black;
            margin-bottom: 20px;
        }


        .eachreview {
            padding: 20px;
        }

        .buttons {
            padding: 30px 60px;
            margin-left: 0px;
            margin-bottom: 10px;
            border-radius: 20px;
            position: absolute;
            bottom: -200px;
            left: 50%;
        }

        .hire {
            padding: 30px 100px;
            position: absolute;
            bottom: 500%;
            left: -1000%;
        }

        .enquiry {
            padding: 30px 100px;
            position: absolute;
            bottom: 500%;
            right: 600%;
        }

        @media screen and (max-width: 1600px) {

            .hire {
                padding: 30px 100px;
                position: absolute;
                bottom: -30%;
                left: 120%;
            }

            .enquiry {
                padding: 30px 100px;
                position: absolute;
                bottom: -300%;
                left: 100%;
            }
        }


    </style>

</body>
</html>