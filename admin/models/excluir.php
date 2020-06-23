<?php

    require "../../models/dbAccess.php";

    $valor = $_POST['id'];
    $table = $_POST['table'];

    $sql = "DELETE FROM `" . $table . "` WHERE `id` =". $valor;

    if($db->query($sql)){
        echo true;
    } else {
        echo false;
    }

?>