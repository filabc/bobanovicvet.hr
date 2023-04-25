<?php
session_start();

if (isset($_SESSION["id_korisnika"])){
}
else{
    header("Location: index.php");
    die();
}
include "../connection.php";

if(isset($_GET['getData'])){
    $sql = "SELECT * FROM obavijesti WHERE obavijest_id =".$_POST['id'];
    $result = $conn->query($sql);
    
    if($result){
        echo json_encode($result->fetch_assoc());
    }
}

if(isset($_GET['insertData'])){

    $target_file="";
    // var_dump($_FILES["file"]["name"]); die();
    if(!empty($_FILES["file"]["name"])){
        $target_dir = "/slike/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]["url"]);
        // var_dump($_FILES["file"]); die();
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]["url"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo json_encode("File is not an image.");
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if(file_exists('..'.$target_file)){
            $increment = 0;
            list($name, $ext) = explode('.', $target_file);
            while(file_exists('..'.$target_file)) {
                $increment++;
                // $target_file is now "userpics/example1.jpg"
                $target_file = $name.' ('. $increment.').' . $ext;
                $filename = $name.' ('. $increment.').' . $ext;
            }
        }
        
        // var_dump($_FILES["file"]); die();
        // Check file size
        if ($_FILES["file"]["size"]["url"] > 50000000) {
            echo json_encode("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        // var_dump($imageFileType); die();
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "txt" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp" ) {
            echo json_encode("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo json_encode("Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"]["url"], "..".$target_file)) {
                $img_success = 200;
            } else {
                echo json_encode("The file could not be uploaded");
             }
        }
        
         $unos = "INSERT INTO obavijesti (naslov, tekst, kratki_tekst, url, datum, aktivan) 
        VALUES('".$_POST["naslov"]."','". $_POST["tekst"]."','". $_POST["kratki_tekst"]."','$target_file','". 
        date('Y-m-d')."', 1)";
        
        if ($conn->query($unos) === TRUE) {
            echo json_encode(["img_success" => $img_success, "create_success" => 200]);
        
        } else {
            echo json_encode(["img_success" => $img_success, "create_success" => 500]);
        }
    
    }else{
         $unos = "INSERT INTO obavijesti (naslov, tekst, kratki_tekst, datum, aktivan) 
        VALUES('".$_POST["naslov"]."','". $_POST["tekst"]."','". $_POST["kratki_tekst"]."','". 
        date('Y-m-d')."', 1)";
        
        if ($conn->query($unos) === TRUE) {
            echo json_encode(["img_success" => $img_success, "create_success" => 200]);
        
        } else {
            echo json_encode(["img_success" => $img_success, "create_success" => 500]);
        }
    }
    

}

if(isset($_GET['updateData'])){

    $target_file="";
    // var_dump($_FILES); die();
    if(!empty($_FILES["url"]["name"])){
        $target_dir = "/slike/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]["url"]);
        // var_dump($_FILES["file"]); die();
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["file"]["tmp_name"]["url"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo json_encode("File is not an image.");
                $uploadOk = 0;
            }
        }
        // Check if file already exists
        if(file_exists('..'.$target_file)){
            $increment = 0;
            list($name, $ext) = explode('.', $target_file);
            while(file_exists('..'.$target_file)) {
                $increment++;
                // $target_file is now "userpics/example1.jpg"
                $target_file = $name.' ('. $increment.').' . $ext;
                $filename = $name.' ('. $increment.').' . $ext;
            }
        }
        
        // var_dump($_FILES["file"]); die();
        // Check file size
        if ($_FILES["file"]["size"]["url"] > 50000000) {
            echo json_encode("Sorry, your file is too large.");
            $uploadOk = 0;
        }
        // Allow certain file formats
        // var_dump($imageFileType); die();
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "txt" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType != "webp" ) {
            echo json_encode("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo json_encode("Sorry, your file was not uploaded.");
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"]["url"], "..".$target_file)) {
                $img_success = 200;
            } else {
                echo json_encode("The file could not be uploaded");
             }
        }
        
        $unos = "UPDATE obavijesti SET naslov = '".$_POST["naslov"]."', tekst = '". $_POST["tekst"]."', kratki_tekst = '". $_POST["kratki_tekst"]."', url = '$target_file' WHERE obavijest_id =".$_POST['id'];
        
        if ($conn->query($unos) === TRUE) {
            echo json_encode(["img_success" => $img_success, "create_success" => 200]);
        
        } else {
            echo json_encode(["img_success" => $img_success, "create_success" => 500]);
        }
    
    }else{
        $unos = "UPDATE obavijesti SET naslov = '".$_POST["naslov"]."', tekst = '". $_POST["tekst"]."', kratki_tekst = '". $_POST["kratki_tekst"]."' WHERE obavijest_id =".$_POST['id'];
        
        if ($conn->query($unos) === TRUE) {
            echo json_encode(["img_success" => $img_success, "create_success" => 200]);
        
        } else {
            echo json_encode(["img_success" => $img_success, "create_success" => 500]);
        }
    }
    

}


if(isset($_GET['deleteData'])){
    $sql = "UPDATE obavijesti SET aktivan=0 WHERE obavijest_id =".$_POST['id'];
    $result = $conn->query($sql);
    
    if($result){
        echo json_encode(["delete_success" => 200]);
    }
}