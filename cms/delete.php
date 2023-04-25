<?php
    include "../connection.php";

    if(!empty($_GET) && isset($_GET['id']) && is_int(intval($_GET['id']))){
        $sql = "UPDATE obavijest SET vidljiv = 0 WHERE obavijest_id = " . $_GET['id'] . ";";

        mysqli_query($conn, $sql);

        header("Location: cms.php");
        die();
    }
?>