<?php
include("signuploginClass.php");
include("validation.php");
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<title>Water Supply Marketplace</title>
</head>
<body>
  <style>

    .form-horizontal{
        display:block;
        width:25%;
        margin:0 auto;
    }

  </style>
  <div class="container" >
  <h1 class ="display-5" style="text-align: center;margin-top:100px;">Water Supply Marketplace</h1>
  <h2 class ="display-6 fs-2 text-muted" style="text-align: center;">Admin Sign Up</h2>
  </div>
<div class="container">
  <form class ="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <span style ="color:green"><?php echo $signUpSuccess;?></span>
        <span style ="color:red"><?php echo $signUpFail;  ?></span>
        <span style ="color:red"><?php echo $whiteSpaceError;  ?></span>
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
          <label for="name">Company Name</label>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>
