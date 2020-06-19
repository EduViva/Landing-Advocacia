<?php
    
    include "./dbAccess.php";

    $arr = $_POST['message'];

    $nome = !(empty($arr['name'])) ? $arr['name'] : "";
    $telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
    $msg = !(empty($arr['message'])) ? $arr['message'] : "";
    $mail = !(empty($arr['mail'])) ? $arr['mail'] : "";
    $local = $arr['local'];

    if($local == 'news'){
        $query = "INSERT INTO `newsletter`(email) VALUES ('" . $mail ."')";
    } else {
        $query = "INSERT INTO `cadastros`(nome, telefone, mensagem) VALUES 
        ('" . $nome ."','" . $telefone ."','" . $msg ."')";
    }

    $return = $db->query($query);

    if($return){
        echo mysqli_insert_id($db);
    } else {
        echo false;
    }

/*
    date_default_timezone_set('America/Sao_Paulo');

    require './PHPMailer-master/PHPMailerAutoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    $mail->isSMTP();
    
    $mail->Debugoutput = 'html';
    
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;

    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;

    $mail->Username = "eduardovivaa@gmail.com";
    $mail->Password = "gravatai72";

    $mail->setFrom('eduardovivaa@gmail.com', 'Eduardo Viva');
    //Set an alternative reply-to address
    //$mail->addReplyTo('replyto@example.com', 'First Last');
    
    //Set who the message is to be sent to
    $mail->addAddress('eduxablaus9@gmail.com', 'XblDu');

    //Set the subject line
    $mail->Subject = 'PHPMailer GMail SMTP test';

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    //$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
    $mail->Body = "Ola";
    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    //$mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message sent!";
    }

*/
?>