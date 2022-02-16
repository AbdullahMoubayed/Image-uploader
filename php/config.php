<?php
    /* Create a constent, DB_SERVER, what DB server to connect to */
    define('DB_SERVER', 'localhost');
    // Create a constane, DB_USERNAME, what username to use in DB
    define('DB_USERNAME', 'root');
    // Create a constante, DB_PASSWORD, witch password to use
    define('DB_PASSWORD', '');
    // Create s constante, DB_NAME, witch database to use
    define('DB_NAME', 'image_uploader');

    // Create boolean variable that attembt connection to DB, return true if success, false if faild.
    $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    //if the $link variable returns false it mean we faild apically to connect to the database, if this happens we thow error, mysqli_error returns exactly what went wrong.
    if($link == false) {
        die("ERROR: Could not connect.". mysqli_connect_error());
    }
?>