jQuery(document).ready( function(){

	var button_submit = jQuery('.sp-subscribe-form').find('button');  
	
	if( jQuery('#privacy_readed').is(':checked')) {  
		button_submit.attr("disabled", false);
	} else {  
		button_submit.attr("disabled", true);
	}  
		
	jQuery('#privacy_readed').click(function() {
		
		var button_submit = jQuery('.sp-subscribe-form').find('button');  
		
		if( jQuery('#privacy_readed').is(':checked')) {  
			button_submit.attr("disabled", false);
		} else {  
			button_submit.attr("disabled", true);
		}  
	});
	  
});