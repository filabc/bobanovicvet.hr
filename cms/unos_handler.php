<?php
session_start();
$target_file="";

if(!empty($_FILES)){
    // var_dump($_FILES['slika']);
    $target_dir = "slike/";
    $target_file = $target_dir . basename($_FILES["slika"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["slika"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["slika"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "txt" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["slika"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["slika"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }


}else{
    echo "nema unosa fileaova";
}

if (isset($_SESSION["id_korisnika"])){
}
else{
    header("Location: index.php");
    die();
}
include "../connection.php";


$unos = "INSERT INTO obavijest (obavijest_naslov, obavijest_tekst, obavijest_kratkitekst, obavijest_slika, obavijest_datum, vidljiv) 
VALUES('".$_POST["obavijest_naslov"]."','". $_POST["obavijest_tekst"]."','". $_POST["obavijest_kratkitekst"]."','. $target_file.','". 
$_POST["obavijest_datum"]."', 1)";

if ($conn->query($unos) === TRUE) {
    echo "New record created successfully";
    header("Location: cms.php");

} else {
    echo "Error: " . $unos . "<br>" . $conn->error;
}





