<?php

    $arr = $_POST['message'];

    $nome = !(empty($arr['name'])) ? $arr['name'] : "";
    $telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
    $msg = !(empty($arr['message'])) ? $arr['message'] : "";
    $mail = !(empty($arr['mail'])) ? $arr['mail'] : "";


    //echo $nome .", ". $mail .", ". $telefone .", ". $msg;

    $to = "eduardovivaa@gmail.com";
    $assunto = "Novo cadastro no site";
    $mensagem = "Ola, você recebeu um e-mail de ". $mail . $telefone;
    $mensagem += "--------------------------------------------------";
    $mensagem += $msg;
    echo mail($to,$assunto,$mensagem);

    //Se salvar no banco de dados echo true se der erro no Banco de dados echo false;

?>