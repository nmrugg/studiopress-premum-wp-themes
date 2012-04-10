 jQuery(document).ready(function(){
	//To switch directions up/down and left/right just place a "-" in front of the top/left attribute
	//Horizontal Sliding
	jQuery('.boxgrid.slidedown').hover(function(){
		jQuery(".cover", this).stop().animate({top:'-108px'},{queue:false,duration:300});
		}, function() {
			jQuery(".cover", this).stop().animate({top:'0px'},{queue:false,duration:300});
		});
	}); 