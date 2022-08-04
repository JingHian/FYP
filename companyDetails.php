<!DOCTYPE html>
<?php
 session_start();
 include_once('conn.php');
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";
 // echo '<pre>' . print_r($_SESSION) . '</pre>';
 $CID = $_SESSION['company_ID'];

 try
 {
   //get prices of water supply
  $query = "SELECT price FROM Company_services as cs
            JOIN Services as serv
            ON cs.service_ID = serv.service_ID
            WHERE company_ID =$CID AND service_name ='Water Supply'";
  $result =  mysqli_query($conn, $query);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $water_price = $row["price"];
        }
    }
    else{
      $water_price = "none";
    }
   //get prices Maintenance
    $query = "SELECT price FROM Company_services as cs
              JOIN Services as serv
              ON cs.service_ID = serv.service_ID
              WHERE company_ID =$CID AND service_name ='Maintenance'";
    $result =  mysqli_query($conn, $query);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $maintenance_price = $row["price"];
          }
      }
      else{
        $maintenance_price = "none";
      }

    $query = "SELECT * FROM Discounts
              WHERE company_ID =$CID";
    $result =  mysqli_query($conn, $query);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            $discount_name = $row["discount_name"];
            $discount_start_date= $row["discount_start_date"];
            $discount_end_date= $row["discount_end_date"];
            $discount_description= $row["discount_description"];
            $discount_modifier= $row["discount_modifier"];
          }
      }
      else{
        $discount_name = "none";
        $discount_start_date= "none";
        $discount_end_date= "none";
        $discount_description= "none";
        $discount_modifier= "none";
      }
  }
  catch (mysqli_sql_exception $e)
  {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }


 if($_SERVER["REQUEST_METHOD"] == "POST") {
   if ($_POST['goTo'] == 'Hire')

   {
     header("location:installation.php");
   }
   else if ($_POST['goTo'] == 'Send Enquiry')
   {
     header("location:sendEnquiry.php");
   }
 }

 ?>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Company Details</title>
</head>
<body>
<style>

.innerReviewTable{
  border: 1px solid SlateBlue;
  margin-bottom: 20px;
  margin-left: auto;
  margin-right: auto;
  width: 100%;
}

.nameandreview{
  background-color: SlateBlue;
  color:white;

}

.name {
  text-align: left;
}

.rating {
  text-align: right;
}


.review {
  height:700px;
    overflow: auto;
    border-radius:10px;
    shape-outside: content-box;
    padding: 20px;
    background-color: white;
    box-shadow: 0px 0px 8px -4px rgba(0,0,0,0.75);
}

.outerreviewtable{
  width:100%;
}

</style>

<?php
    $companyID = $_SESSION['company_ID'];

//count the number of reviews of a particular company
  try {
    $getNumberOfReviews = mysqli_query($conn, "select count(*) from ratings where company_ID = $companyID");
    $numberOfReviews = $getNumberOfReviews->fetch_array()[0] ?? '';
  } catch (mysqli_sql_exception $e) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }

  //calcualte the average rating of a particular company
  try {
    $getAverageRating = mysqli_query($conn, "select avg(score) from ratings where company_ID = $companyID");
    $averageRating = $getAverageRating->fetch_array()[0] ?? '';

  } catch (mysqli_sql_exception $e) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }

  //get the stars
  $stars = $averageRating;
    if ($stars > 0 && $stars < 1)  {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
    }
    else if ($stars == 1) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars > 1 && $stars < 2) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars == 2) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars > 2 && $stars < 3) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars == 3) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars > 3 && $stars < 4) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars == 4) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
  } else if ($stars > 4 && $stars < 5) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>';

  }else if ($stars == 5) {
      $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>';
  }

?>

<div class ="container SlateBlue boxshadow ps-3 p-4">
<div class="row">
  <div class="col text-white ">
    <h1 class ="fw-bold mb-0"><?php echo $_SESSION['company_name'];?></h1>
    <h5 class =""><?php echo $_SESSION['company_address'] ." ". $_SESSION['company_postal'];?> </h5 >
    <h5 class="float-start"><?php echo number_format(floatval($averageRating), 1); ?>&nbsp;</h5>
    <div class="float-start">&nbsp;<?php echo $stars; ?></div>
    <h5 class="float-start"><?php echo  "(" . $numberOfReviews . ")"." "."Reviews";?> </h5>
  </div>
</div>
</div>
<div class ="container">
    <div class="row">
      <div class="col-8 ">
        <div class="aboutUs mt-3">
            <h2 class ="fw-bold">About Us</h2>
            <p><?php echo $_SESSION['company_description'];?>
            </p>
        </div>

        <br>

        <div class="serviceNPrice">
            <h2 class ="fw-bold mb-3">Services and prices</h2>
            <h3 style="font-size:20px;font-weight:bold;">Services Offered</h3>
            <p><?php echo $_SESSION['service_grouped'];?></p>
            <h3 style="font-size:20px;font-weight:bold;">Prices</h3>
        <pre><?php if($water_price != "none"){echo "Water Supply price: $". $water_price . "/m³     ";} if($maintenance_price != "none"){echo "Maintenance Fee: $". $maintenance_price . " per job     ";}?></pre>
        </div>

        <br>

        <div class="packages">
          <h2 class ="fw-bold mb-3">Discounts</h2>
          <h3 style="font-size:20px;font-weight:bold;"><?php echo $discount_name;?></h3>
          <p class="mb-2"><?php echo $discount_description;?></p>
          <pre>Start Date: <?php echo $discount_start_date ;?>     End Date: <?php echo $discount_end_date ;?></pre>
        </div>

        <br>

        <div class="contactUs">

          <h2 class ="fw-bold mb-3">Contact Us</h2>
          <pre>Email: <?php echo $_SESSION['company_email'];?>     Phone Number: <?php echo $_SESSION['company_phone'] ;?></pre>
            <form action="#" method="post">
            <button type='submit' class='btn  btn-primary text-white me-4' name="goTo" value='Hire'>Hire</button>
            <button type='submit' class='btn  btn-info text-white' name="goTo" value='Send Enquiry'>Send Enquiry</button>
          </form>
        </div>
    </div>

<?php

  try {
    //$companyID = $_SESSION['company_ID'];
    $reviews = "select homeowners.name, ratings.score, ratings.review from ratings join homeowners on ratings.homeowner_ID = homeowners.homeowner_ID where ratings.company_ID = $companyID";
    $result = mysqli_query($conn, $reviews);
?>

<div class="col-4 ">
    <div class="review boxshadow mt-3"> <!-- can use overflow-->
      <tr><th><h2>Reviews</h2></th><tr>
      <?php
        if (mysqli_num_rows($result) < 1) {
          echo "<br><br>No reviews has been given to this company.<br><br>";
        } else {
          while (($Row = mysqli_fetch_assoc($result)) != FALSE) {
            $stars = $Row['score'];

            if ($stars == 1) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 1.5) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 2) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 2.5) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 3) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 3.5) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 4) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">grade</div>';
            } else if ($stars == 4.5) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star_half</div>';
            } else if ($stars == 5) {
              $stars = '<div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>
                        <div class="float-start font-20 material-symbols-outlined mt-01 gold">star</div>';
            }

            ?>
            <table class="outerReviewTable">
                <tr>
                    <td>
                        <table class="innerReviewTable">
                            <tr class="nameandreview">
                                <td class="name">
                                    <h4><?php echo $Row['name']?></h4>
                                </td>
                                <td class="rating">
                                    <h4><?php echo $stars;?></h4>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><p class="reviewdetail"><?php echo $Row['review'];?>
                                </p></td>
                            </tr>
                        </table>
                    </td>
                </tr>
              <?php }} ?>
        </table>

        <?php } catch (mysqli_sql_exception $e) {
        echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);}?>
    </div>
</div>
</div>
</div>
</body>
</html>
