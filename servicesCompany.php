<?php
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page



include_once "logInCheck.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include_once('cssLinks.php');?>
    <title>Welcome</title>
</head>
<body>
  <?php include_once('navbar.php');?>
  <h1 class ="display-5 fw-bold text-center " style="margin-top:20px;margin-bottom:20px;">Services Menu</h1>
  <div class="container">
    <div class="row ">
    <div class="col-md-15"></div>
      <a class=" menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-dark border-start-0 border-top-0 border-3 pt-3  height-200" href="viewServiceHomeownerAndCompany.php">
        <div class =" text-center">
          <span class="material-symbols-rounded  icon-size">design_services</span>
          <p class="usage-font">Service Categories</p>
        </div>
      </a>

        <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-dark border-start-0 border-top-0 border-end-0 border-3 pt-3  height-200" href="viewEquipment.php">

          <div class =" text-center">
            <span class="material-symbols-rounded icon-size">home_repair_service</span>
            <p class="usage-font ">Equipment</p>
          </div>
        </a>

        <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-dark border-top-0 border-end-0 border-3 pt-3  height-200" href="viewStaff.php">

          <div class =" text-center">
            <span class="material-symbols-rounded icon-size">engineering</span>
            <p class="usage-font ">Staff </p>
          </div>
        </a>

        <div class="col-md-15"></div>
        <div class="col-md-15"></div>
          <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-top-0 border-start-0 border-bottom-0 border-dark border-3 pt-3  height-200" href="viewCases.php">

            <div class =" text-center">
              <span class="material-symbols-rounded icon-size">contact_support</span>
              <p class="usage-font">Homeowner Enquiries</p>
            </div>
          </a>

            <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center  justify-content-center col-md-3 border border-dark border-0 pt-3  height-200 " href="viewBookingsComp.php">
              <div class =" text-center">
                <span class="material-symbols-rounded  icon-size">event_available</span>
                <p class="usage-font ">Homeowner Bookings</p>
              </div>
            </a>

            <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-top-0 border-bottom-0 border-end-0 border-dark border-3 pt-3  height-200 " href="viewBillsComp.php">
              <div class =" text-center">
                <span class="material-symbols-rounded icon-size">request_quote</span>
                <p class="usage-font">Homeowner Bills </p>
              </div>

            </a>
            <div class="col-md-15"></div>
            <div class="col-md-15"></div>
              <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-dark border-start-0 border-bottom-0 border-3 pt-3  height-200 " href="managePrice.php">

                <div class =" text-center">
                  <span class="material-symbols-rounded icon-size">price_change</span>
                  <p class="usage-font">Set Pricing</p>
                </div>
              </a>

              <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border  border-start-0 border-end-0 border-bottom-0  border-dark border-3 pt-3  height-200 "  href="addEditDiscount.php">

                  <div class =" text-center">
                    <span class="material-symbols-rounded icon-size">inventory_2</span>
                    <p class="usage-font ">Set Discount</p>
                  </div>
                </a>

                <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border border-dark border-bottom-0 border-end-0 border-3 pt-3  height-200 " href="enquiryToPlatform.php">

                  <div class =" text-center">
                    <span class="material-symbols-rounded icon-size">contact_support</span>
                    <p class="usage-font">Send Enquiry to Platform </p>
                  </div>
                  </a>
                  <div class="col-md-15"></div>
                  <div class="col-md-15"></div>
                  <div class="col-md-3 hide-box border border-start-0 border-bottom-0 border-dark border-3"></div>
                  <a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-3 border  border-start-0 border-end-0 border-bottom-0  border-dark border-3 pt-3  height-200 " href="viewEnquiryReplies.php">
                      <div class =" text-center">
                        <span class="material-symbols-rounded  icon-size">chat</span>
                        <p class="usage-font ">Platform Replies</p>
                      </div>
                    </a>
                    <div class="col-md-3 hide-box border border-end-0 border-bottom-0 border-dark border-3"></div>


    </div>
  </div>
<?php include_once('jsLinks.php');?>
</body>
</html>
