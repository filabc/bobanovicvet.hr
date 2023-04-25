<?php
session_start();
if (isset($_SESSION["id_korisnika"])){
}
else{
    header("Location: index.php");
    die();
}
include "../connection.php";

$clanak = null;
if(!empty($_GET) && isset($_GET['id']) && is_int(intval($_GET['id']))){
  $sql = "SELECT * FROM obavijest WHERE obavijest_id = " . $_GET['id'] . ";";

  $result = mysqli_query($conn, $sql);
  $rowcount=mysqli_num_rows($result);
  $clanak = mysqli_fetch_assoc($result);

}

?>

<!DOCTYPE html>
<html>
<body>

<h2>Forma za unos obavijesti</h2>

<form action="<?php echo !$clanak ? 'unos_handler.php' : 'update_handler.php'; ?>" method="POST" enctype="multipart/form-data">
  Naslov obavijesti:<br>
  <input type="text" name="obavijest_naslov" value="<?php echo $clanak ? $clanak['obavijest_naslov'] : ''; ?>">
  <br>
  Tekst obavijesti:<br>
  <input type="text" name="obavijest_tekst" value="<?php echo $clanak ? $clanak['obavijest_tekst'] : ''; ?>">
  <br>
  Kratki tekst obavijesti:<br>
  <input type="text" name="obavijest_kratkitekst" value="<?php echo $clanak ? $clanak['obavijest_kratkitekst'] : ''; ?>">
  <br>
  Slika:<br>
  <input type="file" name="obavijest_slika" value="">
  <br>
  Datum:<br>
  <input type="date" name="obavijest_datum" value="<?php echo $clanak ? $clanak['obavijest_datum'] : ''; ?>">
  <br>
  <?php 
  if($clanak){
    ?>
    <input type="hidden" name="obavijest_id" value="<?php echo $_GET['id']; ?>">
    <?php
  }
  ?>
  <input type="submit" value="Unos">
  
  
</form> 

</body>
</html>