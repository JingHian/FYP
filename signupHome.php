<!DOCTYPE html>
<?php
include_once("signuploginClass.php");
include_once("validation.php");
include_once("conn.php");
include_once("classes.php");
$username = "";
$password= "";
$name= "";
$email="";
$phone= "";
$address= "";
$postal_code="";
$signUpSuccess = "";
$signUpFail = "";
$whiteSpaceError = "";
$captcha_failed = "";
$test= "";
$uni  = new Universal();

if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['randcheck']==$_SESSION['rand']) {


  $recaptcha = $_POST['g-recaptcha-response'];

  // Put secret key here, which we get
  // from google console
  $secret_key = "6LcAl20hAAAAALP5eQ7sMH0WJdBTZxiBBw7Ci1o0";

  // Hitting request to the URL, Google will
  // respond with success or error scenario
  $url = 'https://www.google.com/recaptcha/api/siteverify?secret='
        . $secret_key . '&response=' . $recaptcha;

  // Making request to verify captcha
  $response = file_get_contents($url);

  // Response return by google is in
  // JSON format, so we have to parse
  // that json
  $response = json_decode($response);
  // Checking, if response is true or not
  if ($response->success == true) {
      $user_type="homeowner";
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
        $address = $validate->trimAndStrip($_POST["address"]);
        $postal_code = $validate->trimAndStrip($_POST["postal_code"]);
        $home_type = $validate->trimAndStrip($_POST["home_type"]);
        $services = $_POST["services"];
        // print_r($services);
        $signup = new Signup($username,$password,$name,$email,$phone,$address,$postal_code,$home_type,$user_type);

        $checkUniqueID = $signup->checkUniqueID();
        if ($checkUniqueID == true){
          $signup->insertIntoTable();
          $signup->insertIntoServices($services);
          $signup->insertIntoHomeownerServices($services);
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
  } else {
      $captcha_failed= "reCAPTCHA failed, please try again";}

}

?>

<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
    <title>Water Supply Marketplace</title>
  </head>
  <body>
    <div class="container">
      <h1 class="display-5 fw-bold" style="text-align: center;margin-top:100px;">Water Supply Marketplace</h1>
      <h2 class="display-6 fs-2 text-muted" style="text-align: center;">Homeowner Sign Up</h2>
    </div>
    <form class="form-horizontal" id="form_home" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">  <?php
       $rand=rand();
       $_SESSION['rand']=$rand;
      ?>
      <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
    <div id="carousel-one" class="carousel carousel-dark slide"  data-bs-touch="false" data-bs-interval="false">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carousel-one" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carousel-one" data-bs-slide-to="1" aria-label="Slide 2"></button>
    </div>
    <div class ="container" style="height:780px;">
    <div class="carousel-inner " >
        <div class="carousel-item active">
              <div class="alert alert-success booking-alert mt-3" role="alert"><?php echo $signUpSuccess;?></div>
              <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $captcha_failed;?></div>
              <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $signUpFail;?></div>
              <div class="alert alert-danger booking-alert mt-3" role="alert"><?php echo $whiteSpaceError;?></div>
              <div class="form-floating mt-3 mb-3 ninety-five ">
                <input type="text" class="form-control " id="username" name="username" placeholder="username" value="<?php echo $username; ?>" required>
                <label for="username">Username</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="password" class="form-control" id="password" name="password" placeholder="password" required>
                <label for="password">Password</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $name; ?>" required>
                <label for="name">Full Name</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="email" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>" required>
                <label for="email">Email</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="text" class="form-control" id="phone" name="phone" pattern="\d*" placeholder="phone" value="<?php echo $phone; ?>" required>
                <label for="phone">Phone number</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>" required>
                <label for="address">Address</label>
              </div>
              <div class="form-floating mb-3 ninety-five">
                <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="postal_code" value="<?php echo $postal_code; ?>" required>
                <label for="address">Postal Code</label>
              </div>
              <div class="condi-dropdown ninety-five">
                <select id="home_type" name="home_type" class="form-select">
                  <option value="2room">HDB 2-room</option>
                  <option value="3room">HDB 3-room</option>
                  <option value="4room">HDB 4-room</option>
                  <option value="5room">HDB 5-room</option>
                  <option value="exec">HDB Executive</option>
                  <option value="condo">Condominium</option>
                  <option value="private">Private</option>
                </select>
              </div>
              <div class="form-group mb-2 mt-3 ninety-five">
                <button type="button" class="btn btn-lg btn-primary" data-bs-target="#carousel-one" data-bs-slide-to="1" >Next</button>
              </div>
              <p class="ninety-five">Have an account? <a href="index.php">Log in now</a>.
              <br>Not a homeowner? <a href="signupComp.php">Company sign up here</a>.
              </p>
            </div>
            <div class="carousel-item" >
              <div class="alert alert-danger booking-alert mt-3" id="check-error" role="alert"></div>
              <p style="text-align: center;">What services are you looking for?</p>
              <div class= "row d-flex justify-content-center"  id="services-checkbox">
              <?php
                $uni ->servicesCheckBoxes();
               ?>
            </div>
            <div class=" form-floating mt-3 mb-3  last_service"></div>
              <a id="add_service" class="ninety-five" href="#">+Add a service</a>
              <div class="g-recaptcha form-group mb-2 mt-3 ninety-five"
                  data-sitekey="6LcAl20hAAAAAEv5uGqx3KutJfBmAlvKuiEXyhCG">
              </div>
              <div class="form-group mb-2 mt-3 ninety-five">
                <input type="submit" id="sign-up" class="btn  btn-primary" value="Sign up">
              </div>
              <p class="ninety-five">Have an account? <a href="index.php">Log in now</a>.
              <br>Not a homeowner? <a href="signupComp.php">Company sign up here</a>.
              </p>
              </div>
        </div>
      </div>
    </div>
    </form>
    <?php include_once('jsLinks.php');?>
    <script src=
        "https://www.google.com/recaptcha/api.js" async defer>
    </script>
    <script>
    $( "#sign-up" ).click(function() {

    if($('#services-checkbox :checkbox:checked').length > 0 == false){
    $("#form_Comp").submit(function(e){
        e.preventDefault();
        $("#form_Comp").off("submit");
    });
      $('#check-error').text('Please check at least one service!');
    }
    });
    </script>
  </body>
</html>
