jQuery(document).ready(function($) {
	$('.slider-posts').cycle({
		timeout:  0,
		prev:    	'.nav-prev',
		next:    	'.nav-next',
		fx:			 	'fade',
		speed:		2000,  // speed of the transition (any valid fx speed value) 
		speedIn:  1000,  // speed of the 'in' transition 
		speedOut: 1000,  // speed of the 'out' transition
		pager:   	'.nav-thumbs',					
		pagerAnchorBuilder: function(idx, slide) {
			return '.nav-thumbs li:eq(' + (idx) + ') a';
		}
	});
});