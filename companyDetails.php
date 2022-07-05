<?php
 session_start();
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";

echo $_SESSION['company_name'];
 if($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($_POST['goTo'] == 'Hire')

   {
     header("location:installation.php");
   }
   else if ($_POST['goTo'] == 'Send Enquiry')
   {
     header("location:sendEnquiry.php");
   }
 }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Company Details</title>
</head>
<body>
<style>

.innerReviewTable, td {
    border: 1px solid black;
    margin-bottom: 20px;
}

.review {
  height:700px;
    overflow: auto;
    border: 2px solid black;
    border-radius:10px;
    shape-outside: content-box;
    padding: 20px;
}

</style>
<div class ="container">
<div class="row">
  <div class="col bg-light p-2">
    <h2><?php echo $_SESSION['company_name'];?></h2>
    <h3>123 Test Avenue 12 #4-2192 123942</h3>
    <p class="float-start">4.5 </p>
    <p class="float-start material-symbols-outlined">star</p>
    <p class="float-start material-symbols-outlined">star</p>
    <p class="float-start material-symbols-outlined">star</p>
    <p class="float-start material-symbols-outlined">grade</p>
    <p class="float-start">(12 reviews) </p>
  </div>
</div>
</div>
<div class ="container">
    <div class="row">
      <div class="col-8 ">
        <div class="aboutUs mt-3">
            <h2>About Us</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>

        <br>

        <div class="serviceNPrice">
            <h2>Services and prices</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>

        <br>

        <div class="packages">
            <h2>Packages</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </p>
        </div>

        <br>

        <div class="contactUs">
            <h2>Contact Us</h2>
            <p class="float-start me-4">Email: Companyone@mail.com</p>
            <p>Phone: 98765432</p>
            <form action="#" method="post">
            <button type='submit' class='btn btn-small btn-primary text-white me-4' name="goTo" value='Hire'>Hire</button>
            <button type='submit' class='btn btn-small btn-info text-white' name="goTo" value='Send Enquiry'>Send Enquiry</button>
          </form>
        </div>
    </div>

<div class="col-4 ">
    <div class="review mt-3"> <!-- can use overflow-->
        <table class="outerReviewTable">
            <tr><th><h2>Reviews</h2></th><tr>
            <tr>
                <td> <!-- later change this to php mysql select code to retrieve the data from the database-->
                    <table class="innerReviewTable">
                        <tr>
                            <td>
                                <h4>homeowner1</h4>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="eachreview">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                    tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                    consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                                    non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p></td>
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

</div>
</div>
</div>


</body>
</html>
