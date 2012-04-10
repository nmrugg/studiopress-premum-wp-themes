jQuery(document).ready(function($) {
	$('.feature-posts').cycle({
		timeout:  4000,
		prev:    	'.nav-prev',
		next:    	'.nav-next',
		fx:			 	'fade',
		speed:		2000,  // speed of the transition (any valid fx speed value) 
		speedIn:  1000,  // speed of the 'in' transition 
		speedOut: 1000,  // speed of the 'out' transition
		pager:   	'.feature-nav',					
		pagerAnchorBuilder: function(idx, slide) {
			return '.feature-nav li:eq(' + (idx) + ') a';
		}
	});
});