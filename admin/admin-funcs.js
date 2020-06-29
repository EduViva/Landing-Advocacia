var req;
var created = new Array();

function excluir(id, table){

    if (confirm("Deseja realmente excluir este item?")){
        
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
                    $('.message-certo').html('Item excluido!');
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

function salvar(id, comportamento){

    $title = $('#faq-title-'+id)[0].value;
    $content = $('#faq-content-'+id)[0].value;

    if($title == "" || $content == ""){

        $('.message-error').html('Você não pode salvar uma FAQ incompleta!');
        $('.alert-erro').css('display','block');

    } else {

        for(let ide of created){
            if(ide == id){
                comportamento = 'save';
            }
        }

        $.ajax({
            url: './models/salvar.php',
            type: "POST",
            data: {
                'id': id,
                'title': $title,
                'content': $content,
                'behavior': comportamento
            },
            cache: false,
            async: true,
                success: function(response) {
                    if (response == true) {
                        $('.message-certo').html('FAQ salva!');
                        $('.alert-certo').css('display','block');
                    } else {
                        $('.message-error').html('Não consegui salvar a FAQ!');
                        $('.alert-erro').css('display','block');
                    }
                }
        });
        created.push(id);
    }

    window.setTimeout(() => {$('.alert-callback').css('display','none');}, 5500);

}

function addField(){

    let pai = document.getElementById('faq_cont');
    let butAdd = document.getElementsByClassName('button-add')[0];

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

    if(atualLists.length > 0){
        var newId = Number(atualLists[atualLists.length-1].attributes['data-id'].value) + 1;
    } else {
        var newId = 1;
    }

    labelTitle.htmlFor = `faq-title-${newId}`;
    labelTitle.innerHTML = "Título";

    inputTitle.id = `faq-title-${newId}`;
    inputTitle.maxLength = 65;

    labelCont.htmlFor = `faq-content-${newId}`;
    labelCont.innerHTML = "Conteúdo";

    textCont.id = `faq-content-${newId}`;
    textCont.maxLength = 500;
    textCont.rows = 6;

    save.onclick = () => {salvar(newId, 'create')};
    save.innerHTML = "Salvar";

    geral.setAttribute('data-id', newId);

    divInputs.appendChild(labelTitle);
    divInputs.appendChild(inputTitle);
    divInputs.appendChild(br);
    divInputs.appendChild(labelCont);
    divInputs.appendChild(textCont);

    divSave.appendChild(save);

    cabeça.appendChild(divInputs);
    cabeça.appendChild(divSave);

    geral.appendChild(cabeça);

    pai.insertBefore(geral, butAdd);
}