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



   // Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
include "PHPMailer-master/PHPMailerAutoload.php"; 
 
// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 
 
// Método de envio 
$mail->IsSMTP(); 
 
// Enviar por SMTP 
$mail->Host = "site-advocacia.herokuapp.com"; 
 
// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
$mail->Port = 587; 
 
 
// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true; 
 
// Usuário do servidor SMTP (endereço de email) 
// obs: Use a mesma senha da sua conta de email 
$mail->Username = 'eduardovivaa@gmail.com'; 
$mail->Password = 'gravatai72'; 
 
// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
$mail->SMTPDebug = 2; 
 
// Define o remetente 
// Seu e-mail 
$mail->From = "eduardovivaa@gmail.com"; 
// Seu nome 
$mail->FromName = "Eduardo"; 
 
// Define o(s) destinatário(s) 
$mail->AddAddress('eduxablaus9@gmail.com', 'Eduardo'); 
 
// Definir se o e-mail é em formato HTML ou texto plano 
// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
$mail->IsHTML(true); 
 
// Charset (opcional) 
$mail->CharSet = 'UTF-8'; 
 
// Assunto da mensagem 
$mail->Subject = "Assunto da mensagem"; 
 
// Corpo do email 
$mail->Body = 'Aqui entra o conteudo texto do email'; 

// Envia o e-mail 
$enviado = $mail->Send(); 
 
// Exibe uma mensagem de resultado 
if ($enviado) { 
    echo "Seu email foi enviado com sucesso!"; 
} else { 
    echo "Houve um erro enviando o email: ".$mail->ErrorInfo; 
} 

?>