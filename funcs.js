
var position = $(window).scrollTop();

$(function(){

    if(window.matchMedia('(max-width: 768px)').matches){

        document.getElementsByClassName('social')[0].remove();

    }

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
				'height':'81px',
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