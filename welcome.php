<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page

include_once "logInCheck.php";
include_once "conn.php";
include_once ("classes.php");
// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
$tables = new Company();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome</title>
    <?php include_once('cssLinks.php');?>

</head>
<body>
    <?php include_once('navbar.php');?>
    <div class ="container">
      <h1 class="my-5 welcome-font text-center">Hi, <?php echo htmlspecialchars($_SESSION["name"])." "; ?>. Welcome to Water Supply Marketplace.</h1>
    </div>
  <?php if ($_SESSION['user_type'] == 'company')
  {
    echo'

  	<div class="container">
			<div class="row">
        <div class="col-md-55 bg-white pt-2 p-5 rounded boxshadow">
				<h2 class="font-SlateBlue" style="margin-top:30px;margin-bottom:30px;"><b>Registered Clients</b></h2>
				<div class=" row ">
					<div class=" height-350">';
          $tables->listClientsQuick();
				echo'	</div>
				</div>
      </div>
      <div class="col-md-10"></div>
    <div class="col-md-55 bg-white pt-2 p-5 rounded boxshadow">
      <h2 class="font-SlateBlue" style="margin-top:30px;margin-bottom:30px;"><b>Quick Links</b></h2>
				<div class="row ">
					<a class=" menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border border-dark border-start-0 border-top-0 border-2 pt-3  height-200" href="viewBillsComp.php">
    				<div class=" text-center">
              <span class="material-symbols-rounded icon-size">request_quote</span>
							<p class="usage-font"> Homeowner Bills </p>
						</div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border border-dark border-top-0 border-end-0 border-2 pt-3  height-200" href="addEditDiscount.php">
            <div class =" text-center">
              <span class="material-symbols-rounded icon-size">inventory_2</span>
              <p class="usage-font ">Set Discount</p>
            </div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border  border-start-0 border-bottom-0 border-dark border-2 pt-3  height-200" href="managePrice.php">
            <div class =" text-center">
              <span class="material-symbols-rounded icon-size">price_change</span>
              <p class="usage-font">Set Pricing</p>
            </div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border   border-bottom-0 border-end-0 border-dark border-2 pt-3  height-200" href="enquiryToPlatform.php">
						<div class=" text-center">
              <span class="material-symbols-rounded icon-size">contact_support</span>
							<p class="usage-font">Send Enquiry to Platform </p>
						</div>
					</a>
					<div class="col-md-15"></div>';
  }
  ?>
    </div>
  </div>
  <?php include_once('jsLinks.php');?>
</body>
</html>
