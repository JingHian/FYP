<!DOCTYPE html>
<?php
 session_start();
 include_once('conn.php');
 include_once('navbar.php');
 include_once('cssLinks.php');
 include_once "logInCheck.php";
 // echo '<pre>' . print_r($_SESSION) . '</pre>';
 $CID = $_SESSION['ID'];

 try
 {
   //get prices of water supply
  $query = "SELECT price FROM Company_Services as cs
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
    $query = "SELECT price FROM Company_Services as cs
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

    //get discounts
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
      }      //get services
      $query = "SELECT GROUP_CONCAT(serv.service_name SEPARATOR ', ') as service_grouped
                FROM Company AS comp
                JOIN Company_Services AS cs
                ON comp.company_ID = cs.company_ID
                JOIN Services As serv
                ON cs.service_ID = serv.service_ID
                WHERE comp.company_ID = $CID";
      $result =  mysqli_query($conn, $query);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $service_grouped = $row["service_grouped"];
            }
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

<?php

//count the number of reviews of a particular company
  try {
    $getNumberOfReviews = mysqli_query($conn, "SELECT count(*) from Ratings where company_ID = $CID");
    $numberOfReviews = $getNumberOfReviews->fetch_array()[0] ?? '';
  } catch (mysqli_sql_exception $e) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }

  //calcualte the average rating of a particular company
  try {
    $getAverageRating = mysqli_query($conn, "SELECT avg(score) from Ratings where company_ID = $CID");
    $averageRating = $getAverageRating->fetch_array()[0] ?? '';

  } catch (mysqli_sql_exception $e) {
    echo "<p>Error " . mysqli_errno($conn). ": " . mysqli_error($conn);
  }

  //get the stars
  $stars = $averageRating;
    if ($stars > 0 && $stars < 1)  {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
    }
    else if ($stars == 1) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars > 1 && $stars < 2) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars == 2) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars > 2 && $stars < 3) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars == 3) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars > 3 && $stars < 4) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars == 4) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
  } else if ($stars > 4 && $stars < 5) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>';

  }else if ($stars == 5) {
      $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>';
  }

?>
    <div class ="container SlateBlue boxshadow ps-3 p-4">
    <div class="row">
      <div class="col text-white ">
        <h1 class ="fw-bold mb-0"><?php echo $_SESSION['name'];?></h1>
        <h5 class =""><?php echo $_SESSION['address'] ." ". $_SESSION['postal_code'];?> </h5 >
        <h5 class="float-start"><?php echo number_format(floatval($averageRating), 1); ?>&nbsp;</h5>
        <div class="float-start">&nbsp;<?php echo $stars; ?></div>
        <h5 class="float-start"><?php echo  "(" . $numberOfReviews . ")"." "."Reviews";?> </h5>
      </div>
    </div>
    </div>
    <div class ="container">
        <div class="row">
          <div class="col-md-8 ">
            <div class="aboutUs mt-3">
                <h2 class ="fw-bold">About Us</h2>
                <p><?php echo $_SESSION['home_type'];?>
                </p>
            </div>

            <br>

            <div class="serviceNPrice">
                <h2 class ="fw-bold mb-3">Services and prices</h2>
                <h3 style="font-size:20px;font-weight:bold;">Services Offered</h3>
                <p><?php echo $service_grouped;?></p>
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
              <pre>Email: <?php echo $_SESSION['email'];?>   Phone Number: <?php echo $_SESSION['phone'] ;?></pre>
                <form action="#" method="post">
                <button type='submit' class='btn btn-lg btn-secondary text-white me-4' name="goTo" value='Hire' disabled>Hire</button>
                <button type='submit' class='btn btn-lg btn-secondary text-white' name="goTo" value='Send Enquiry' disabled>Send Enquiry</button>
              </form>
            </div>
        </div>

    <?php

      try {
        //$companyID = $_SESSION['ID'];
        $reviews = "SELECT Homeowners.name, Ratings.score, Ratings.review from Ratings join Homeowners on Ratings.homeowner_ID = Homeowners.homeowner_ID where Ratings.company_ID = $CID";
        $result = mysqli_query($conn, $reviews);
    ?>

    <div class="col-md-4 ">
        <div class="review boxshadow mt-3"> <!-- can use overflow-->
          <tr><th><h2>Reviews</h2></th><tr>
          <?php
            if (mysqli_num_rows($result) < 1) {
              echo "<br><br>No reviews has been given to this company.<br><br>";
            } else {
              while (($Row = mysqli_fetch_assoc($result)) != FALSE) {
                $stars = $Row['score'];

                if ($stars == 1) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 1.5) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 2) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 2.5) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 3) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 3.5) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 4) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">grade</div>';
                } else if ($stars == 4.5) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star_half</div>';
                } else if ($stars == 5) {
                  $stars = '<div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>
                            <div class="float-start font-20 material-symbols-rounded mt-01 gold">star</div>';
                }

                ?>
                <table class='table table-borderless boxshadow innerReviewTable'>
                        <tr class='table-padding text-white'>
                                <td >
                                    <h4><?php echo $Row['name']?></h4>
                                </td>
                                <td >
                                    <h4><?php echo $stars;?></h4>
                                </td>
                            </tr>
                            <tbody class='innerReviewTable'>
                                <td colspan="2"><p class="reviewdetail"><?php echo $Row['review'];?>
                                </p></td>
                            </tbody>
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
    <?php include_once('jsLinks.php');?>
    </body>
    </html>
