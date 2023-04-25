<?php
session_start();
$target_file="";

if (isset($_SESSION["id_korisnika"])){
}
else{
    header("Location: index.php");
    die();
}
include "../connection.php";




$update = "UPDATE obavijest SET 
obavijest_naslov = '".$_POST["obavijest_naslov"]."',
obavijest_tekst = '". $_POST["obavijest_tekst"]."',
obavijest_kratkitekst = '". $_POST["obavijest_kratkitekst"]."',
obavijest_slika = '". $_POST["obavijest_slika"]."',
obavijest_datum = '".$_POST["obavijest_datum"]."' WHERE obavijest_id = " . $_POST['obavijest_id'] . ";";


if ($conn->query($update) === TRUE) {
    echo "New record created successfully";
    header("Location: cms.php");

} else {
    echo "Error: " . $unos . "<br>" . $conn->error;
}





