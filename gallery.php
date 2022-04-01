<?php
require('php/config.php');

// The connection an the usual staff
$sql = "SELECT id, image_name, thumbnail_name, description FROM images";
// Saving database results
$result = mysqli_query($link, $sql);
// Here I created an array to save all the data, It is easier for me to handle that data then in more flixable way.
$data = array();

// Lopping through all the results and converting them to array and pushing them to my data array
if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  
  while ($row = mysqli_fetch_assoc($result)){
    array_push($data, $row);
  }

  // Spletting my array to three parts so I can show the imgs in the columns
  $data = array_chunk($data, (ceil(count($data)/3)));

// If there are no results
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

  <a href="gallery.php"><input type="button" value="Uploade An Image" /></a>

  <div class="gallery">

    <?php
    // Lopping through my data array and on each time the item is called culomn, My main array incoudes is splett to three parts and each part is an array, again to show my imgs in three different culomns
    foreach ($data as $culomn) {
    ?>
    <div class="gallery-column">
      <?php
      // Loppin through my array inside main aray, that aray inclouds my imgs
      foreach ($culomn as $img) {
        echo "<div class='img-wrap'>
                <img src='uploads/". $img["image_name"] . "' alt='". $img["description"] ."'>
              </div>";
      }
      ?>

    </div>

    <?php
    }
    ?>

  </div>

</section>

<script src='app.js'></script>
</body>
</html>
 