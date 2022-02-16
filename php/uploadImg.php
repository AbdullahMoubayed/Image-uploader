<?php


function uploadImg($img_name, $thumb_name, $desc) {
  require_once "config.php";

  $sql = "INSERT INTO images (image_name, thumbnail_name, description) VALUES (?, ?, ?);";

  if($stmt = mysqli_prepare($link, $sql)) {

    mysqli_stmt_bind_param($stmt, "sss", $image_name, $thumbnail_name, $description);

    $image_name = $img_name; $thumbnail_name = $thumb_name;  $description = $desc;
    mysqli_stmt_execute($stmt);

    echo "informationen uppladdades!";

    mysqli_stmt_close($stmt);
    mysqli_close($link);

  } else {

    echo "Fel: Vi kunde inte utföra vårt förberedda påstående: $sql" . mysqli_error($link);
  }
}

?>