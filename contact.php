<?php

header('Content-Type: text/html; charset=utf-8');

$arr = $_POST['message'];



$nome = $arr['name'];
$telefone = $arr['telefone'];
$msg = $arr['message'];

echo true;

//Se salvar no banco de dados echo true se der erro no Banco de dados echo false;

?>