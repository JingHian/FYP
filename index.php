<?php
session_start();
include_once("signuploginClass.php");
include_once("validation.php");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

$logInFailError = "";
$whiteSpaceError = "";
$username = "";
$verificationError = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $validate = new Validation();
  $checkUsername = $validate->validateSpace($_POST["username"]);
  $checkPassword = $validate->validateSpace($_POST["password"]);

  if ($checkUsername == true and $checkPassword == true)
  {
    $username = $validate->trimAndStrip($_POST["username"]);
    $password =$validate->trimAndStrip($_POST["password"]);

    $login = new LogIn($username,$password);

    $checkVerified = $login->checkVerified();
    if ($checkVerified == 'suspended')
    {
      $verificationError = "Your account has been suspended.";
    }
    if ($checkVerified == 'verified')
    {
      $checkLogin = $login->selectFromTable();
      if ($_SESSION['user_type'] == "homeowner")
      {
        header("location: welcomeHomeowner.php");
      }
      else {
        header("location: welcome.php");
      }
    }
    else if ($checkVerified =='pending')
    {
      $verificationError = "Your account has not been verified yet, please check back again soon.";
    }
    else if ($checkVerified =='rejected')
    {
      $verificationError = "Your account creation request has been rejected, please apply again.";
    }
    else if ($checkVerified =='wrongpw')
    {
      $verificationError = "You have entered an invalid password, please try again.";
    }
    else if ($checkVerified =='wrongusername')
    {
      $verificationError = "You have entered an invalid username, please try again.";
    }
  }
  else {
    $whiteSpaceError = "No white spaces allowed in username or password!!";
  }

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
<title>Water Supply Marketplace</title>
</head>
<body>
  <style>
    .main-wrapper{
      background-color: white;
      width: 22%;

      padding:0 0  80px 0;
      box-shadow: 0px 0px 11px -3px rgba(0,0,0,0.75);
    }

    .main-container{
      height:100%;
    }

    .form-horizontal-3{
        display:block;
        width:70%;
        margin:0 auto;
    }
    body{
      background-color:#00aeef  !important;
      background-image: url("img/pexels-pixabay-62307.jpg");
      height: 100%;

      /* Center and scale the image nicely*/
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

    #myVideo {
      position: absolute;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;z-index: -1;
    }
    video{
      object-fit: cover;
      height: 100%;
      width: 100%;

      top: 0;
      left: 0;
    }
    .logo {
        width: 100%;
    }
  </style>
    <!-- <video autoplay muted loop id="myVideo">
  <source src="img/1.mp4" type="video/mp4">
</video> -->
<div class="container main-wrapper min-vh-100 float-start">
  <div class="main-container">
  <div class="container">
    <img class ="logo" src ="img/undraw_fishing_hoxa.png" alt="fishing">
  <h1 class ="display-5" style="text-align: center;">Water Supply Marketplace</h1>
  <p class ="display-6 fs-2 text-muted" style="text-align: center;">Log in</p>
  </div>
<div class="container">
  <form class ="form-horizontal-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <span style ="color:red"><?php echo $whiteSpaceError;  ?></span>
      <span style ="color:red"><?php echo $logInFailError; ?></span>
      <div class="form-floating mt-3 mb-3 ">
        <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo $username; ?>" required>
        <label for="username">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password"placeholder="password" required>
        <label for="password">Password</label>
      </div>

      <div class="form-group mb-2 mt-3">
          <input type="submit" class="btn  btn-primary" value="Login">
      </div>
      <p>Not registered? <a href="signupHome.php">Sign up now.</a></p>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $verificationError;?></div>
  </form>
</div>
</div>
</div>
<?php include_once('jsLinks.php');?>

</body>
</html>
