<?php
 
session_start();
 
 
function createThumbnail($thumb_width, $thumb_height, $upload_image, $thumbnail_image) {
 
  // Takes the upload image size, and saves the width and height of it in separate variables
  list($width, $height) = getimagesize($upload_image);
  // Create new variable with thumbnail width size, witch we use to create the thumbnail
  $thumb = imagecreatetruecolor($thumb_width, $thumb_height);
  // using RegEx we take the variable $upload_image and find the file extension, in this case PNG
  // $upload_image = 'test.png';
 
  if (preg_match('/[.](png)$/i', $upload_image)) {
 
    // Create a new variable and since we've matched it as PNG, we set it as 'png'
    $format = 'png';
    $_SESSION["format"] = 'png';
    // Create a new variable witch create a new image from PNG
    $img_source = imagecreatefrompng($upload_image);
    // make sure to enable transparency for the PNG format when available
    imagealphablending($img_source, true);
    // Make sure to save the transparency for the thumbnail
    imagesavealpha($img_source, true);
 
  } else if (preg_match('/[.](gif)$/i', $upload_image)) {
 
    $format = 'gif';
    $_SESSION["format"] = 'gif';
    $image_source = imagecreatefromgif($upload_image);
 
  } else if (preg_match('/[.](jpg|jpeg)$/i', $upload_image)) {
 
    $format = 'jpg';
    $_SESSION["format"] = 'jpg';
    $image_source = imagecreatefromjpeg($upload_image);
 
  } else {
 
    $format = 'jpg';
    $_SESSION["format"] = 'jpg';
    $image_source = imagecreatefromjpeg($upload_image);
 
  }
 
  // We resample (scale down) the image source proportionally to a smaller size
  imagecopyresampled($thumb, $image_source, 0,0,0,0, $thumb_width, $thumb_height, $width, $height);
 
  if ($format == 'png') {
 
    imagesavealpha($thumb, true);
    imagepng($thumb, $thumbnail_image, 9);
 
  } else if ($format == 'git') {
 
    imagegif($thumb, $thumbnail_image, 100);
 
  } else if ($format == 'jpg') {
 
    imagejpeg($thumb, $thumbnail_image, 100);
   
  } else {
 
    imagejpeg($thumb, $thumbnail_image, 100);
 
  }
}
 
?>
