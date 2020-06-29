
var position = $(window).scrollTop();

$(function(){
	lazyload();
	get_faqs();

	$('.input-tel').mask('(00) 0000-00000');

	let input_news = document.getElementById('input-news');
	input_news.addEventListener("input", () => {
		if(input_news.value != ""){
			$('.label-news').css('display','block');
		} else {
			$('.label-news').css('display','none');
		}
	});

	$('.multiple-items').slick({
		dots: false,
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 2,
		autoplay: true,
  		autoplaySpeed: 2500,
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
					slidesToShow: 4,
					slidesToScroll: 3,
					infinite: true,
					dots: false
			  }
			},
			{
				breakpoint: 600,
				settings: {
					slidesToShow: 2.5,
					slidesToScroll: 2.5
				}
			}
		]
	});

	$('#modal-chegar').on('shown.bs.modal', function (e) {
		
		if(navigator.geolocation){
			navigator.geolocation.getCurrentPosition(position => {
			  
				long = position.coords.longitude;
				lat = position.coords.latitude;
		
				const link = `https://www.google.com/maps/embed?pb=!1m26!1m12!1m3!1d55297.42109040757!2d-51.08231563761302!3d-29.976877367600313!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m11!3e6!4m3!3m2!1d-29.949793699999997!2d-50.9781567!4m5!1s0x95197540a82133f7%3A0x12a677ecb2d27ab1!2sMarcos%20Fantin%20Pessoa%20-%20Av.%20Pres.%20Get%C3%BAlio%20Vargas%2C%202.394%20-%20Centro%2C%20Alvorada%20-%20RS%2C%2094810-001!3m2!1d-${lat}!2d-${long}!5e0!3m2!1spt-BR!2sbr!4v1591450335761!5m2!1spt-BR!2sbr`;
				document.getElementById("map").src = link;
			   
			});
		}

	});

});

$(document).on("scroll",function(){

	var scroll = $(window).scrollTop();


	if (scroll >= 730){
		$('#middle-text').css('color','var(--secondary-color)');
	} else {
		$('#middle-text').css('color','var(--last-color)');
	}

	position = scroll;

});

//Faqs
function get_faqs(){
	$.ajax({
        url: './models/getFaqs.php',
        cache: false,
        async: true,
            success: function(response) {
	
				if(response){
					var resposta = response.split("#.#");
					resposta.pop();

					for(var i = 0; i < resposta.length; i++){
						let thisResp = resposta[i].split(',');

						let pai = document.getElementsByClassName("card-body")[0];
						let geral = document.createElement("div");
						let title = document.createElement("h4");
						let content = document.createElement("p");

						geral.className = "duvida-item col-12 duvida-"+thisResp[0];
						title.className = "title-duvida title-"+thisResp[0];
						content.className = "text-duvida duvida-"+thisResp[0];

						title.innerHTML = thisResp[1];
						content.innerHTML = thisResp[2];

						geral.appendChild(title);
						geral.appendChild(content);

						pai.appendChild(geral);
					}
					$('.handler').remove();
				}
                
            }
    });
}

//Formulário de contato
function contactSubmited(e){
	e.preventDefault();

	var targetForm = e.target.id;
	$(`.send-${targetForm}`).html("");

	$(`<div class="spinner-border" role="status">
		<span class="sr-only">Loading...</span>
	</div>`).appendTo($(`.send-${targetForm}`));
	
	$(".submit-form").attr("disabled", true);

	if(targetForm == "contact-upper"){
		var nome = $('.input-nome')[0].value;
		var tel = $('.input-tel')[0].value;
		var local = 'contact';
	} else if(targetForm == "contact-down"){
		var nome = $('.input-nome')[1].value;
		var tel = $('.input-tel')[1].value;
		var msg = $('.input-msg').val();
		var local = 'message';
	} else {
		var mail = $('.input-news').val();
		var local = 'news';
	}

	let data = {
		name: nome,
		telefone: tel,
		mail: mail,
		message: msg,
		local: local
	};

	sendMessage(data,targetForm);
}
  
function sendMessage(message,targetForm){
	$.ajax({
		url: '../models/contact.php',
		type: "POST",
		data: {'message': message},
		cache: false,
		async: true,
	  	success: function(response) {
			$(`.send-${targetForm}`).html("Enviar");
			$(".submit-form").attr("disabled", false);

			if (response) {
				$(`#response-${targetForm}`).html({
					'contact-upper': 'Dados enviados com sucesso!',
					'contact-down': 'Mensagem enviada com sucesso!',
					'contact-news': 'Cadastrado com sucesso!',
				}[targetForm]);
				$(`#response-${targetForm}`).css("color","black");
				$('input').val("");
				$('textarea').val("");
			} else {
				$(`#response-${targetForm}`).html("Erro no envio, por favor tente novamente!");
				$(`#response-${targetForm}`).css("color","var(--primary-color)");
			}
	  	}
	});
}