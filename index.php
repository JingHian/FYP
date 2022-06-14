<?php
session_start();
include("signuploginClass.php");
include("validation.php");

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}

$logInFailError = "";
$whiteSpaceError = "";
$username = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $validate = new Validation();
  $checkUsername = $validate->validateSpace($_POST["username"]);
  $checkPassword = $validate->validateSpace($_POST["password"]);

  if ($checkUsername == true and $checkPassword == true)
  {
    $username = $validate->trimAndStrip($_POST["username"]);
    $password =$validate->trimAndStrip($_POST["password"]);
    $login = new LogIn($username,$password);
    $checkLogin = $login->selectFromTable();
    if ($checkLogin == false)
    {
      $logInFailError = "Invalid username or password!";
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
    <?php include('cssLinks.php');?>
<title>Water Supply Marketplace</title>
</head>
<body>
  <div class="container">
  <h1 class ="display-5" style="text-align: center;margin-top:100px;">Water Supply Marketplace</h1>
  <p class ="display-6 fs-2 text-muted" style="text-align: center;">Log in</p>
  </div>
<div class="container">
  <form class ="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
  </form>
</div>
<?php include('jsLinks.php');?>

</body>
</html>
