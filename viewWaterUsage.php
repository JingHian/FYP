<?php
// Initialize the session
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
        <?php include_once('cssLinks.php');?>
    <title>Welcome</title>
</head>
<body>
    <?php include_once('navbar.php');?>
    <h2 class ="text-center" style="margin-top:30px;margin-bottom:30px;">Water Usage</h2>
    <div class ="container">
      <div class =" row ">
        <div class ="col-3 boxshadow bg-primary text-white p-4 height-350">
          <div>
            <h3 class="usage-font"><?php echo $_SESSION['name'];?></h3>
            <h3 class="usage-font"><?php echo $_SESSION['address'];?></h3>
            <h3 class="usage-font"><?php echo $_SESSION['postal_code'];?></h3>
            <hr class="white-line">
            <h3 class=""><b>Water Usage For <?php echo $curr_month;?>:</b></h3>
            <h1 class=""><b> <?php echo $total_water;?>cm³</b></h1>

          </div>
        </div>
        <div class ="col-1"></div>
        <div class ="col-8  height-350">
            <canvas id="myChart"></canvas>
        </div>
      </div>
      <hr class ="hr-margin">
      <h2 class ="text-center" style="margin:10px 0 20px 0;">Stats</h2>
      <div class ="row height-300">
        <div class ="col-5 bg-grey height-350 boxshadow" style="padding-bottom:80px;">
              <canvas id="myChart2"></canvas>
              <?php
              if ($total_water> 0 && $total_water_prev > 0 && $total_water > $total_water_prev)
              {
                $water_percent = (($total_water - $total_water_prev)/$total_water_prev) * 100;
                echo '<p class="usage-font text-center">You used '.number_format($water_percent, 1).'% more water than last month</p>';
              }
              else if ($total_water> 0 && $total_water_prev > 0 &&$total_water < $total_water_prev)
              {
                $water_percent = (($total_water_prev - $total_water)/$total_water) * 100;
                echo '<p class="usage-font text-center">You used '.number_format($water_percent, 1).'% less water than last month</p>';
              }
              else if ($total_water> 0 && $total_water_prev > 0 &&$total_water == $total_water_prev)
              {
                echo '<p class="usage-font text-center">You used the same amount of water as last month</p>';
              }
              else
              {
                echo '<p class="usage-font text-center">No water usage stats for this month</p>';
              }
              ?>
        </div>
        <div class ="col-2">  </div>
        <div class ="col-5 bg-grey height-350 boxshadow" style="padding-bottom:80px;">
          <canvas id="myChart3"></canvas>
          <?php
          if ($total_water> 0 && $total_houshold_average > 0 && $total_water > $total_houshold_average)
          {
            $water_percent = (($total_water - $total_houshold_average)/$total_houshold_average) * 100;
            echo '<p class="usage-font text-center">You used '.number_format($water_percent, 1).'% more water than similar households this month</p>';
          }
          else if ($total_water> 0 && $total_houshold_average > 0 &&$total_water < $total_houshold_average)
          {
            $water_percent = (($total_houshold_average - $total_water)/$total_water) * 100;
            echo '<p class="usage-font text-center">You used '.number_format($water_percent, 1).'% less water than similar households this month</p>';
          }
          else if ($total_water> 0 && $total_houshold_average > 0 &&$total_water == $total_houshold_average)
          {
            echo '<p class="usage-font text-center">You used the same amount of water similar households this month</p>';
          }
          else
          {
            echo '<p class="usage-font text-center">No water usage stats for this month</p>';
          }
          ?>
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



  const ctx2 = document.getElementById('myChart2');
  const myChart2 = new Chart(ctx2, {
      type: 'doughnut',
      data: {
          labels:   <?php echo json_encode($curr_prev_month)?>,
          datasets: [{
              label: 'Water Usage',
              data: <?php echo json_encode($total_water_combined)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.8)',
                  'rgba(54, 162, 235, 0.8)'
              ],
              borderColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        responsive:true,
        maintainAspectRatio: false,

        plugins: {
                 legend: {
                    display: true
                 }
              }
      }
  });

  const ctx3 = document.getElementById('myChart3');
  const myChart3 = new Chart(ctx3, {
      type: 'doughnut',
      data: {
          labels:  ['You','Other Households'],
          datasets: [{
              label: 'Water Usage',
              data: <?php echo json_encode($total_average_combined)?>,
              backgroundColor: [
                  'rgba(255, 99, 132, 0.8)',
                  'rgba(54, 162, 235, 0.8)'
              ],
              borderColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        responsive:true,
        maintainAspectRatio: false,

        plugins: {
                 legend: {
                    display: true
                 }
              }
      }
  });

  </script>
</body>
</html>
