<?php
session_start();
// echo '<pre>' . print_r($_SESSION) . '</pre>';
include_once "conn.php";
include_once "logInCheck.php";
include_once "classes.php";
$home_ID = $_SESSION['ID'];
$curr_month =date("F"); //get current name of month
// $curr_month = 'July';
// $prev_month = 'September';
$prev_month = date("F", strtotime("first day of previous month")); //get name of previous month
$curr_year = date("Y"); //get current year

//get total water usage for this month
$stmt = $conn->prepare( "SELECT SUM(water_usage) as total_water
                        FROM Water_Tracking
                        WHERE homeowner_ID = ?
                        AND month = ?
                        AND year(usage_date)  = ?");
$stmt-> bind_param("iss",$home_ID,$curr_month,$curr_year);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_water = $row["total_water"];

//get total water usage for previous month
$stmt = $conn->prepare( "SELECT SUM(water_usage) as total_water_prev
                        FROM Water_Tracking
                        WHERE homeowner_ID = ?
                        AND month = ?
                        AND year(usage_date)  = ?");
$stmt-> bind_param("iss",$home_ID,$prev_month,$curr_year);
$stmt->execute();

$result = $stmt->get_result();
$row = $result->fetch_assoc();
$total_water_prev = $row["total_water_prev"];

//put gathered data into arrays
$total_water_combined = [$total_water,$total_water_prev];
$curr_prev_month = [$curr_month,$prev_month];
// print_r ($total_water_combined);

//get sum of each homeowner based on the same home_type as the current logged in homeowner
$stmt = $conn->prepare("SELECT SUM(wt.water_usage) AS avg_water_usage
                        FROM Water_Tracking as wt
                        JOIN Homeowners as home
                        on home.homeowner_ID = wt.homeowner_ID
                        WHERE wt.month = ?
                        AND home.home_type = ?
                        GROUP BY wt.homeowner_ID");
$stmt-> bind_param("ss",$curr_month,$_SESSION['home_type']);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    $houshold_average[] = $row['avg_water_usage'];
  }
  // print_r( $houshold_average);

  //get the average of all water usage data for all homeowners this month
  $houshold_average = array_filter($houshold_average);
  $total_houshold_average = array_sum($houshold_average)/count($houshold_average);
  // echo $total_houshold_average;
  //put gathered data into arrays
  $total_average_combined = [$total_water,$total_houshold_average];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome</title>
    <?php include_once('cssLinks.php');?>

</head>
<body style="height:900px;">
	<?php include_once('navbar.php');?>
		<div class="container ">
			<h1 class="my-5 welcome-font text-center">Hi, <?php echo htmlspecialchars($_SESSION["name"])." "; ?>. Welcome to Water Supply Marketplace.</h1>
    </div>
		<div class="container">
			<div class="row">
        <div class="col-md-55 bg-white pt-2 p-5 rounded boxshadow">
				<h2 class="font-SlateBlue" style="margin-top:30px;margin-bottom:30px;"><b>Water Usage Statistics at a Glance</b></h2>
				<div class=" row ">
					<div class=" height-350">
						<canvas id="myChart"></canvas>
					</div>
				</div>
      </div>
      <div class="col-md-10"></div>
      <div class="col-md-55 bg-white pt-2 p-5 rounded boxshadow">
      <h2 class="font-SlateBlue" style="margin-top:30px;margin-bottom:30px;"><b>Quick Links</b></h2>
				<div class="row ">
					<a class=" menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border border-dark border-start-0 border-top-0 border-2 pt-3  height-200" href="viewWaterUsage.php">
						<div class=" text-center"> <span class="material-symbols-rounded  icon-size">water_drop</span>
							<p class="usage-font">My Water Usage </p>
						</div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border border-dark border-top-0 border-end-0 border-2 pt-3  height-200" href="viewBills.php">
						<div class=" text-center"> <span class="material-symbols-rounded icon-size">request_quote</span>
							<p class="usage-font"> Bills/History </p>
						</div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border  border-start-0 border-bottom-0 border-dark border-2 pt-3  height-200" href="rateAndReviewCompany.php">
						<div class=" text-center"> <span class="material-symbols-rounded icon-size">grade</span>
							<p class="usage-font ">Review Company </p>
						</div>
					</a>
					<a class="menu-style no-text-deco no-rounded-border d-flex align-items-center justify-content-center col-md-6 border   border-bottom-0 border-end-0 border-dark border-2 pt-3  height-200" href="enquiryToPlatform.php">
						<div class=" text-center"> <span class="material-symbols-rounded icon-size">contact_support</span>
							<p class="usage-font">Send Enquiry to Platform </p>
						</div>
					</a>
					<div class="col-md-15"></div>
				</div>
			</div>
      </div>
		</div>
  <?php

    $HID = $_SESSION['ID'];
    $stmt = $conn->prepare("SELECT month,usage_date, sum(water_usage) as total_usuage
            FROM Water_Tracking
            WHERE homeowner_ID = ? GROUP BY month ORDER BY usage_date ASC");
    $stmt-> bind_param("i",$HID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $month[] = $row['month'];
        $data[] = $row['total_usuage'];
      }
    }
  ?>
  <?php include_once('jsLinks.php');?>
  <script>

  const ctx = document.getElementById('myChart');
  const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels:   <?php echo json_encode($month)?>,
          datasets: [{
              barThickness: 26,
              label: 'Water Usage',
              data: <?php echo json_encode($data)?>,
              backgroundColor: [
                  'rgba(54, 162, 235, 0.8)'
              ],
              borderColor: [
                    'rgba(54, 162, 235, 0.8)',
              ],
              borderWidth: 1
          }]
      },
      options: {
        responsive:true,
        maintainAspectRatio: false,
        scales: {
          x: {
            grid: {
              display: false
            }
          },
            y: {
              grid: {
                display: false
              },
                beginAtZero: true
            }
        },
        plugins: {
                 legend: {
                    display: false
                 }
              }
      }
  });



  </script>
</body>
</html>
