<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    include_once ("conn.php");
    include_once ('navbar.php');
    $name = $_SESSION["name"];
    $usertype = $_SESSION["user_type"];
    
    if (isset($POST['compname']))
    {
        $name = $_POST['Companyname'];
        
        $sql = "UPDATE ";
    }
?>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
    <title>Company Details</title>
    </head>
    <body>
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


        h5 {
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
        <div class="container">
        </div>

            <?php
            if ($usertype == "company")
            {
                
            echo"<tr>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>";
            $getdetails = "SELECT * FROM company WHERE NAME = '$name'";
            try 
                {
                    $Cdetails = mysqli_query($conn, $getdetails);
                    if(mysqli_num_rows($Cdetails)> 0)
                    {
                        while(($row = mysqli_fetch_assoc($Cdetails)) !=FALSE)
                        {
                            echo "<div class=pageHeading>";
                            echo "<td> <h1>" . $row['name'] . "</h1>"

                                   . "<form action=\"userInfo.php\" method=\"post\">"
                                   . "<br><br>Company name : <br><input type=\"text\" name = \"Companyname\" value= " . $row['name'] . ">"
                                   . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                   . "<input type =\"submit\" name=\"compname\" value = \"Edit\">"
                                   . "</form>"
                                   . "</td>";
                            echo "<br>";
                            echo "<td><h3>" . $row['address'] . " " . $row['postal_code'] . "</h3></td>";
                            echo "<td><form action=\"userInfo.php\" method=\"post\">"
                                   . "<br><br>Address : <br><input type=\"text\" name = \"Address\" value=>"
                                   . "<input type =\"submit\" name=\"add\" value = \"Edit\">"
                                   . "<br><br>Postal code : <br><input type=\"text\" name = \"postal\" value= " . $row['postal_code'] . ">"
                                   . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                   . "<input type =\"submit\" name=\"post\" value = \"Edit\">"
                                   . "</form>"
                                   . 
                                 "<br><br><br></td>";
                            echo "</div>";
                            echo "<hr class='hrtop'>";

                           
                            echo "<div class=\"details\">";
                            
                                echo "<div class=\"aboutUs\">";
                                echo "<h3>About us</h3>";
                                echo "<h4> Sample Text</h4>";
                                echo "<br><form action=\"editDetailComp.php\" method=\"post\">"
                                       . "<br><br><textarea name = \"Abt\" rows = \"6\" cols = \"45\"> Make changes to about us here </textarea>"
                                       . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                       . "<input type =\"submit\" name=\"abt\" value = \"Edit\">"
                                       . "</form>";
                                
                                echo "<br>";
                                
                                echo "<h3> Services and Prices </h3>";
                                echo "<h4> Sample Text</h4>";                                
                                echo "<br><form action=\"change.php\" method=\"post\">"
                                       . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                       . "<input type =\"submit\" name=\"Edit\" value = \"Edit\">"
                                       . "</form>";
                                
                                echo "<br>";
                                
                                
                                echo "<h3> Packages </h3>";
                                echo "<h4> Sample Text</h4>";
                                echo "<br><form action=\"change.php\" method=\"post\">"
                                       . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                       . "<input type =\"submit\" name=\"Edit\" value = \"Edit\">"
                                       . "</form>";
                                
                                echo "<br>";
                               
                                echo "<h3>Contact Us</h3>";
                                echo "<h4>" . $row['email'] . " " . $row['phone'] . "</h4>";
                                echo "<br><br>Email : <br><input type=\"text\" name = \"Email\" value= " . $row['email'] . ">";
                                echo "<br><br>Phone : <br><input type=\"text\" name = \"phone\" value= " . $row['phone'] . ">";
                                echo "<br><form action=\"userInfo.php\" method=\"post\">"
                                       . "<input type = \"hidden\" name=\"name\" value = " . $row['name'] . ">"
                                       . "<input type =\"submit\" name=\"Edit\" value = \"Edit\">"
                                       . "</form>";
                                echo "</div>";
                                
                            echo "</div>";
                            
                            echo "<div class=\"review\">
                            <table class=\"outerReviewTable\">
                                <tr><th><h2>Reviews</h2><br></th><tr>
                                <tr>
                                    <td>
                                        <table class=\"innerReviewTable\">
                                            <tr>
                                                <td>
                                                    <h4>homeowner1</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
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
                                        <table class=\"innerReviewTable\">
                                            <tr>
                                                <td>
                                                    <h4>homeowner2</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
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
                                        <table class=\"innerReviewTable\">
                                            <tr>
                                                <td>
                                                    <h4>homeowner3</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
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
                                        <table class=\"innerReviewTable\">
                                            <tr>
                                                <td>
                                                    <h4>homeowner4</h4>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod 
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
                        </div>";
                        }
                    }
                        
                }
                catch (mysqli_sql_exception $e) 
                {
                    echo "error" . mysqli_error($conn);
                    mysqli_close($conn);
                }
            }
            elseif ($usertype = "homeowner")
            {
                
            }
            
            ?>   
    </body>
</html>
