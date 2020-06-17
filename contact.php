<?php

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




   //Import the PHPMailer class into the global namespace
   require("PHPMailer/PHPMailer.php");
   require("PHPMailer/SMTP.php");
   require("PHPMailer/Exception.php");
   
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
   

?>