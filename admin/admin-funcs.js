var req;

function excluir(id, table){

    if (confirm("Deseja realmente deletar este cliente?")){
        
        $.ajax({
            url: './models/excluir.php',
            type: "POST",
            data: {
                'id': id,
                'table': table
            },
            cache: false,
            async: true,
              success: function(response) {
        
                console.log(response);
                
                if (response == true) {
                    document.getElementById("row-"+table+"-"+id).style.display = "none";
                    $('.alert-certo').css('display','block');
                } else {
                    $('.message-error').html('Não consegui excluir o item!');
                    $('.alert-erro').css('display','block');
                }
              }
        });

        window.setTimeout(() => {$('.alert-callback').css('display','none');}, 5500);
    }
}

function salvar(id){

    $title = $('#faq-title-'+id)[0].value;
    $content = $('#faq-content-'+id)[0].value;

    $.ajax({
        url: './models/salvar.php',
        type: "POST",
        data: {
            'id': id,
            'title': $title,
            'content': $content
        },
        cache: false,
        async: true,
            success: function(response) {
    
                console.log(response);
                
                if (response == true) {
                    $('.alert-certo').css('display','block');
                } else {
                    $('.message-error').html('Não consegui salvar o item!');
                    $('.alert-erro').css('display','block');
                }
            }
    });

    window.setTimeout(() => {$('.alert-callback').css('display','none');}, 5500);

}

function addField(){
    /*echo '<div class="ls-list">';
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
    echo '</div>';*/

    let pai = $('#faq_cont');
    let geral = document.createElement('div');
    let cabeça = document.createElement('header');
    let divInputs = document.createElement('div');
    let labelTitle = document.createElement('label');
    let inputTitle = document.createElement('input');
    let br = document.createElement('br');
    let labelCont = document.createElement('label');
    let textCont = document.createElement('textarea');
    let divSave = document.createElement('div');
    let save = document.createElement('a');

    geral.className = "ls-list";
    cabeça.className = "ls-list-header";
    divInputs.className = "ls-list-title col-md-9";
    labelTitle.className = "col-10";
    inputTitle.className = "title-faq col-10";
    labelCont.className = "label-content col-10";
    textCont.className = "content-faq col-10";
    divSave.className = "col-md-3 ls-txt-center";
    save.className = "ls-btn-primary link-salvar";

    let atualLists = document.getElementsByClassName('ls-list');
    let newId = atualLists[atualLists.length-1].attributes['data-id'].value + 1;

    labelTitle.htmlFor = `faq-title-${newId}`;
    labelTitle.innerHTML = "Título";

    inputTitle.id = `faq-title-${newId}`;
    inputTitle.maxLength = 65;

    labelCont = `faq-content-${newId}`;
    labelCont.innerHTML = "Conteúdo";

    textCont.id = `faq-content-${newId}`;
    textCont.maxLength = 500;
    textCont.rows = 6;

    save.onclick = salvar(newId);
    save.innerHTML = "Salvar";

    divInputs.appendChild(labelTitle);
    divInputs.appendChild(inputTitle);
    divInputs.appendChild(br);
    divInputs.appendChild(labelCont);
    divInputs.appendChild(textCont);

    divSave.appendChild(save);

    cabeça.appendChild(divInputs);
    cabeça.appendChild(divSave);

    geral.appendChild(cabeça);

    pai.appendChild(geral);
}