<?php
require('php/config.php');

$sql = "SELECT id, image_name, thumbnail_name, description FROM images";
$result = mysqli_query($link, $sql);
$data = array();
$img_cul1 = array();
$img_cul2 = array();
$img_cul3 = array();

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  
  while ($row = mysqli_fetch_assoc($result)){
    array_push($data, $row);
  }

  if(count($data) >= 3) {
    $length = round(count($data) / 3);

    for($i = 0; $i <= $length; $i++) {
      array_push($img_cul1, $data[$i]);
    }

    for($i = $length; $i <= ($length*2); $i++) {
      array_push($img_cul2, $data[$i]);
    }

    for($i = ($length*2); $i <= ($length*3); $i++) {
      array_push($img_cul3, $data[$i]);
    }
  }

  // output data of each row
} else {
  echo "0 results";
}
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>File uploader</title>
  <!-- <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> -->
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<section>
  <h1>Upload an image</h1>

  <div class="gallery">

  <!-- -------------- cloumn 1 -------------- -->
    <div class="gallery-column">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        for($i = 0; $i <= $length; $i++) {

          echo "<div class='img-wrap'>
            <img src='uploads/". $img_cul1[$i]["image_name"] . "' alt='". $img_cul1[$i]["description"] ."'>
            </div>";

        }
      } else {
        echo "0 results";
      }
      ?>
    </div>

    <!-- -------------- cloumn 2 -------------- -->
    <div class="gallery-column">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        for($i = ($length-1); $i <= (($length*2)-1); $i++) {

          echo "<div class='img-wrap'>
            <img src='uploads/". $img_cul1[$i]["image_name"] . "' alt='". $img_cul1[$i]["description"] ."'>
            </div>";

        }
      } else {
        echo "0 results";
      }
      ?>                    
    </div>
    <!-- -------------- cloumn 3 -------------- -->
    <div class="gallery-column">
      <?php
      if (mysqli_num_rows($result) > 0) {
        // output data of each row
        for($i = (($length*2)-1); $i <= (($length*3)-1); $i++) {

          echo "<div class='img-wrap'>
            <img src='uploads/". $img_cul1[$i]["image_name"] . "' alt='". $img_cul1[$i]["description"] ."'>
            </div>";

        }
      } else {
        echo "0 results";
      }
      ?>
    </div>

  </div>

</section>

<script src='app.js'></script>
</body>
</html>
 