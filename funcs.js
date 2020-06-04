
var position = $(window).scrollTop();

$(function(){
	lazyload();
	
    if(window.matchMedia('(max-width: 768px)').matches){

        document.getElementsByClassName('social')[0].remove();

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

})

$(document).on("scroll",function(){

	var scroll = $(window).scrollTop();

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

	position = scroll;

});