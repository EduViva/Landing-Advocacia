<?php

require "../models/dbAccess.php";

date_default_timezone_set('America/Sao_Paulo');
$atualDate = date('M');
$atualAno = date('Y');

$Q_cadastros = "SELECT * FROM `cadastros`";
$Q_newsletter = "SELECT * FROM `newsletter`";
$Q_faq = "SELECT * FROM `faq`";

$return_cad = $db->query($Q_cadastros);
$return_news = $db->query($Q_newsletter);
$return_faq = $db->query($Q_faq);

echo '<link rel="stylesheet" href="./admin-style.css">';
echo '<script src="./admin-funcs.js"></script>';

/*
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
*/
?>

<!DOCTYPE html>
<html lang="pt-br" class="ls-theme-green">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Contatos cadastrados no site</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.js" crossorigin="anonymous"></script>

        <link href="http://assets.locaweb.com.br/locastyle/3.10.1/stylesheets/locastyle.css" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="navbar navbar-expand-lg navbar-light">
            <a href="../index.html" class="navbar-brand">
                <img src="../sources/Only logo transparante.png" width="52" height="52" class="d-inline-block align-top img-logo" alt="Bower">
                <h2 class="brand-name">Fantin & Imhoff</h2>
            </a>

            <span style="text-align: end; width:20%; color:white;">A página do administrador</span>

            <a href="../index.html" style="text-align: end; width:50%;">Ir para o site</a>
        </div>

        <main>
            <div class="container-fluid">
                
                <ul class="ls-tabs-nav">
                    <li class="ls-active"><a data-ls-module="tabs" href="#cadastros_cont">Cadastros</a></li>
                    <li><a data-ls-module="tabs" href="#newsletter_cont">Newsletter</a></li>
                    <li><a data-ls-module="tabs" href="#faq_cont">FAQ</a></li>
                </ul>
                
                <div class="ls-tabs-container">
                    
                    <div id="cadastros_cont" class="ls-tab-content ls-active">
                        
                        <table class="ls-table ls-no-hover ls-table-striped">

                            <thead>
                                <tr>
                                    <th style="width: 25%;">Nome</th>
                                    <th class="hidden-xs" style="width: 25%;">Telefone</th>
                                    <th style="width: 45%;">Mensagem</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($return_cad as $key => $value) {
                                        echo "<tr id=row-cadastros-" . $value['id'] . "><td id=cad-nome-" . $value['id'] . ">" . $value['nome'] . "</td>";
                                        echo "<td id=cad-tel-" . $value['id'] . " class='hidden-xs'>" . $value['telefone'] . "</td>";
                                        echo "<td id=cad-msg-" . $value['id'] . ">" . $value['mensagem'] . "</td>";
                                        echo "<td id=cad-excluir-" . $value['id'] . "><span onclick = excluir(" . $value['id'] . ",\"cadastros\") class=\"ls-ico-remove ls-cursor-pointer ls-btn-dark\" title=\"Excluir\"></span></td>";  
                                    }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    
                    <div id="newsletter_cont" class="ls-tab-content">
                        
                        <table class="ls-table ls-no-hover ls-table-striped">

                            <thead>
                                <tr>
                                    <th style="width: 47.5%;">E-mail</th>
                                    <th class="hidden-xs" style="width: 47.5%;">E-mail automático enviado</th>
                                    <th style="width: 5%;"></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    foreach ($return_news as $key => $value) {
                                        echo "<tr id=row-newsletter-" . $value['id'] . "><td id=news-email-" . $value['id'] . ">" . $value['email'] . "</td>";
                                        echo "<td id=news-enviado-" . $value['id'] . " class='hidden-xs'>" . $value['enviado'] . "</td>";
                                        echo "<td id=news-excluir-" . $value['id'] . "><span onclick = excluir(" . $value['id'] . ",\"newsletter\") class=\"ls-ico-remove ls-cursor-pointer ls-btn-dark\" title=\"Excluir\"></span></td>";        
                                    }
                                ?>

                            </tbody>
                        </table>

                    </div>
                    
                    <div id="faq_cont" class="ls-tab-content">
                            
                        <?php
                            foreach ($return_faq as $key => $value) {
                                echo '<div class="ls-list">';
                                echo    '<header class="ls-list-header">';
                                echo        '<div class="ls-list-title col-md-9">';
                                echo            '<label for="faq-title-'.$value['id'].'" class="col-10">Título</label>';
                                echo            '<input id="faq-title-'.$value['id'].'" maxlength="65" type="text" value="'.$value['titulo'].'" class="title-faq col-10">';
                                echo            '<br>';
                                echo            '<label for="faq-content-'.$value['id'].'" class="label-content col-10">Conteúdo</label>';
                                echo            '<textarea id="faq-content-'.$value['id'].'" type="text" maxlength="500" rows="6" class="content-faq col-10">'.$value['conteudo'].'</textarea>';
                                echo        '</div>';
                                echo        '<div class="col-md-3 ls-txt-center">';
                                echo            '<a href="javascript:void(0)" onclick=salvar(' . $value["id"] . ') class="ls-btn-primary link-salvar">Salvar</a>';
                                echo        '</div>';
                                echo    '</header>';
                                echo '</div>';
                            }
                        ?>
                                
                    </div>
                
                </div>

                <div class="ls-alert-success ls-alert-fixed-bottom alert-callback alert-certo">
                    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
                    <strong>Sucesso!</strong> O item foi excluído!
                </div>

                <div class="ls-alert-danger ls-alert-fixed-bottom alert-callback alert-erro">
                    <span data-ls-module="dismiss" class="ls-dismiss">&times;</span>
                    <strong>Ops!</strong> <span class="message-error"></span>
                </div>
                
            </div>
        </main>
        <script src="http://assets.locaweb.com.br/locastyle/3.10.1/javascripts/locastyle.js" type="text/javascript"></script>
    </body>
</html>