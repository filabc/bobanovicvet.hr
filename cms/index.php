<?php
session_start();
if (isset($_SESSION["id_korisnika"])){
  header("Location: cms.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<div class="login-container">
    <form action="login.php" method = "POST">
      <label>Username:
      <input type="text" name="username">
      </label>
      <label>Password:
      <input type="password" name="password">
      </label>
      <div class="button-label">
          <label>
          <input class="theme-button" type="submit" value="log in">
      </div>
      <?php
      if(isset($_GET['error'])){
          echo "Korisnik nije pronađen";
      }
      
      ?>
    </form>
</div>
</body>
</html>