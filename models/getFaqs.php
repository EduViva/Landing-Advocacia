<?php

    require "./dbAccess.php";

    $sql = "SELECT * FROM `faq`";

    $return = $db->query($sql); 

    if($return){
        foreach ($return as $key => $value) {
            echo $value['id'] . "," . $value['titulo'] . "," . $value['conteudo'] . "#.#";
        }
    } else {
        echo false;
    }

?>