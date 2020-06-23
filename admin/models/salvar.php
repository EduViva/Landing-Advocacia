<?php

    require "../../models/dbAccess.php";

    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE `faq` SET `titulo`='".$title."',`conteudo`='".$content."' WHERE `id`=".$id;

    if($db->query($sql)){
        echo true;
    } else {
        echo false;
    }

?>