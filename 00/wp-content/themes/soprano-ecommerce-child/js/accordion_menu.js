jQuery(document).ready( function(){
  
	jQuery('.widget-content ul').slideDown('normal');
	
	var url_link = jQuery('.sub-menu > li').find("a").attr("href");
	
	jQuery('.sub-menu > li:has(ul)').addClass("has-sub");
	jQuery('.sub-menu li:not(.has-sub)').addClass("link-only");
	
	var url_loaded = window.location.href;
	
	
	jQuery('.link-only').each(function( index ) {
		var sub_menu_parent = jQuery(this);
		var new_class =sub_menu_parent.find("a").text();
		var url = sub_menu_parent.find("a").attr("href");
				
				
		sub_menu_parent.find("ul").addClass('closed');	
					
		if(url_loaded.indexOf(url) != -1 || url === url_loaded){
			// alert(url_loaded);
			// alert(url);
			sub_menu_parent.find("ul").removeClass('closed');	
			sub_menu_parent.find("ul").addClass('opened');	
			
			jQuery(this).addClass('active');
			sub_menu_parent.closest('li').addClass('active');	
		}
		
	});	
	jQuery('.has-sub').each(function( index ) {
		var sub_menu_parent = jQuery(this);
		var new_class =sub_menu_parent.find("a").text();
		var url = sub_menu_parent.find("a").attr("href");
				
				
		sub_menu_parent.find("ul").addClass('closed');	
					
		if(url_loaded.indexOf(url) != -1 || url === url_loaded){
			sub_menu_parent.find("ul").removeClass('closed');	
			sub_menu_parent.find("ul").addClass('opened');	
			
			sub_menu_parent.closest('li').addClass('active');	
		}
		
		sub_menu_parent.find("li").each(function( index ) {
		
			var url_li = jQuery(this).find("a").attr("href");
							
			if(url_loaded.indexOf(url_li) != -1 || url_li === url_loaded){
				sub_menu_parent.find("ul").removeClass('closed');	
				sub_menu_parent.find("ul").addClass('opened');	
				
				jQuery(this).addClass('active');
				sub_menu_parent.closest('li').addClass('active');	
			}
		});
		
		sub_menu_parent.find("li.link-only").each(function( index ) {
		
			var url_li = jQuery(this).find("a").attr("href");
							
			if(url_loaded.indexOf(url_li) != -1 || url_li === url_loaded){
				sub_menu_parent.find("ul").removeClass('closed');	
				sub_menu_parent.find("ul").addClass('opened');	
				
				jQuery(this).addClass('active');
				sub_menu_parent.closest('li').addClass('active');	
			}
		});
		
		
	});	
	
	jQuery('.closed').slideUp('normal');
	jQuery('.opened').slideDown('normal');
	
	
	jQuery('.sub-menu > li').click(function() {

		var has_submenu = jQuery(this).hasClass( "has-sub" );
		var checkElement = jQuery(this).find("ul");

		if((has_submenu) && (!checkElement.is(':visible'))) {
			jQuery('.sub-menu li').removeClass('active');	
			jQuery('.sub-menu ul:visible').slideUp('normal');
			
			jQuery(this).addClass('active');
			checkElement.slideDown('normal');
				
		}
	});
	
});