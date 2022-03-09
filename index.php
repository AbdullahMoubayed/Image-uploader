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

  <div class="result">
    
  </div>

  <form action="index.php" method="post" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
  
    <label for="comment">Namn</label>
    <input type="text" id="comment" name="comment">
    <div class="err" id="comment-err">Only letters and digits is allowed</div>
    
    <input type="submit" value="Upload Image" name="submit" >
  </form>

</section>

<script src='app.js'></script>
</body>
</html>
 
<?php
 
/*
 
          PHP Image Uploader v.0.2a
          Orginally created by w3schools.com
          Modified and iterated by: XXXXX for educational purposes
 
*/
 
require('php/thumbnail-generator.php');
require('php/uploadImg.php');

 
$comment = "";
$err = array("comment" => "", "image" => "", "file" => "");
$state = array("db" => "", "file" => "", "thumb" => "");

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  
  
  // ----------------------------- Comment -----------------------------
  
  if (empty($_GET['comment'])) {
    $err['comment'] = 'A comment is required';
  }
  
  function sanitize_comment($comment, $err) {
    $reg = "/^[ a-z\d ]+$/i";
    $ok = false;

    if (!$err['comment']) {
      $comment = filter_var($comment, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
  
      if(preg_match($reg, $comment) && mb_check_encoding($comment, 'UTF-8')){
        $state["comment"] = "<b>$comment</b> is a valid comment";
        $ok = true;

      } else {
        $err["comment"] = "<b>$comment</b> is not a valid comment";
      }
    }

    if($ok) {
      return $comment;
    }
  }



  // ----------------------------- Image -----------------------------
 
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  $pathinfo = pathinfo($target_file, PATHINFO_EXTENSION);
 
 
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    $err["file"] =  "File is not an image.";
    $uploadOk = 0;
  }
 
 
  // Check if file already exists
  if (file_exists($target_file)) {
    $err["file"] =  "Sorry, file already exists.";
    $uploadOk = 0;
  }
  
  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 90000000) {
    $err["file"] =  "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    $err["file"] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $err["image"] =  "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $comment = sanitize_comment($_POST["comment"], $err);

      $image_name = $_FILES["fileToUpload"]["name"];
      $thumb_name = "thumb-".$_FILES["fileToUpload"]["name"];

      $state["file"] = "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

      createThumbnail(100, 100, $target_file, "uploads/". $thumb_name);
      $state["thumb"] = "Thumbnail uploaded successfully.";

      uploadImg($image_name, $thumb_name, $_POST["comment"]);
      $state["db"] = "Information saved successfully to database.";

    } else {
      $err["file"] = "Sorry, there was an error uploading your file.";
    }
  }
}

// ---------------------------------- List images -----------------------------------


?>