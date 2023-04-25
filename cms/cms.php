<?php
session_start();
if (isset($_SESSION["id_korisnika"])){
}
else{
    header("Location: index.php");
    die();
}
include "../connection.php";
$id = $_SESSION["id_korisnika"];
$var = "SELECT * FROM korisnik WHERE id_korisnika='".$id."'";
$result = mysqli_query($conn, $var);
$redak = mysqli_fetch_assoc($result);
$ime = $redak["ime_korisnika"];
$sql = "SELECT * FROM obavijesti WHERE aktivan = 1";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="hr">
<head><meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="icon" href="../cat.png">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/main2.css" id="color-switcher-link">
	<link rel="stylesheet" href="../css/animations.css">
	<link rel="stylesheet" href="../css/fonts.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/sweetalert2.min.css">
	<link rel="stylesheet" type="text/css" href="css/simditor.css" />
	<script src="../js/vendor/jquery-3.1.0.min.js"></script>
	<script async defer src="../js/vendor/bootstrap.min.js"></script>
	<script async defer src="js/sweetalert2.min.js"></script>
	<script type="text/javascript" src="js/module.js"></script>
    <script type="text/javascript" src="js/hotkeys.js"></script>
    <script type="text/javascript" src="js/uploader.js"></script>
    <script type="text/javascript" src="js/simditor.js"></script>
</head>
<body>
<div class="c">
    <h3>Korisnik: <?php echo $ime;?></h3>
    <a class="theme-button" href="logout.php">Odjavi se</a>
</div>
<div class="container cms-container">
    <a class="link-with-icon" data-toggle="modal" data-target="#unosModal"> <i class="material-icons">post_add</i> </a>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
          <tr>
            <th>Naslov</th>
            <th>Kratki tekst</th>
            <th>Tekst</th>
            <th>Slika</th>
            <th>Izmijeni</th>
            <th>Izbriši</th>
          </tr>
          <?php
        		while($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row["naslov"]?></td>
                        <td><?php echo $row["kratki_tekst"]?></td>
                        <td><?php echo $row["tekst"]?></td>
                        <td class="image-cell"><?php echo '<img src="'.$row["url"].'" alt="" />'?></td>
                        <td class="control">
                          <a data-id="<?= $row["obavijest_id"]; ?>" data-toggle="modal" data-target="#izmijeniModal"> <i class="material-icons">edit</i> </a>
                        </td>
                        <td class="control">
                           <a class="delete" data-id="<?= $row["obavijest_id"]; ?>"> <i class="material-icons">delete_forever</i> </a>
                        </td>
                    </tr>
        		<?php	} ?>
          
        </table>
    </div>
</div>

<div id="unosModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="unosModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="unosModalLabel">Forma za unos obavijesti</h4>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
              Naslov obavijesti:<br>
              <div>
              <input type="text" name="naslov" value="">
              </div>
              <br>
              Tekst obavijesti:<br>
              <div>
              <textarea id="unos_tekst" rows="6" name="tekst"></textarea>
              </div>
              <br>
              Kratki tekst obavijesti:<br>
              <div>
              <textarea id="unos_tekst_kratki" rows="4" name="kratki_tekst"></textarea>
              </div>
              <br>
              Slika:<br>
              <input type="file" name="url" value="">
            </form> 
          </div>
          <div class="modal-footer">
            <button type="button" class="theme-button inverse" data-dismiss="modal">Zatvori</button>
            <button type="button" class="theme-button submit">Spremi</button>
          </div>
        </div>
    
    </div>
</div>

<div id="izmijeniModal" class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="izmijeniModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="izmijeniModalLabel">Forma za unos obavijesti</h4>
          </div>
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data">
              Naslov obavijesti:<br>
              <input type="text" name="naslov" value="" />
              <br>
              Tekst obavijesti:<br>
              <textarea id="izmjena_tekst" rows="6" name="tekst"></textarea>
              <br>
              Kratki tekst obavijesti:<br>
              <textarea id="izmjena_tekst_kratki" rows="4" name="kratki_tekst"></textarea>
              <br>
              Slika:<br>
              <input type="file" name="url" value="" />
              <img class="url_image" src="" alt="" />
              <br>
              <input type="hidden" name="id" value="">
            </form> 
          </div>
          <div class="modal-footer">
            <button type="button" class="theme-button inverse" data-dismiss="modal">Zatvori</button>
            <button type="button" class="theme-button submit">Izmijeni</button>
          </div>
        </div>
    
    </div>
</div>
</body>
<script src="../js/vendor/jquery-ui.min.js">

$('#unosModal, #izmijeniModal').modal({
    backdrop: 'static'
}).modal('hide');
$('#unosModal').on('shown.bs.modal', function () {
  $('input[name="obavijest_naslov"]').focus()
})

</script>

<script>

$('#izmijeniModal').on('show.bs.modal', function(event){
  var button = $(event.relatedTarget);
  var id = button.data('id');
  
  var naslov = $(this).find('input[name="naslov"]'),
  kratki_tekst = $(this).find('textarea[name="kratki_tekst"]').siblings('.simditor-body'),
  tekst = $(this).find('textarea[name="tekst"]').siblings('.simditor-body'),
  url = $(this).find('input[name="url"]'),
  url_img = $(this).find('img[class="url_image"]'),
  obavijest_id = $(this).find('input[name="id"]');
  
  $.ajax({
    url: "ajax.php?getData=1",
    dataType: 'json',
    type: 'POST',
    data: {'id': id},
    }).done(function (response, status) {
        obavijest_id.val(response.obavijest_id);
        naslov.val(response.naslov);
        tekst.html(response.tekst);
        kratki_tekst.html(response.kratki_tekst);
        url_img.attr('src', ''+response.url+'')
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log('AJAX error:' + textStatus);
    });
});

$('#unosModal, #izmijeniModal').on('hide.bs.modal', function (e) {
    $(this).find("input").val("");
    $(this).find('textarea').text("");
    $(this).find("img").attr('src', '');
    
});

$('#unosModal .submit').on('click', function(){
    var naslov = $('#unosModal').find('input[name="naslov"]'),
    kratki_tekst = $('#unosModal').find('textarea[name="kratki_tekst"]'),
    tekst = $('#unosModal').find('textarea[name="tekst"]');
    naslov.removeClass('error');
    kratki_tekst.removeClass('error');
    tekst.removeClass('error');
    $('.error-msg').remove();
    console.log(naslov.val().trim() == "", kratki_tekst.val().trim() == "", tekst.val().trim() == "");
    if(naslov.val().trim() == "" || kratki_tekst.val().trim() == "" || tekst.val().trim() == ""){
        if(naslov.val().trim() == ""){
            naslov.addClass("error");
            naslov.parent().append($('<div class="error-msg">Ovo je polje obavezno</div>'));
        }
        if(kratki_tekst.val().trim() == ""){
            kratki_tekst.addClass("error");
            kratki_tekst.parent().append($('<div class="error-msg">Ovo je polje obavezno</div>'));
        }
        if(tekst.val().trim() == ""){
            tekst.addClass("error");
            tekst.parent().append($('<div class="error-msg">Ovo je polje obavezno</div>'));
        }
        return false;
    }
    var data = new FormData($("#unosModal form")[0]);
    data.append('file[url]', $('#unosModal input[type="file"]')[0].files[0]);
    $.ajax({
        url: "ajax.php?insertData=1",
        contentType: false,
        processData: false,
        type: 'POST',
        data: data,
    }).done(function (response, status) {
        response = JSON.parse(response);
        if(response.create_success == 200){
            Swal.fire({
              toast: true,
              position: 'top-end',
              background: "#66cc91",
              showConfirmButton: false,
              customClass:{
               container: 'success'   
              },
              title: 'Uspjeh!',
              text: 'Obavijest uspješno spremljena',
              icon: 'success',
            })
            setTimeout(function(){
                window.location.href="cms.php"
            }, 1000);
            
        }
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log('AJAX error:' + textStatus);
    });
});

$('#izmijeniModal .submit').on('click', function(){
    var data = new FormData($("#izmijeniModal form")[0]);
    data.append('file[url]', $('#izmijeniModal input[type="file"]')[0].files[0]);
    $.ajax({
        url: "ajax.php?updateData=1",
        contentType: false,
        processData: false,
        type: 'POST',
        data: data,
    }).done(function (response, status) {
        response = JSON.parse(response);
        if(response.create_success == 200){
            Swal.fire({
              toast: true,
              position: 'top-end',
              background: "#66cc91",
              showConfirmButton: false,
              customClass:{
               container: 'success'   
              },
              title: 'Uspjeh!',
              text: 'Obavijest uspješno izmijenjena',
              icon: 'success',
            })
            setTimeout(function(){
                window.location.href="cms.php"
            }, 1000);
            
        }
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log('AJAX error:' + textStatus);
    });
});

$('.delete').on('click', function(){
    $.ajax({
        url: "ajax.php?deleteData=1",
        type: 'POST',
        data: {'id' : $(this).attr('data-id')},
    }).done(function (response, status) {
        response = JSON.parse(response);
        if(response.delete_success == 200){
            Swal.fire({
              toast: true,
              position: 'top-end',
              background: "#66cc91",
              showConfirmButton: false,
              customClass:{
               container: 'success'   
              },
              title: 'Uspjeh!',
              text: 'Obavijest uspješno izbrisana',
              icon: 'success',
            })
            setTimeout(function(){
                window.location.href="cms.php"
            }, 500);
            
        }
    }).fail(function (XMLHttpRequest, textStatus, errorThrown) {
        console.log('AJAX error:' + textStatus);
    });
});

new Simditor({textarea: $('#unos_tekst'),
defaultImager: '',
upload: false,
pasteImage: false,
cleanPaste: true,
toolbar: [
  'title',
  'bold',
  'italic',
  'underline',
  'strikethrough',
  'fontScale',
  'color',
  'ol',  
  'ul', 
  'blockquote',
  'code',  
  'table',
  'link',
  'hr',     
  'indent',
  'outdent',
  'alignment'
]
});
new Simditor({textarea: $('#unos_tekst_kratki'),
defaultImager: '',
upload: false,
pasteImage: false,
cleanPaste: true,
toolbar: [
  'title',
  'bold',
  'italic',
  'underline',
  'strikethrough',
  'fontScale',
  'color',
  'ol',  
  'ul', 
  'blockquote',
  'code',  
  'table',
  'link',
  'hr',     
  'indent',
  'outdent',
  'alignment'
]});
new Simditor({textarea: $('#izmjena_tekst'),
defaultImager: '',
upload: false,
pasteImage: false,
cleanPaste: true,
toolbar: [
  'title',
  'bold',
  'italic',
  'underline',
  'strikethrough',
  'fontScale',
  'color',
  'ol',  
  'ul', 
  'blockquote',
  'code',  
  'table',
  'link',
  'hr',     
  'indent',
  'outdent',
  'alignment'
]});
new Simditor({textarea: $('#izmjena_tekst_kratki'),
defaultImager: '',
upload: false,
pasteImage: false,
cleanPaste: true,
toolbar: [
  'title',
  'bold',
  'italic',
  'underline',
  'strikethrough',
  'fontScale',
  'color',
  'ol',  
  'ul', 
  'blockquote',
  'code',  
  'table',
  'link',
  'hr',     
  'indent',
  'outdent',
  'alignment'
]});
</script>
</html>



