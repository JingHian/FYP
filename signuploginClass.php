<?php
class SignUp{
  protected $conn = NULL;
  protected $username;
  protected $password;
  protected $name;
  protected $email;
  protected $phone;
  protected $address;
  protected $postal_code;
  protected $home_type;
  protected $user_type;

  function __construct($username,$password,$name,$email,$phone,$address,$postal_code,$home_type,$user_type) {
    include("conn.php");
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
    $sql = "SELECT homeowner_ID FROM Homeowners WHERE username='$this->username' UNION
            SELECT company_ID FROM Company WHERE username='$this->username'";

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

  function checkUniqueName() //check if Company name is unique
  {
    $sql = "SELECT * FROM Company WHERE name='$this->name'";

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

  function checkUniqueIDAdmin() //check if username is unique for admin
  {
    $sql = "SELECT * FROM Admin WHERE username='$this->username'";

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
      $stmt = $this->conn->prepare("INSERT INTO Homeowners (username, password,name,email,phone,address,postal_code,home_type,user_type,verified) VALUES ( ?,?,?,?,?,?,?,?,?,?)");
      $one = 1;
      $stmt->bind_param("ssssisissi", $this->username, $this->password, $this->name, $this->email, $this->phone, $this->address ,$this->postal_code, $this->home_type, $this->user_type,$one);
      //printf("Affected rows (INSERT): %d\n", $this->conn->affected_rows);

      $stmt->execute();
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
      $stmt = $this->conn->prepare("INSERT INTO Company (username, password, name, email, phone, address,postal_code,description,user_type) VALUES ( ?,?,?,?,?,?,?,?,?)");
      $desc = "No description has been set by the company yet";
      $stmt->bind_param("ssssisiss", $this->username, $this->password, $this->name, $this->email, $this->phone, $this->address ,$this->postal_code, $desc, $this->user_type);
      $stmt->execute();
    }
    catch (mysqli_sql_exception $e)
    {
      echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    }
  }

  function insertIntoTableAdmin() //insert company details into databse
  {
    try
    {
      $sql = "INSERT INTO Admin (username, password, name, email, phone,user_type) VALUES ( '$this->username', '$this->password', '$this->name', '$this->email', '$this->phone','$this->user_type')";
      $result = mysqli_query($this->conn, $sql);
    }
    catch (mysqli_sql_exception $e)
    {
      echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    }
  }


  function insertIntoServices($services)
  {
    // print_r($this->services);

    try
    {
    foreach ($services as $i => $value) {
      $sql = "INSERT IGNORE INTO Services (service_name) VALUES('$value')";
      $result = mysqli_query($this->conn, $sql);
      }
    }
    catch (mysqli_sql_exception $e)
    {
      echo "<p>Error " . mysqli_errno($this->conn). ": " . mysqli_error($this->conn) . "</p>";
    }
  }


  function insertIntoHomeownerServices($services)
  {
    // print_r($this->services);
    foreach ($services as $i => $value) {
    $sql = "SELECT service_ID FROM Services where service_name ='$value'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $service_ID_List[] = $row['service_ID'];
      }
    }
    }

    $sql = "SELECT homeowner_ID FROM Homeowners where username ='$this->username'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $homeowner_ID = $row['homeowner_ID'];
      }
    }
  // print_r($service_ID_List);
  // echo $homeowner_ID;
  if (is_array($service_ID_List) || is_object($service_ID_List))
  {
    foreach ($service_ID_List as $i => $value) {
      $sql = "INSERT INTO Homeowner_Services (service_ID,homeowner_ID) values ( '$value', '$homeowner_ID')";
      $result = mysqli_query($this->conn, $sql);
      }

    }
  }

  function insertIntoCompanyServices($services)
  {
    // print_r($this->services);
    foreach ($services as $i => $value) {
    $sql = "SELECT service_ID FROM Services where service_name ='$value'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $service_ID_List[] = $row['service_ID'];
      }
    }
    }

    $sql = "SELECT company_ID FROM Company where username ='$this->username'";
    $result = mysqli_query($this->conn, $sql);
    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $company_ID = $row['company_ID'];
      }
  }
  // print_r($service_ID_List);
  // echo $company_ID;

  foreach ($service_ID_List as $i => $value) {
    $sql = "INSERT INTO Company_Services (service_ID,company_ID) values ( '$value', '$company_ID')";
    $result = mysqli_query($this->conn, $sql);
  }

  }

}

class LogIn extends SignUp{

  function __construct($username,$password){
    include("conn.php");
    $this->conn = $conn;
    $this->username = $username;
    $this->password = $password;
  }

  function checkVerified()
  {
    $sql = "SELECT suspended,verified,password FROM Homeowners WHERE username = '$this->username'
      UNION SELECT suspended,verified,password FROM Company WHERE username = '$this->username'
      UNION SELECT suspended,verified,password FROM Admin WHERE username = '$this->username'";
    $result = $this->conn->query($sql);

    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

    if(mysqli_num_rows($result)==1)
    {
      $hashed_password = $row['password'];
      if(password_verify($this->password, $hashed_password))
      { //if password is correct
        if ($row['suspended'] == 1 ){
          return "suspended";
        }

        if ($row['verified'] == 0 ){
          return "pending";
        }
        else if ($row['verified'] == 1 ){
          return "verified";
        }
        else if ($row['verified'] == 2 ){
          return "rejected";
      }
    } else{
      return "wrongpw";
    }
  } else {
    return "wrongusername";
  }

  }

  function selectFromTable()
  {
    $sql = "SELECT homeowner_ID as ID,password,name,email,phone,address,postal_code,home_type,user_type FROM Homeowners WHERE username = '$this->username'
      UNION SELECT company_ID as ID,password,name,email,phone,address,postal_code,description,user_type FROM Company WHERE username = '$this->username'
      UNION SELECT admin_ID as ID,password,name,email,phone,null,null,null,user_type FROM Admin WHERE username = '$this->username'";
    $result = $this->conn->query($sql);
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    // printf("Affected rows (INSERT): %d\n", $this->conn->affected_rows);
    if(mysqli_num_rows($result)==1)
    {
      $hashed_password = $row['password'];
      if(password_verify($this->password, $hashed_password)){ //if password is correct
            session_start();
            // Store data in session variables
            $_SESSION["loggedin"] = true;
            $_SESSION["ID"] = $row['ID'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["phone"] = $row['phone'];
            $_SESSION["address"] = $row['address'];
            $_SESSION["postal_code"] = $row['postal_code'];
            $_SESSION["home_type"] = $row['home_type'];
            $_SESSION["user_type"] = $row['user_type'];
            $_SESSION["verified"] = $row['verified'];
      }
      else{

          return false;
      }
    }
  }


}



?>
