<?php
    use PHPMailer\PHPMailer\PHPMailer;

    require '../PHPMailer/PHPMailerAutoload.php';
    require "./dbAccess.php";

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
    
        date_default_timezone_set('America/Sao_Paulo');

        //Create a new PHPMailer instance
        $mail = new PHPMailer;

        $mail->isSMTP();
        
        $mail->Debugoutput = 'html';
        
        $mail->Host = 'smtp.umbler.com';
        $mail->Port = 587;

        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;

        $mail->Username = $mailUser;
        $mail->Password = $mailPass;

        $mail->setFrom($mailUser, 'Fantin e Imhoff Advogados');
        //Set an alternative reply-to address
        //$mail->addReplyTo('replyto@example.com', 'First Last');
        
        //Set who the message is to be sent to
        $mail->addAddress($email, 'Fantin e Imhoff');

        //Set the subject line
        $mail->Subject = 'Cadastro na newsletter de Fantin & Imhoff Advogados';

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
        $mail->Body = 'Olá! Você está cadastrado na newsletter de Fantin & Imhoff Advogados.';
        
        //Replace the plain text body with one created manually
        $mail->AltBody = 'Olá! Você está cadastrado na newsletter de Fantin & Imhoff Advogados.';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        $ret = $mail->send();
        echo $ret;
        if (!$ret) {
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