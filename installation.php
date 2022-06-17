<?php session_start(); ?>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Company Details</title>
</head>

<body>
    <?php include_once('navbar.php');?>
    <div class ="container">
    </div>

    <div class="heading">
        <h2> Fill In These Installation Details</h2>
    </div>

    <form action="installation.php" method="post">
        <input type="text" name ="name" placeholder="Name">
        <input type="number" name ="phone-number" placeholder="Phone Number" required> <br>
        <input type="text" name ="email" placeholder="Email" required> <br>
        <input type="text" name ="address" placeholder="Address" required> <br>
        <input type="text" name ="postal-code" placeholder="Postal Code" required>
        <input type="date" name ="booking-date" placeholder="Booking Date" required> <br>

        <input type="submit" value="Book" class="enquiry">
    </form>

    <style>
        .heading {
            text-align: center;
            padding: 100px;
        }

        form {
            text-align: center;
            padding: 100px;
        }

        input {
            margin-bottom: 20px;
            border-radius: 5px;

        }

    </style>

</body>
</html>