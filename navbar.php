  	<nav class="container navbar navbar-expand-lg navbar-light bg-light fs-6">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link "  href="welcome.php">Home</a>
          <?php
            if($_SESSION["user_type"] =="company"){echo '<a class="nav-link " href="insertProducts.php" >Insert Products</a>';}
          ?>
          <a class="nav-link " href="listProducts.php" >List Products</a>

          <?php
            if($_SESSION["user_type"] =="homeowner"){
              echo '<a class="nav-link " href="rentProducts.php" >Rent Products</a>';
              echo '<a class="nav-link " href="extendProducts.php" >Extend Rent</a>';
              echo '<a class="nav-link " href="returnProducts.php" >Return Products</a>';
                                          }
          ?>
          <a class="nav-link " href="searchProducts.php" >Search Products</a>
        </div>
        <div class="navbar-nav ms-auto">
          <a class="nav-link " href="userInfo.php"><?php echo htmlspecialchars($_SESSION["name"]).'('.htmlspecialchars($_SESSION["user_type"]).')'; ?></a>
          <a class="nav-link active d-flex justify-content-end" href="logout.php" >log out</a>
        </div>
      </div>
    </div>
  </nav>
