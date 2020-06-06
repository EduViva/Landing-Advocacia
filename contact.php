<?php

header('Content-Type: text/html; charset=utf-8');

$arr = $_POST['message'];



$nome = !(empty($arr['name'])) ? $arr['name'] : "";
$telefone = !(empty($arr['telefone'])) ? $arr['telefone'] : "";
$msg = !(empty($arr['message'])) ? $arr['message'] : "";
$mail = !(empty($arr['mail'])) ? $arr['mail'] : "";

echo $nome . ", " . $telefone . ", " . $msg . ", " . $mail;

//Se salvar no banco de dados echo true se der erro no Banco de dados echo false;

?>