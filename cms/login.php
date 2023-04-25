<?php
include "../connection.php";
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$var = "SELECT * FROM korisnik WHERE username =  '".$username."'";

$result = mysqli_query($conn, $var);
$redak = mysqli_fetch_assoc($result);
if (!password_verify($password, $redak["password"])) {
    header("Location: index.php?error=true");
    die();
}else{
    session_start();
    $id = $redak['id_korisnika'];
    $_SESSION["id_korisnika"] = $id;
    header("Location: cms.php");
    die();
}
