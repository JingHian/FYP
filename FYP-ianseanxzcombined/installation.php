<?php session_start();

$name = $_SESSION["name"];
$phone = $_SESSION["phone"];
$email = $_SESSION["email"];
$address = $_SESSION["address"];
$postal_code = $_SESSION["postal_code"];
include_once "logInCheck.php";

?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php include_once('cssLinks.php');?>
    <title>Company Details</title>
</head>

<body>
    <?php include_once('navbar.php');?>
  <div class="container" >
  <h1 class ="display-5 text-center" style="margin-top:50px;">Choose Installation Date</h1>
  <div class="row justify-content-center">
    <div class="col-6 text-center">
  <p class ="display-6 fs-5" name = "product" value ="avail">confirm your details.</p>
</div>
  </div>
</div>
<div class="container form-horizontal">
    <div class="row">
        <div class="col">
          <div class="form-floating  mb-3 ">
            <input type="text" class="form-control" id="name" name="name" placeholder="name" value="<?php echo $_SESSION["name"]; ?>"disabled>
            <label for="name">Name</label>
          </div>
        </div>

        <div class="col">
        <div class="form-floating mb-3">
          <input type="text" class="form-control" id="phone" name="phone"placeholder="phone" value="<?php echo $phone; ?>"disabled>
          <label for="phone">Phone</label>
        </div>
      </div>
      </div>


      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="email" name="email" placeholder="email" value="<?php echo $email; ?>"disabled>
          <label for="email">Email</label>
        </div>
      </div>

      <div class="col">
        <div class="form-floating  mb-3 ">
          <input type="text" class="form-control" id="address" name="address" placeholder="address" value="<?php echo $address; ?>"disabled>
          <label for="address">Address</label>
        </div>
      </div>

<div class="row">
      <div class="col">
        <div class="form-floating mb-3 ">
          <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="postal_code" value="<?php echo $postal_code; ?>"disabled>
          <label for="postal_code">Postal Code</label>
        </div>
      </div>

      <div class="col">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <div class="form-floating mb-3">
          <input type="date" class="form-control" id="date" name="date"placeholder="date" >
          <label for="date">Date</label>
        </div>
        </form>
      </div>
    </div>
    <div class="col">
      <div class="form-floating  mb-3 ">
        <textarea class="form-control" id="comments" name="comments" placeholder="comments" style="height: 200px" ></textarea>
        <label for="comments">Additional comments</label>
      </div>
    </div>
    <div class="form-group mt-3 text-center">
        <input type="submit" class="btn btn-primary" value="Submit">
    </div>
</div>
<?php include_once('jsLinks.php');?>
</body>
</html>
