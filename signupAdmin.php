<?php
include_once("signuploginClass.php");
include_once("validation.php");
$username = "";
$password= "";
$name= "";
$email="";
$phone= "";
$address= null;
$postal_code=null;
$signUpSuccess = "";
$signUpFail = "";
$whiteSpaceError = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_type="admin";
  $home_type = null;
  $validate = new Validation();
  $checkUsername = $validate->validateSpace($_POST["username"]);
  $checkPassword = $validate->validateSpace($_POST["password"]);

  if ($checkUsername == true and $checkPassword == true)
  {
    $username = $validate->trimAndStrip($_POST["username"]);
    $password =$validate->trimAndStrip($_POST["password"]);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $name = $validate->trimAndStrip($_POST["name"]);
    $email = $validate->trimAndStrip($_POST["email"]);
    $phone = $validate->trimAndStrip($_POST["phone"]);
    $signup = new Signup($username,$password,$name,$email,$phone,$address,$postal_code,$home_type,$user_type);

    $checkUniqueID = $signup->checkUniqueIDAdmin();
    if ($checkUniqueID == true){
      $signup->insertIntoTableAdmin();
      $signUpSuccess = "Sign Up Successful! You may now log in";
      $username = "";
      $password= "";
      $name= "";
      $address= "";
      $postal_code= "";
      $phone= "";
      $email="";
    }
    else {
      $signUpFail = "Username already exists!";
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
  <div class="container" >
  <h1 class ="display-5 fw-bold" style="text-align: center;margin-top:100px;">Water Supply Marketplace</h1>
  <h2 class ="display-6 fs-2 text-muted" style="text-align: center;">Admin Sign Up</h2>
  </div>
<div class="container">
  <form class ="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $signUpSuccess;?></div>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $signUpFail;?></div>
      <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $whiteSpaceError;?></div>
      <div class="form-floating mt-3 mb-3  ">
          <input type="text" class="form-control" id="username" name="username" placeholder="username" value="<?php echo $username; ?>"required>
          <label for="username">Username</label>
      </div>
      <div class="form-floating mb-3">
        <input type="password" class="form-control" id="password" name="password"placeholder="password"required>
        <label for="password">Password</label>
      </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>"required>
          <label for="name">Name</label>
        </div>
        <div class="form-floating mb-3">
          <input type="email" class="form-control" id="email"name="email" placeholder="email"value="<?php echo $email; ?>" required>
          <label for="email">Email</label>
        </div>
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="phone"name="phone" pattern="\d*" placeholder="phone" value="<?php echo $phone; ?>"required>
          <label for="phone">Phone number</label>
        </div>

      <div class="form-group mb-2 mt-3">
          <input type="submit" class="btn  btn-primary" value="Sign up">
      </div>
      <p>Have an account? <a href="index.php">Log in now</a>.<br>Not an Admin? <a href="signupHome.php">Homeowner sign up here</a>.</p>
  </form>
</div>
<?php include_once('jsLinks.php');?>
</body>
</html>
