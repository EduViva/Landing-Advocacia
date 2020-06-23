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