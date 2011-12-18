jQuery(document).ready(function($) {
	    $("#myController").jFlow({
			controller: ".jFlowControl", // must be class, use . sign
			slideWrapper : "#jFlowSlider", // must be id, use # sign
			slides: "#mySlides",  // the div where all your sliding divs are nested in
			selectedWrapper: "jFlowSelected",  // just pure text, no sign
			width: "875px",  // this is the width for the content-slider
			height: "580px",  // this is the height for the content-slider
			duration: 400,  // time in miliseconds to transition one slide
			prev: ".jFlowPrev", // must be class, use . sign
			next: ".jFlowNext", // must be class, use . sign
			auto: true
    });
});