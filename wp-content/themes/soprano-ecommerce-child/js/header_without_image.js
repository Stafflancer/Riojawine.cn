function add_class_header() {
	var header = jQuery('#sp-header');
	header.addClass('header-stuck');
	header.addClass('without-image');
			
	var headerSize = jQuery('.header-stuck').outerHeight();
	
	jQuery('body #sp-wrapper').css('padding-top', headerSize);
	
	// PZTJS.scrollRAF(function () {
		// header.addClass('header-stuck');
	// });
	
}

jQuery(document).ready( function(){
	
	add_class_header();
	
	
});
jQuery(window).bind("load", function() {
	add_class_header();
});

jQuery( window ).resize(function() {
	add_class_header();
}).resize();
