<?php

    require './dbAccess.php';

    date_default_timezone_set('America/Sao_Paulo');

    $arr = $_POST['message'];

    $nome = !(empty($arr['name'])) ? $arr['name'] : "";
    $telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
    $msg = !(empty($arr['message'])) ? $arr['message'] : "";
    $email = !(empty($arr['mail'])) ? $arr['mail'] : "";
    $local = $arr['local'];

    if($local == 'news'){
        $query = "INSERT INTO `newsletter`(email) VALUES ('" . $email ."')";
    } else {
        $query = "INSERT INTO `cadastros`(nome, telefone, mensagem) VALUES 
        ('" . $nome ."','" . $telefone ."','" . $msg ."')";
    }

    $return = $db->query($query);
    $lastId = mysqli_insert_id($db); 

    if($return){
        echo mysqli_insert_id($db);
    } else {
        echo false;
    }

    if($local == 'news'){
    
        $myEmail = $mailUser;//é necessário informar um e-mail do próprio domínio
        $headers = "From: $myEmail\r\n";
        $headers .= "Reply-To: $myEmail\r\n";

        /*abaixo contém os dados que serão enviados para o email
        cadastrado para receber o formulário*/
        $subject = "Um novo contato foi cadastrado no site";

        $corpo = "Olá!\n";
        $corpo .= "\n";
        $corpo .= "Seja bem Vindo.\n";
        $corpo .= "\n";
        $corpo .= "Você está cadastrado na newsletter de Fantin & Imhoff Advogados\n";
    
        $email_to = $email;
        //não esqueça de substituir este email pelo seu.

        $status = mail($email_to, $subject, $corpo, $headers);
        //enviando o email.
        
        echo $status;
        if (!$status) {
           $sql = "UPDATE `newsletter` SET enviado = 'Não' WHERE id = '". $lastId . "'";
        } else {
            $sql = "UPDATE `newsletter` SET enviado = 'Sim' WHERE id = '". $lastId . "'";
        }

        $db->query($sql);
    }

    ///////////////////////////////////////////
    //Enviando o e-mail para o administrador//
    //////////////////////////////////////////

    $myEmail = $mailUser;//é necessário informar um e-mail do próprio domínio
    $headers = "From: $myEmail\r\n";
    $headers .= "Reply-To: $myEmail\r\n";
    //endereços que receberão uma copia oculta
    //$headers .= "Bcc: vinnie@criarweb.com,joao@criarweb.com";

    /*abaixo contém os dados que serão enviados para o email
    cadastrado para receber o formulário*/
    $subject = "Um novo contato foi cadastrado no site";

    $corpo = "Olá, um novo contato foi cadastrado no site\n";
    $corpo .= "Nome: " . $nome . "\n";
    $corpo .= "Telefone: " . $telefone . "\n";
    $corpo .= "Email: " . $email . "\n";
    $corpo .= "Mensagem: " . $msg . "\n";

    $email_to = $mailUser;
    //não esqueça de substituir este email pelo seu.

    $status = mail($email_to, $subject, $corpo, $headers);
    //enviando o email.

?>