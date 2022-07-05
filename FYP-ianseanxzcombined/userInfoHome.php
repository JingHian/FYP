<?php
session_start();
include_once "logInCheck.php";
$name = $_SESSION["name"];
$phone = $_SESSION["phone"];
$email = $_SESSION["email"];
$address = $_SESSION["address"];
$postal_code = $_SESSION["postal_code"];

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
<title>IT for rent</title>
</head>
<body>
  <?php include_once('navbar.php');?>
  <div class="container" >
  <h1 class ="display-5 text-center" style="margin-top:50px;">Edit Profile</h1>
  <div class="row justify-content-center">
    <div class="col-6 text-center">
  <p class ="display-6 fs-5" name = "product" value ="avail">Change your details here.</p>
</div>
  </div>
</div>
<div class="container justify-content-center"  style="text-align: center;">
<div class="container form-horizontal-2">
    <div class="row">
        <div class="col">
          <div class="form-floating  mb-3 ">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>">
            <label for="name">Name</label>
          </div>
        </div>

        <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="phone" name="phone"placeholder="phone" value="<?php echo $phone; ?>">
          <label for="phone">Phone</label>
        </div>
      </div>

      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="postal_code" name="postal_code"placeholder="postal_code" value="<?php echo $postal_code; ?>" >
          <label for="postal_code">Postal Code</label>
        </div>
      </div>

      <div class="row">
          <div class="col">
            <div class="form-floating  mb-3 ">
              <input type="text" class="form-control" id="o_password" name="o_password" placeholder="o_password">
              <label for="o_password">Old password</label>
            </div>
          </div>

          <div class="col">
          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="n_password" name="n_password"placeholder="n_password">
            <label for="n_password">New password</label>
          </div>
        </div>
      </div>
    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn  btn-primary" value="Save Changes">
    </div>
</div>
<?php include_once('jsLinks.php');?>

</body>
</html>
