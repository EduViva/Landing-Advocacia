$(function(){

    if(window.matchMedia('(max-width: 768px)').matches){
        document.getElementsByClassName('social')[0].remove();
	}

});

var topPos = $(window).scrollTop();

$(document).on("scroll",function(){

	var scroll = $(window).scrollTop();

	//Topbar
	if(window.matchMedia('(max-width: 768px)').matches){
		if(scroll > 300){
            $('.navbar-collapse').css("display","none");
            $('.navbar').css({
				'background':'rgba(255,255,255,.8)',
			});
			$('.nav-item').addClass("scrolled");
            $('.nav-active').css('color','var(--complementar-1)');
        } else {
            $('.navbar').css({
				'background-color':'#dadada',
			});
			$('.nav-item').removeClass("scrolled");
            $('.nav-active').css('color','rgba(0,0,0,.9)');
        }
	}

	if(window.matchMedia('(min-width: 769px)').matches){
		if(scroll > 300){
			$('.navbar').css({
				'background':'rgba(255,255,255,.8)',
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
				'background-color':'#dadada',
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

	if(scroll < topPos || scroll <= 300){
		$('.navbar-collapse').css("display","block");
	}

	topPos = scroll;

});