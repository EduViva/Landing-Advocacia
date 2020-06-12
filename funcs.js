
var position = $(window).scrollTop();

$(function(){
	lazyload();

	$('.input-tel').mask('(00) 0000-00000');
	
    if(window.matchMedia('(max-width: 768px)').matches){
        document.getElementsByClassName('social')[0].remove();
	}

	if(window.matchMedia('(min-width: 425px)') && window.matchMedia('(max-width: 767px)')){
		$('.princ-text').css({
			'margin-top' : '5.4%',
			'font-weight' : 'bold',
			'font-size' : '13.5pt',
		});
	}

	let input_news = document.getElementById('input-news');
	input_news.addEventListener("input", () => {
		if(input_news.value != ""){
			$('.label-news').css('display','block');
		} else {
			$('.label-news').css('display','none');
		}
	});

	$('.multiple-items').slick({
		dots: true,
		infinite: true,
		slidesToShow: 5,
		slidesToScroll: 2,
		autoplay: true,
  		autoplaySpeed: 3200,
		responsive: [
			{
			  breakpoint: 1024,
			  settings: {
				slidesToShow: 4,
				slidesToScroll: 3,
				infinite: true,
				dots: true
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
				
				let box = document.getElementById("box");
				box.remove();
			   
			});
		}

	});

});

$(document).on("scroll",function(){

	var scroll = $(window).scrollTop();

	//Topbar
	if(window.matchMedia('(max-width: 768px)').matches){
		if(scroll > 300){
            $('.navbar-collapse').css("display","none");
            $('.navbar').css({
				'background':'rgba(255,255,255,.8)',
				'box-shadow':'-2px 1.5px 20px black',
			});
			$('.nav-item').addClass("scrolled");
            $('.nav-active').css('color','var(--complementar-1)');
        } else {
            $('.navbar').css({
				'background':'transparent',
				'background-image':' linear-gradient(to bottom, var(--secondary-color), var(--primary-color))',
			});
			$('.nav-item').removeClass("scrolled");
            $('.nav-active').css('color','rgba(0,0,0,.9)');
        }
	}

	if(window.matchMedia('(min-width: 769px)').matches){
		if(scroll > 300){
			$('.navbar').css({
				'background':'rgba(255,255,255,.8)',
				'box-shadow':'-2px 1.5px 20px black',
				'height':'50px',
			});
			$('.img-logo').css({
				"height":"0",
				"width":"0"
            });
            
			$('.nav-item').addClass("scrolled");
            $('.nav-active').css('color','var(--complementar-1)');
        
		} else {
			$('.navbar').css({
				'background':'transparent',
				'background-image':' linear-gradient(to bottom, var(--secondary-color), var(--primary-color))',
				'height':'68px',
			});
			$('.img-logo').css({
				"height":"52px",
				"width":"52px"
            });
            
			$('.nav-item').removeClass("scrolled");
            $('.nav-active').css('color','rgba(0,0,0,.9)');
            
		}
	}

	if(scroll < position || scroll <= 300){
		$('.navbar-collapse').css("display","block");
	}

	if (scroll >= 790){
		$('#middle-text').css('color','var(--secondary-color)');
	} else {
		$('#middle-text').css('color','var(--last-color)');
	}

	position = scroll;

});

//Formulário de contato
function contactSubmited(e){
	e.preventDefault();
	
	var targetForm = e.target.id;
	$(`.send-${targetForm}`).html("Enviando...");
	$(".submit-form").attr("disabled", true);

	console.log(targetForm);

	if(targetForm == "contact-upper"){
		console.log('alo');
		var nome = $('.input-nome')[0].value;
		var tel = $('.input-tel')[0].value;
	} else if(targetForm == "contact-down"){
		var nome = $('.input-nome')[1].value;
		var tel = $('.input-tel')[1].value;
		var msg = $('.input-msg').val();
	} else {
		var mail = $('.input-news').val();
		console.log(mail);
	}
  
	let data = {
	  name: nome,
	  telefone: tel,
	  mail: mail,
	  message: msg,
	  url: window.location.href
	};

	sendMessage(data,targetForm);
  }
  
  
  function sendMessage(message,targetForm){
	$.ajax({
	  url: `contact.php`,
	  type: "POST",
	  data: {'message': message},
	  cache: false,
	  async: true,
	  success: function(response) {
		$(`.send-${targetForm}`).html("Enviar");
		$(".submit-form").attr("disabled", false);

		console.log(response);
		
		if (response) {
		  $(`#response-${targetForm}`).html("Dados enviados com sucesso!");
		  $(`#response-${targetForm}`).css("color","black");
		  $('input').val("");
		  $('textarea').val("");
		} else {
		  $(`#response-${targetForm}`).html("Erro no envio, por favor tente novamente!");
		  $(`#response-${targetForm}`).css("color","var(--primary-color)");
		}
	  }
	})
  }