<?php
class Signup{
  private $conn = NULL;
  private $username;
  private $password;
  private $name;
  private $email;
  private $phone;
  private $address;
  private $postal_code;
  private $home_type;
  private $user_type;

  function __construct($username,$password,$name,$email,$phone,$address,$postal_code,$home_type,$user_type) {
  	include_once("conn.php");
    	$this->conn = $conn;
      $this->username = $username;
      $this->password = $password;
      $this->name = $name;
      $this->email = $email;
      $this->phone = $phone;
      $this->address = $address;
      $this->postal_code = $postal_code;
      $this->home_type = $home_type;
      $this->user_type = $user_type;

  }

  function checkUniqueID() //check if username is unique
  {
    $sql = "Select * from Homeowners where username='$this->username'";

    $result = $this->conn->query($sql);

    $num = mysqli_num_rows($result);

    if($num > 0)
    {
      return false;
    }
    else{
      return true;
    }

  }

  function insertIntoTable() //insert homeowner details into databse
  {
    try
    {
      $sql = "INSERT INTO Homeowners (username, password,name,email,phone,address,postal_code,home_type,user_type) VALUES ( '$this->username', '$this->password', '$this->name', '$this->email', '$this->phone', '$this->address', '$this->postal_code', '$this->home_type', '$this->user_type')";
      $result = mysqli_query($this->conn, $sql);
      //printf("Affected rows (INSERT): %d\n", $this->conn->affected_rows);
    }
    catch (mysqli_sql_exception $e)
    {
      echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    }
  }

  function insertIntoTableCompany() //insert company details into databse
  {
    try
    {
      $sql = "INSERT INTO Company (username, password, name, email, phone, address,postal_code,user_type) VALUES ( '$this->username', '$this->password', '$this->name', '$this->email', '$this->phone', '$this->address', '$this->postal_code','$this->user_type')";
      $result = mysqli_query($this->conn, $sql);
    }
    catch (mysqli_sql_exception $e)
    {
      echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    }
  }

}

class LogIn extends SignUp{

  function __construct($username,$password){
    include_once("conn.php");
    $this->conn = $conn;
    $this->username = $username;
    $this->password = $password;
  }

  function selectFromTable()
  {
    $sql = "SELECT password,name,email,phone,address,postal_code,home_type,user_type FROM Homeowners WHERE username = '$this->username' UNION SELECT password,name,email,phone,address,postal_code,null,user_type FROM Company WHERE username = '$this->username'";
    $result = $this->conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    if(mysqli_num_rows($result)==1)
    {
      $hashed_password = $row['password'];
      if(password_verify($this->password, $hashed_password)){ //if password is correct
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["name"] = $row['name'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["phone"] = $row['phone'];
            $_SESSION["address"] = $row['address'];
            $_SESSION["postal_code"] = $row['postal_code'];
            $_SESSION["home_type"] = $row['home_type'];
            $_SESSION["user_type"] = $row['user_type'];
            header("location: welcome.php");
      }
      else{

          return false;
      }
    }
  }

}

?>
