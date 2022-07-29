<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once "logInCheck.php";
include_once ('navbar.php');
$name = $_SESSION["name"];
$usertype = $_SESSION["user_type"];
$UID = $_POST['ID'];
$usertype = $_POST['usertype'];
$editInfo_success = "";
$editInfo_suspended = "";
$suspended = "";

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;

}

if(isset($_POST['Edit']))
{
  $suspended = $_POST['suspended'];
}

if(isset($_POST['save']))
{
    if($usertype == 'homeowner')
    {
        $name= $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $postcode = $_POST['postal_code'];
        $hometype = $_POST['home_type'];
        $change = "UPDATE homeowners SET name='$name', email='$email', phone='$phone', address='$address', postal_code='$postcode', home_type='$hometype' WHERE homeowner_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $editInfo_success = "Your details have been updated!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }
    elseif($usertype == 'company')
    {
        $name= $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $postcode = $_POST['postal_code'];
        $change = "UPDATE company SET name='$name', email='$email', phone='$phone', address='$address', postal_code='$postcode' WHERE company_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $editInfo_success = "Your details have been updated!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }

}
else if(isset($_POST['suspend']))
{
    if($usertype == 'homeowner')
    {
        $change = "UPDATE homeowners SET suspended = 1 WHERE homeowner_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $suspended = 1;
            $editInfo_suspended = "User has been suspended!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }
    elseif($usertype == 'company')
    {
        $change = "UPDATE company SET suspended = 1 WHERE company_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $suspended = 1;
            $editInfo_suspended = "User has been suspended!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }
}
else if(isset($_POST['unsuspend']))
{
    if($usertype == 'homeowner')
    {
        $change = "UPDATE homeowners SET suspended = 0 WHERE homeowner_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $suspended = 0;
            $editInfo_success = "User has been unsuspended!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }
    elseif($usertype == 'company')
    {
        $change = "UPDATE company SET suspended = 0 WHERE company_ID='$UID'";
        if ($conn->query($change) === TRUE)
        {
            $suspended = 0;
            $editInfo_success = "User has been unsuspended!";
        }
        else
        {
            echo "Error" . $conn->error;
        }
    }
}

?>
<html>
    <head>
      <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
        <title>Edit Profile</title>
    </head>
    <body>
    <div class="container" >
    <h1 class ="display-5 text-center" style="margin-top:50px;">Edit/Suspend Profile</h1>
    <div class="row justify-content-center">
      <div class="col-6 text-center">
    <p class ="display-6 fs-5" name = "product" value ="avail">Change the details here.</p>
    </div>
    </div>
    </div>
        <?php
        if($usertype == 'homeowner')
        {
            $sql = "SELECT * FROM homeowners WHERE homeowner_ID = '$UID'";
            try
            {
                $getdata = mysqli_query($conn, $sql);
                if(mysqli_num_rows($getdata) == 1)
                {
                    $row = mysqli_fetch_assoc($getdata);
                    $name = $row['name'];
                    $address = $row['address'];
                    echo "<div class=\"container justify-content-center\"  style=\"text-align: center;\">
                    <div class=\"container\">
                        <form class =\"form-horizontal-2\" action='' method=\"post\">
                            <div class=\"col\">
                              <div class=\"form-floating  mb-3 \">
                              <input type=\"text\" class=\"form-control\" id=\"ID\" name=\"ID\" value = ". $row['homeowner_ID'] ." readonly>
                              <label for=\"ID\">User ID</label>
                              </div>
                            </div>

                            <div class=\"col\">
                              <div class=\"form-floating  mb-3 \">
                                <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"name\" value= '$name'>
                                <label for=\"name\">Name</label>
                              </div>
                            </div>

                            <div class=\"col\">
                            <div class=\"form-floating mb-3\">
                              <input type=\"number\" class=\"form-control\" id=\"phone\" name=\"phone\" placeholder=\"phone\" value=". $row['phone'] .">
                              <label for=\"phone\">Phone</label>
                            </div>
                          </div>
                          <div class=\"col\">
                            <div class=\"form-floating  mb-3 \">
                              <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"email\" value=". $row['email']. ">
                              <label for=\"email\">Email</label>
                            </div>
                          </div>

                          <div class=\"col\">
                            <div class=\"form-floating  mb-3 \">
                              <input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" placeholder=\"address\" value= '$address'>
                              <label for=\"address\">Address</label>
                            </div>
                          </div>
                          <div class=\"col\">
                            <div class=\"form-floating mb-3\">
                              <input type=\"number\" class=\"form-control\" id=\"postal_code\" name=\"postal_code\"placeholder=\"postal_code\" value=". $row['postal_code']." >
                              <label for=\"postal_code\">Postal Code</label>
                            </div>
                          </div>
                        <input type=\"hidden\" name=\"usertype\"value='$usertype'>
                    <div class=\"col form-floating  mb-3 \">
                          <div class=\"condi-dropdown\">
                            <select id=\"home_type\" name=\"home_type\" class=\"form-select\">
                              <option value=\"2room\" ".(($row['home_type']=='2room')?'selected="selected"':"").">HDB 2-room</option>
                              <option value=\"3room\" ".(($row['home_type']=='3room')?'selected="selected"':"").">HDB 3-room</option>
                              <option value=\"4room\" ".(($row['home_type']=='4room')?'selected="selected"':"").">HDB 4-room</option>
                              <option value=\"5room\" ".(($row['home_type']=='5room')?'selected="selected"':"").">HDB 5-room</option>
                              <option value=\"exec\" ".(($row['home_type']=='exec')?'selected="selected"':"").">HDB Executive</option>
                              <option value=\"condo\" ".(($row['home_type']=='condo')?'selected="selected"':"").">Condominium</option>
                              <option value=\"private\" ".(($row['home_type']=='private')?'selected="selected"':"").">Private</option>
                            </select>
                          </div>
                        </div>
                        <div class=\"alert alert-success booking-alert mt-3\" role=\"alert\">$editInfo_success</div>
                        <div class=\"alert alert-danger booking-alert mt-3\" role=\"alert\">$editInfo_suspended</div>
                        <div class=\"form-group mb-2 mt-3  text-center\">
                            <button type=\"submit\" class=\"btn btn-lg btn-primary me-5\" id=\"save\" name =\"save\" value=\"Save Changes\">Save Changes</button>";
                            if ($suspended == 0)
                            {
                            echo "  <button type=\"submit\" class=\"btn btn-lg btn-danger\" id=\"suspend\" name =\"suspend\" value=\"Suspend\">Suspend user</button>";
                          } else if ($suspended == 1)
                            {
                            echo "  <button type=\"submit\" class=\"btn btn-lg btn-success\" id=\"unsuspend\" name =\"unsuspend\" value=\"unSuspend\">Unsuspend user</button>";
                            }
                        echo"  </div>
                        </form>
                      </div>";
                }
            }
            catch (mysqli_sql_exception $e)
            {
                echo "error" . mysqli_error($conn);
                mysqli_close($conn);
            }
        }
        elseif ($usertype == 'company')
        {
            $sql = "SELECT * FROM company WHERE company_ID = '$UID'";
            try
            {
                $getdata = mysqli_query($conn, $sql);
                if(mysqli_num_rows($getdata) == 1)
                {
                    $row = mysqli_fetch_assoc($getdata);
                    $name = $row['name'];
                    $address = $row['address'];
                    echo "<div class=\"container justify-content-center\"  style=\"text-align: center;\">
                    <div class=\"container\">
                        <form class =\"form-horizontal-2\" action='' method=\"post\">
                            <div class=\"col\">
                              <div class=\"form-floating  mb-3 \">
                              <input type=\"text\" class=\"form-control\" id=\"ID\" name=\"ID\" value = ". $row['company_ID'] ." readonly>
                              <label for=\"ID\">User ID</label>
                              </div>
                            </div>

                            <div class=\"col\">
                              <div class=\"form-floating  mb-3 \">
                                <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" placeholder=\"name\" value= '$name'>
                                <label for=\"name\">Name</label>
                              </div>
                            </div>

                            <div class=\"col\">
                            <div class=\"form-floating mb-3\">
                              <input type=\"number\" class=\"form-control\" id=\"phone\" name=\"phone\" placeholder=\"phone\" value=". $row['phone'] .">
                              <label for=\"phone\">Phone</label>
                            </div>
                          </div>
                          <div class=\"col\">
                            <div class=\"form-floating  mb-3 \">
                              <input type=\"email\" class=\"form-control\" id=\"email\" name=\"email\" placeholder=\"email\" value=". $row['email']. ">
                              <label for=\"email\">Email</label>
                            </div>
                          </div>
                          <div class=\"col\">
                            <div class=\"form-floating  mb-3 \">
                              <input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" placeholder=\"address\" value='$address'>
                              <label for=\"address\">Address</label>
                            </div>
                          </div>
                          <div class=\"col\">
                            <div class=\"form-floating mb-3\">
                              <input type=\"number\" class=\"form-control\" id=\"postal_code\" name=\"postal_code\"placeholder=\"postal_code\" value=". $row['postal_code']." >
                              <label for=\"postal_code\">Postal Code</label>
                            </div>
                          </div>
                        <input type=\"hidden\" name=\"usertype\"value='$usertype'>
                        <div class=\"alert alert-success booking-alert mt-3\" role=\"alert\">$editInfo_success</div>
                        <div class=\"alert alert-danger booking-alert mt-3\" role=\"alert\">$editInfo_suspended</div>
                        <div class=\"form-group mb-2 mt-3 text-center\">
                            <button type=\"submit\" class=\"btn btn-lg btn-primary me-5\" id=\"save\" name =\"save\" value=\"Save Changes\">Save Changes</button>";

                          if ($suspended == 0)
                          {
                          echo "  <button type=\"submit\" class=\"btn btn-lg btn-danger\" id=\"suspend\" name =\"suspend\" value=\"Suspend\">Suspend user</button>";
                        } else if ($suspended == 1)
                          {
                          echo "  <button type=\"submit\" class=\"btn btn-lg btn-success\" id=\"unsuspend\" name =\"unsuspend\" value=\"unSuspend\">Unsuspend user</button>";
                          }
                      echo"  </div>
                      </form>
                    </div>";

                }
            }
            catch (mysqli_sql_exception $e)
            {
                echo "error" . mysqli_error($conn);
                mysqli_close($conn);
            }
        }
                            /*Kept as reference if implementing
                             * <div class=\"col\">
                              <div class=\"form-floating mb-3\">
                                <input type=\"password\" class=\"form-control\" id=\"n_password\" name=\"n_password\" placeholder=\"n_password\">
                                <label for=\"n_password\">New password</label>
                              </div>
                            </div>*/
        ?>
    </body>
</html>
