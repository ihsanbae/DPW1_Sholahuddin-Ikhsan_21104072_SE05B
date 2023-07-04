<?php

session_start();

if (isset($_SESSION['username']) && isset($_FILES['data'])){

    $file = $_FILES['data'];
    $file_name = $file['name'];
    

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($file_name);


    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
        echo "<br><a href='index.php'>Back</a>";

    } else {
        echo "Sorry, there was an error uploading your file.";
        echo "<br><a href='index.php'>Back</a>";
    }    

}