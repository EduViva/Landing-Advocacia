<?php

    require "../../models/dbAccess.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $behavior = $_POST['behavior'];

    if($behavior == "save"){
        $sql = "UPDATE `faq` SET `titulo`='".$title."',`conteudo`='".$content."' WHERE `id`=".$id;
    } else {
        $sql = "INSERT INTO `faq` (titulo, conteudo) VALUES ('" . $title ."','" . $content ."')";
    }

    
    if($db->query($sql)){
        echo true;
    } else {
        echo false;
    }

?>