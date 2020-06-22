<?php

require "../models/dbAccess.php";

date_default_timezone_set('America/Sao_Paulo');
$atualDate = date('M');
$atualAno = date('Y');

$Q_cadastros = "SELECT * FROM `cadastros`";
$Q_newsletter = "SELECT * FROM `newsletter`";

$return_cad = $db->query($Q_cadastros);
$return_news = $db->query($Q_newsletter);

$total_cad = $db->query("SELECT COUNT(*) FROM cadastros");
$total_news = $db->query("SELECT COUNT(*) FROM newsletter");

if($total_cad){
  while ($row = $total_cad->fetch_assoc()) {
    $cad_num = $row['COUNT(*)'];
  }
}
if($total_news){
    while ($row = $total_news->fetch_assoc()) {
        $news_num = $row['COUNT(*)'];
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contatos cadastrados no site</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="admin-style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>

        <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="navbar navbar-expand-lg navbar-light">
            <a href="../index.html" class="navbar-brand">
                <img src="../sources/Only logo transparante.png" width="52" height="52" class="d-inline-block align-top img-logo" alt="Bower">
                <h2 class="brand-name">Fantin & Imhoff</h2>
            </a>

            <small style="text-align: end; width:20%;">A página do administrador</small>

            <a href="../index.html" style="text-align: end; width:50%;">Ir para o site</a>
        </div>

        <main>
            <div class="container-fluid">
                <table class="ls-table ls-no-hover ls-table-striped">

                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th class="hidden-xs">Telefone</th>
                            <th>Mensagem</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($return_cad as $key => $value) {
                                echo "<tr id=" . $value['id'] . "><td id=nome" . $value['id'] . ">" . $value['nome'] . "</td>";
                                echo "<td id=telefone" . $value['id'] . " class='hidden-xs'>" . $value['telefone'] . "</td>";
                                echo "<td id=mensagem" . $value['id'] . ">" . $value['mensagem'] . "</td>";
                                echo "<td id=excluir" . $value['id'] . "><span style='margin-left: -85px' onclick = excluir(" . $value['id'] . ",\"brindes\") class=\"ls-ico-remove ls-cursor-pointer ls-btn-dark\" title=\"Excluir\"></span></td>";
                                
                            }
                        ?>

                    </tbody>
                </table>

                <embed height="1" type="audio/midi" width="1" src="../controllers/Alarm.mp3" loop="false" autostart="true" />
            
            </div>
        </main>
        <script src="http://assets.locaweb.com.br/locastyle/3.10.1/javascripts/locastyle.js" type="text/javascript"></script>
    </body>
</html>