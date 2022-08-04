<div class="containertest" >
    <nav class=" navbar navbar-expand-lg navbar-dark" style="background-color:#2d3e50;">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link "  href="welcome.php">Home</a>
          <?php
            if($_SESSION["user_type"] =="admin"){
              echo '<a class="nav-link " href="userProfiles.php" >View Profiles</a>';
              echo '<a class="nav-link " href="verifyCompanies.php" >Verify Companies</a>';
              echo '<a class="nav-link " href="viewEnquiriesAdmin.php" >Enquiries</a>';
              echo '<a class="nav-link " href="viewServiceAdmin.php" >Service Categories</a>';
            }
            if($_SESSION["user_type"] =="company"){
              echo '<a class="nav-link " href="#" >Customers</a>';
              echo '<a class="nav-link " href="servicesCompany.php" >Services</a>';
              echo '<a class="nav-link " href="viewEquipment.php" >Equipment</a>';
              echo '<a class="nav-link " href="viewStaff.php" >Staff</a>';
              echo '<a class="nav-link " href="viewCases.php" >Enquiries</a>';
              echo '<a class="nav-link " href="viewBookingsComp.php" >Bookings</a>';
            }
            if($_SESSION["user_type"] =="homeowner"){
              echo '<a class="nav-link " href="viewCompanies.php" >View Companies</a>';
              echo '<a class="nav-link " href="servicesHomeowner.php" >My Services</a>';
              echo '<a class="nav-link " href="viewBookingsHomeowner.php" >Bookings</a>';
              echo '<a class="nav-link " href="viewEnquiries.php" >Enquiries</a>';
              echo '<a class="nav-link " href="addWaterUsage.php" >Add Water Usage</a>';
            }
          ?>
        </div>
        <div class="navbar-nav ms-auto">

          <a class="nav-link "
            <?php
              if($_SESSION["user_type"] =="company"){
              echo 'href="userInfo.php">';
            }
              else if($_SESSION["user_type"] =="homeowner"){
              echo 'href="userInfoHome.php">';
          } else {
            echo '>';
          }
            ?>
            <?php echo htmlspecialchars($_SESSION["name"]).'('.htmlspecialchars($_SESSION["user_type"]).')'; ?></a>
          <a class="nav-link d-flex justify-content-end" href="logout.php" >log out</a>
        </div>
      </div>
    </div>
  </nav>
</div>
