jQuery(document).ready( function(){
	
	var url_loaded = window.location.href;
	
	jQuery('.menu-item').each(function( index ) {
		var sub_menu_parent = jQuery(this);
		var url = sub_menu_parent.find("a").attr("href");
				
				
		sub_menu_parent.removeClass('active');	
		sub_menu_parent.find("li").removeClass('active');	
					
		if(url === url_loaded){
			sub_menu_parent.addClass('active');	
			return false;
		} else {
			sub_menu_parent.find("a").each(function( index ) {
				// var link_menu_element = jQuery(this).find("a");
				var url = jQuery(this).attr("href");
												
				if(url === url_loaded){
					sub_menu_parent.addClass('active');	
					jQuery(this).addClass('active');	
					// link_menu_element.addClass('active');	
					return false;
				}
				
			});		
		}
	});	
		
	
		
	// jQuery(".wp-mega-sub-menu:visible").each(function( index ) {
		// jQuery(this).addClass('active');
		
	// });
});

function add_class_header() {
	var header = jQuery('#sp-header');
	header.addClass('header-stuck');
			
	//se le restan 20 porque es la diferencia de paddings 
	//(aplica primero 15px arriba y abajo y es sobre lo que coge la altura, y por 
	//css se le están dando 5px arriba y abajo con important después, hay 20px de diferencia que hay que restar)
	var headerSize = jQuery('.header-stuck').outerHeight();
	
	jQuery('body #sp-wrapper').css('padding-top', headerSize);
	
	PZTJS.scrollRAF(function () {
		header.addClass('header-stuck');
	});
}

function remove_class_header() {
	var header = jQuery('#sp-header');
	
	jQuery('body #sp-wrapper').css('padding-top', 0);
	jQuery('#sp-header').removeClass('header-stuck');
}

jQuery( window ).resize(function() {
	if(jQuery(window).width() <= 1160){
		add_class_header();
	} else {
		if(!jQuery('#sp-header').hasClass('without-image')){
			remove_class_header();
		}
	}
}).resize();
