<?php
    namespace MyProject;

    $arr = $_POST['message'];

    $nome = !(empty($arr['name'])) ? $arr['name'] : "";
    $telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
    $msg = !(empty($arr['message'])) ? $arr['message'] : "";
    $mail = !(empty($arr['mail'])) ? $arr['mail'] : "";


    //echo $nome .", ". $mail .", ". $telefone .", ". $msg;
/*
    $to = "eduardovivaa@gmail.com";
    $assunto = "Novo cadastro no site";
    $mensagem = "Ola, você recebeu um e-mail de ". $mail . $telefone;
    $mensagem += "--------------------------------------------------";
    $mensagem += $msg;
    echo mail($to,$assunto,$mensagem);
*/
    //Se salvar no banco de dados echo true se der erro no Banco de dados echo false;



/*
   //Import the PHPMailer class into the global namespace
   require("./PHPMailer-master/src/PHPMailer.php");
   require("./PHPMailer-master/src/SMTP.php");
   require("./PHPMailer-master/src/Exception.php");
   require("./PHPMailer-master/class.phpmailer.php");
   require("./PHPMailer-master/class.smtp.php");
   
   $mail = new PHPMailer();
   
   // Define que a mensagem será SMTP
   $mail->IsSMTP();
   
   // Host do servidor SMTP externo, como o SendGrid.
   $mail->Host = "smtp.gmail.com";
   
   // Autenticação | True
   $mail->SMTPAuth = true;
   
   // Usuário do servidor SMTP
   $mail->Username = 'eduardovivaa@gmail.com';
   
   // Senha da caixa postal utilizada
   $mail->Password = 'gravatai72';
   
   $mail->From = "eduardovivaa@gmail.com";
   $mail->FromName = "Eduardo Viva";
   $mail->AddAddress('eduxablaus9@gmail.com', 'Eduxx');
   
   // Define que o e-mail será enviado como HTML | True
   $mail->IsHTML(true);
   
   // Assunto da mensagem
   $mail->Subject = "Mensagem Teste";
   
   // Conteúdo no corpo da mensagem
   $mail->Body = 'Conteudo da mensagem';
   
   // Conteúdo no corpo da mensagem(texto plano)
   $mail->AltBody = 'Conteudo da mensagem em texto plano';
   
   //Envio da Mensagem
   $enviado = $mail->Send();
   
   $mail->ClearAllRecipients();
   
   if ($enviado) {
     echo "E-mail enviado com sucesso!";
   } else {
     echo "Não foi possível enviar o e-mail.";
     echo "Motivo do erro: " . $mail->ErrorInfo;
   }
   */

   /**
     * This example shows settings to use when sending via Google's Gmail servers.
     * The IMAP section shows how to save this message to the 'Sent Mail' folder using IMAP commands.
    */

    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('America/Sao_Paulo');

    require './PHPMailer-master/PHPMailerAutoload.php';
    use PHPMailer\PHPMailer\PHPMailer;
    
    //Create a new PHPMailer instance
    $mail = new PHPMailer;

    //Tell PHPMailer to use SMTP
    $mail->isSMTP();

    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 2;

    //Ask for HTML-friendly debug output
    $mail->Debugoutput = 'html';

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';
    // use
    // $mail->Host = gethostbyname('smtp.gmail.com');
    // if your network does not support SMTP over IPv6

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Username to use for SMTP authentication - use full email address for gmail
    $mail->Username = "eduardovivaa@gmail.com";

    //Password to use for SMTP authentication
    $mail->Password = "gravatai72";

    //Set who the message is to be sent from
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
        //Section 2: IMAP
        //Uncomment these to save your message in the 'Sent Mail' folder.
        #if (save_mail($mail)) {
        #    echo "Message saved!";
        #}
    }

    //Section 2: IMAP
    //IMAP commands requires the PHP IMAP Extension, found at: https://php.net/manual/en/imap.setup.php
    //Function to call which uses the PHP imap_*() functions to save messages: https://php.net/manual/en/book.imap.php
    //You can use imap_getmailboxes($imapStream, '/imap/ssl') to get a list of available folders or labels, this can
    //be useful if you are trying to get this working on a non-Gmail IMAP server.
    /*function save_mail($mail) {
        //You can change 'Sent Mail' to any other folder or tag
        $path = "{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail";

        //Tell your server to open an IMAP connection using the same username and password as you used for SMTP
        $imapStream = imap_open($path, $mail->Username, $mail->Password);

        $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
        imap_close($imapStream);

        return $result;
    }
*/

?>