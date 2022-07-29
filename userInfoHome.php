<?php
session_start();
include_once "logInCheck.php";
include_once("signuploginClass.php");
include_once("validation.php");
include_once("classes.php");


// echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';

$name = $_SESSION["name"];
$phone = $_SESSION["phone"];
$email = $_SESSION["email"];
$address = $_SESSION["address"];
$postal_code = $_SESSION["postal_code"];
$home_type = $_SESSION["home_type"];
$editInfo_success = "";
$wrong_password = "";
$homeowners = new Homeowner();
if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['randcheck']==$_SESSION['rand']){
  $validate = new Validation();
  $n_password = $_POST['n_password'];

  if (password_verify($_POST['o_password'],$_SESSION['password']) == false)
  {
    $wrong_password = "Old Password is incorrect!";
  }
  else if(password_verify($_POST['o_password'],$_SESSION['password']) && $n_password != "")
  {
    $hashed_password = password_hash($_POST['n_password'], PASSWORD_DEFAULT);
    $homeowners->updateInfoHome($_POST["name"],$_POST["phone"],$_POST["email"],$_POST["address"],$_POST["postal_code"],$_POST["home_type"],$hashed_password);

    $editInfo_success = "Your details have been updated!";
  }
  else if (password_verify($_POST['o_password'],$_SESSION['password']) && $n_password == "")
  {
    $homeowners->updateInfoHome($_POST["name"],$_POST["phone"],$_POST["email"],$_POST["address"],$_POST["postal_code"],$_POST["home_type"],"");
    $editInfo_success = "Your details have been updated!";
  }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
<title>Change Details</title>
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
<div class="container">
    <form class ="form-horizontal-2" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <?php
     $rand=rand();
     $_SESSION['rand']=$rand;
    ?>
    <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div class="row">
        <div class="col">
          <div class="form-floating  mb-3 ">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $_SESSION['name']; ?>">
            <label for="name">Name</label>
          </div>
        </div>

        <div class="col">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="phone" name="phone"placeholder="phone" value="<?php echo $_SESSION['phone']; ?>">
          <label for="phone">Phone</label>
        </div>
      </div>

      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $_SESSION['email']; ?>">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $_SESSION['address']; ?>">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="col">
        <div class="form-floating mb-3">
          <input type="number" class="form-control" id="postal_code" name="postal_code"placeholder="postal_code" value="<?php echo $_SESSION['postal_code']; ?>" >
          <label for="postal_code">Postal Code</label>
        </div>
      </div>

      <div class="row">
          <div class="col">
            <div class="form-floating  mb-3 ">
              <input type="password" class="form-control" id="o_password" name="o_password" placeholder="o_password">
              <label for="o_password">Old password</label>
            </div>
          </div>

          <div class="col">
          <div class="form-floating mb-3">
            <input type="password" class="form-control" id="n_password" name="n_password" placeholder="n_password">
            <label for="n_password">New password</label>
          </div>
        </div>
      </div>

<div class="col form-floating  mb-3 ">
      <div class="condi-dropdown">
        <select id="home_type" name="home_type" class="form-select">
          <option value="2room" <?php if($_SESSION['home_type']=="2room") echo "selected" ?>>HDB 2-room</option>
          <option value="3room" <?php if($_SESSION['home_type']=="3room") echo "selected" ?>>HDB 3-room</option>
          <option value="4room" <?php if($_SESSION['home_type']=="4room") echo "selected" ?>>HDB 4-room</option>
          <option value="5room" <?php if($_SESSION['home_type']=="5room") echo "selected" ?>>HDB 5-room</option>
          <option value="exec" <?php if($_SESSION['home_type']=="exec") echo "selected" ?>>HDB Executive</option>
          <option value="condo" <?php if($_SESSION['home_type']=="condo") echo "selected" ?>>Condominium</option>
          <option value="private" <?php if($_SESSION['home_type']=="private") echo "selected" ?>>Private</option>
        </select>
      </div>
    </div>
    <div class="form-group mb-2 mt-3 text-center">
        <input type="submit" class="btn  btn-primary" value="Save Changes">
    </div>
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $editInfo_success;?></div>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $wrong_password;?></div>
  </form>
</div>
<?php include_once('jsLinks.php');?>

</body>
</html>
