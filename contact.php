<?php

header('Content-Type: text/html; charset=utf-8');

$arr = $_POST['message'];



$nome = !(empty($arr['name'])) ? $arr['name'] : "";
$telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
$msg = !(empty($arr['message'])) ? $arr['message'] : "";
$mail = !(empty($arr['mail'])) ? $arr['mail'] : "";

if($mail != ""){

    ini_set("smtp_port","80");

    $from = 'eduardovivaa@gmail.com';

    $headers = "From: $from\r\n".
    "Content-type: text/plain; charset=UTF-8" . "\r\n";
    
    $subject = "NewsLetter de Fantin e Imhoff Adovogados";

    $body = "Olá " . $mail . "!\n".
    "Agradecemos por ter se cadastrado\n na NewsLetter.\n".
    "Você ficará por dentro das novidades\n do ramo advocatício.\n".
    "Caso tenha dúvidas pode entrar\n em contato pelo site\n".
    "Ou pelo número (51)99986-5349\n no Whatsapp ou Telegram";

    $body = wordwrap($body,70);
    echo $body;
    $success = mail($mail,$subject,$body,$headers);
    if (!$success) {
        $errorMessage = error_get_last()['message'];
        echo "Erro: ".$errorMessage;
    } else {
        echo "Sucesso: ".$success;
    }
} else {
    echo $nome.$mail.$telefone.$msg;
}

//Se salvar no banco de dados echo true se der erro no Banco de dados echo false;

?>