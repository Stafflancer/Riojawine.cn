function click_map_interactive(){
		
	var is_mobile = false;
	// if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	  // is_mobile = true;
	// }else{
	  // is_mobile = false;
	// }
	
	var windowsize = jQuery(window).width();
	
	if(windowsize < 1024){
		is_mobile = true;
	} else {
		is_mobile = false;
	}
	
	
	
	var regions=[
		{
			"region_name": "Rioja Alta",
			"region_code": "rioja-alta",
		},
		{
			"region_name": "Rioja Alavesa",
			"region_code": "rioja-alavesa",
		},
		{
			"region_name": "Rioja baja",
			"region_code": "rioja-baja",
		}
	];

	for (i = 0; i < regions.length; i++) {
		jQuery('#'+ regions[i].region_code )
		.data('region', regions[i]);
	}

	
	
	if(is_mobile){
		
		
		jQuery('.container-map .map').append('<div class="container-buttons"><div class="btn btn-primary button-map button-rioja-alta">Rioja Alta</div><div class="btn btn-primary button-map button-rioja-baja">Rioja Oriental</div><div class="btn btn-primary button-map button-rioja-alavesa">Rioja Alavesa</div></div>');
		jQuery('.container-map-mini .contain-left').append('<div class="container-buttons"><div class="btn btn-primary button-map button-rioja-alta">Rioja Alta</div><div class="btn btn-primary button-map button-rioja-baja">Rioja Oriental</div><div class="btn btn-primary button-map button-rioja-alavesa">Rioja Alavesa</div></div>');
		jQuery('.container-map .right-arrow').css('display', 'none');
		jQuery('.contain-right').css('display', 'none');
		jQuery('.contain-right').children('div').each(function () {
			jQuery(this).data('visible', false);
		});
		jQuery('.contain-right').data('visible', false);
		
		jQuery('.button-rioja-alta').click(function (e) {
			jQuery('#rioja-alta').click();
		});
		
		jQuery('.button-rioja-baja').click(function (e) {
			jQuery('#rioja-baja').click();
		});
		
		jQuery('.button-rioja-alavesa').click(function (e) {
			jQuery('#rioja-alavesa').click();
		});
		
		jQuery('.map g').click(function (e) {

			var region_data=jQuery(this).data('region');

			if( (typeof region_data !== "undefined") ){
				// alert(region_data.region_name);
				var widthInfoView = jQuery('.' + region_data.region_code).width();

				if( jQuery('.contain-right').data('visible') == false ){
					//--- El panel derecho estaba oculto y se tiene que mostrar

					// Inicializacion de la posicion del panel derecho
					jQuery('.contain-right').css({'top':'0px'});

					jQuery('.contain-right').children('div').each(function () {
						jQuery(this).css({'z-index':1, 'opacity':0});
						jQuery('#' + jQuery(this).attr('class')).removeClass('active');
					});
					jQuery('.' + region_data.region_code).css({'z-index':999, 'opacity':1});
					jQuery('#' + region_data.region_code).addClass('active');

					jQuery('.contain-right').animate({top: '0px', opacity: '1'}, "slow");
					jQuery('.contain-right').css('display', 'block');
					

					jQuery('.contain-right').data('visible', true);
					

				}

				jQuery('.' + region_data.region_code).data('visible', true);

			}else{
				jQuery('.contain-right').animate({top: jQuery('.contain-right').height()+'px', opacity: '0'}, "slow");

				jQuery('.contain-right').data('visible', false);
				jQuery('.contain-right').data('display', 'none');

				// jQuery('.contain-right').children().animate({top: jQuery('.contain-right').height()+'px', opacity: '0'}, "slow");
				jQuery('.contain-right').children('div').each(function () {
					jQuery(this).data('visible', false);
					jQuery('#' + jQuery(this).attr('class')).removeClass('active');
				});
			}
		});
		

		jQuery('.close-info').click(function (e) {
			
			jQuery('.contain-right').animate({top: jQuery('.contain-right').height()+'px', opacity: '0'}, "slow");

			jQuery('.contain-right').data('visible', false);
			jQuery('.contain-right').data('display', 'none');

			// jQuery('.contain-right').children().animate({top: jQuery('.contain-right').height()+'px', opacity: '0'}, "slow");
			jQuery('.contain-right').children('div').each(function () {
				jQuery(this).data('visible', false);
				jQuery('#' + jQuery(this).attr('class')).removeClass('active');
			});
			
		});
		
	} else {
		jQuery('.container-map .right-arrow').css('display', 'none');
		jQuery('.container-map .contain-right').css('display', 'block');
		jQuery('.container-map .contain-right').css({'opacity':0});
		jQuery('.container-map .contain-right').children('div').each(function () {
			jQuery(this).data('visible', false);
		});
		jQuery('.container-map .contain-right').data('visible', false);

		jQuery('.container-map .map g').click(function (e) {

			var region_data=jQuery(this).data('region');

			if( (typeof region_data !== "undefined") ){
				// alert(region_data.region_name);
				var widthInfoView = jQuery('.' + region_data.region_code).width();

				if( jQuery('.contain-right').data('visible') == false ){
					//--- El panel derecho estaba oculto y se tiene que mostrar

					// Se mueve el panel izquierzo fuera de la pantalla
					jQuery('.contain-left').animate({left: -widthInfoView+'px', opacity: '0'}, "slow");

					// Se mueve el panel del mapa a la parte izquierda
					jQuery('.map').animate({left: '0px'}, "slow");

					// Inicializacion de la posicion del panel derecho
					jQuery('.contain-right').css({'right':-widthInfoView+'px'});

					jQuery('.contain-right').children('div').each(function () {
						jQuery(this).css({'z-index':1, 'opacity':0});
						jQuery('#' + jQuery(this).attr('class')).removeClass('active');
					});
					jQuery('.' + region_data.region_code).css({'z-index':999, 'opacity':1});
					jQuery('#' + region_data.region_code).addClass('active');

					jQuery('.contain-right').animate({right: '0px', opacity: '1'}, "slow");
					

					jQuery('.contain-right').data('visible', true);
					
					
					jQuery('.right-arrow').css('display', 'flex');

				}else{
					//--- El panel derecho ya se veia

					if( jQuery('.' + region_data.region_code).data('visible') == false ){
						// Hay que cargar una nueva ventana de info para la region

						jQuery('.contain-right').children().animate({left: widthInfoView+'px', opacity: '0'}, "slow");
						jQuery('.contain-right').children('div').each(function () {
							jQuery(this).data('visible', false);
							jQuery('#' + jQuery(this).attr('class')).removeClass('active');
						});

						jQuery('.' + region_data.region_code).animate({left: '0px', opacity: '1'}, "slow");
						jQuery('#' + region_data.region_code).addClass('active');
					}
				}

				jQuery('.' + region_data.region_code).data('visible', true);

			}else{
				// Se reestablecen los paneles a su posicion de inicio
				jQuery('.contain-left').animate({left: '0px', opacity: '1'}, "slow");

				jQuery('.map').animate({left: '30%'}, "slow");

				jQuery('.contain-right').animate({right: -jQuery('.contain-right').width()+'px', opacity: '0'}, "slow");

				jQuery('.contain-right').data('visible', false);
				jQuery('.right-arrow').css('display', 'none');

				jQuery('.contain-right').children().animate({left: '0px', opacity: '0'}, "slow");
				jQuery('.contain-right').children('div').each(function () {
					jQuery(this).data('visible', false);
					jQuery('#' + jQuery(this).attr('class')).removeClass('active');
				});
			}
		});

		jQuery('.container-map .close-info').click(function (e) {
			
			jQuery('.contain-left').animate({left: '0px', opacity: '1'}, "slow");

			jQuery('.map').animate({left: '30%'}, "slow");
			jQuery('.right-arrow').css('display', 'none');

			jQuery('.contain-right').animate({right: -jQuery('.contain-right').width()+'px', opacity: '0'}, "slow");

			jQuery('.contain-right').data('visible', false);

			jQuery('.contain-right').children().animate({left: '0px', opacity: '0'}, "slow");
			jQuery('.contain-right').children('div').each(function () {
				jQuery(this).data('visible', false);
				jQuery('#' + jQuery(this).attr('class')).removeClass('active');
			});
			
		});
		
		
		jQuery(".container-map-mini .rioja-alta").mouseenter(function() {
			jQuery(".container-map-mini #rioja-alta").css("fill", "#9b0f2e");
			jQuery(".container-map-mini .rioja-alta .overlay").css("opacity", "0.4");
			jQuery(".container-map-mini .rioja-alta .more-info .btn").css("display", "block");
		})
		.mouseleave(function() {
			jQuery(".container-map-mini #rioja-alta").css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-alta .overlay").css("opacity", "0");
			jQuery(".container-map-mini .rioja-alta .more-info .btn").css("display", "none");
		});
	  
		jQuery(".container-map-mini #rioja-alta").hover(function() {
			jQuery(".container-map-mini .rioja-alta .overlay").css("opacity", "0.4");
			jQuery(this).css("fill", "#9b0f2e");
			jQuery(".container-map-mini .rioja-alta .more-info .btn").css("display", "block");
		}).mouseout(function(){
			jQuery(".container-map-mini .rioja-alta .overlay").css("opacity", "0");
			jQuery(this).css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-alta .more-info .btn").css("display", "none");
		});
		
		
		jQuery(".container-map-mini .rioja-baja").mouseenter(function() {
			jQuery(".container-map-mini #rioja-baja").css("fill", "#6a0522");
			jQuery(".container-map-mini .rioja-baja .overlay").css("opacity", "0.4");
			jQuery(".container-map-mini .rioja-baja .more-info .btn").css("display", "block");
		})
		.mouseleave(function() {
			jQuery(".container-map-mini #rioja-baja").css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-baja .overlay").css("opacity", "0");
			jQuery(".container-map-mini .rioja-baja .more-info .btn").css("display", "none");
		});
	  
		jQuery(".container-map-mini #rioja-baja").hover(function() {
			jQuery(".container-map-mini .rioja-baja .overlay").css("opacity", "0.4");
			jQuery(".container-map-mini .rioja-baja .more-info .btn").css("display", "block");
			jQuery(this).css("fill", "#6a0522");
		}).mouseout(function(){
			jQuery(".container-map-mini .rioja-baja .overlay").css("opacity", "0");
			jQuery(this).css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-baja .more-info .btn").css("display", "none");
		});
		
		
		jQuery(".container-map-mini .rioja-alavesa").mouseenter(function() {
			jQuery(".container-map-mini #rioja-alavesa").css("fill", "#d3004b");
			jQuery(".container-map-mini .rioja-alavesa .overlay").css("opacity", "0.4");
			jQuery(".container-map-mini .rioja-alavesa .more-info .btn").css("display", "block");
		})
		.mouseleave(function() {
			jQuery(".container-map-mini #rioja-alavesa").css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-alavesa .overlay").css("opacity", "0");
			jQuery(".container-map-mini .rioja-alavesa .more-info .btn").css("display", "none");
		});
	  
		jQuery(".container-map-mini #rioja-alavesa").hover(function() {
			jQuery(".container-map-mini .rioja-alavesa .overlay").css("opacity", "0.4");
			jQuery(".container-map-mini .rioja-alavesa .more-info .btn").css("display", "block");
			jQuery(this).css("fill", "#d3004b");
		}).mouseout(function(){
			jQuery(".container-map-mini .rioja-alavesa .overlay").css("opacity", "0");
			jQuery(this).css("fill", "#ee6079");
			jQuery(".container-map-mini .rioja-alavesa .more-info .btn").css("display", "none");
		});
	}
	
}


jQuery(document).ready(function(){
	click_map_interactive();	
});

// jQuery(window).resize(function() {
  // click_map_interactive();
// });