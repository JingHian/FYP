<!DOCTYPE html>
<?php
session_start();
include("conn.php");
include_once("classes.php");
include_once('cssLinks.php');
$img_name = '';
$uni = new Universal();
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $uni->imageUpload($_FILES);
  $img_name = $_FILES["fileToUpload"]["name"];
}
?>

<html>
  <body>

    <form action="imageUpload.php" method="post" enctype="multipart/form-data">
      Select image to upload:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Upload Image" name="submit">
    </form>

    <img class="image-upload" src="img/<?php echo $img_name?>"/>

  </body>
<?php include_once('jsLinks.php');?>
</html>
