<?php
    
    header('Content-Type: text/html; charset=utf-8');
    //$db = new mysqli("mysql380.umbler.com", "##", "##", "clientes-adv");
    $db = new mysqli("localhost", "root", "", "clientes-adv");

    $db->query("SET NAMES 'utf8'");
    $db->query('SET character_set_connection=utf8');
    $db->query('SET character_set_client=utf8');
    $db->query('SET character_set_results=utf8');

?>