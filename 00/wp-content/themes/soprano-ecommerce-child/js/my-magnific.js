// This will create a single gallery from all elements that have class "gallery-item"
jQuery(document).ready(function($){	
	$('.gallery-magnific').each(function() { // the containers for all your galleries
	    $(this).magnificPopup({
	        delegate: 'a', // the selector for gallery item
	        type: 'image',
	        gallery: {
	          enabled:true
	        },
	        closeBtnInside: false,
	        closeOnBgClick: true,
          	fixedContentPos: true,
	        iframe: {
				  markup: '<div class="mfp-iframe-scaler">'+
				            '<div class="mfp-close"></div>'+
				            '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
				          '</div>', // HTML markup of popup, `mfp-close` will be replaced by the close button

				  patterns: {
				    youtube: {
				      index: 'youtube.com/', // String that detects type of video (in this case YouTube). Simply via url.indexOf(index).

				      id: 'v=', // String that splits URL in a two parts, second part should be %id%
				      // Or null - full URL will be returned
				      // Or a function that should return %id%, for example:
				      // id: function(url) { return 'parsed id'; }

				      src: 'https://www.youtube.com/embed/%id%?autoplay=1' // URL that will be set as a source for iframe.
				    },
				    vimeo: {
				      index: 'vimeo.com/',
				      id: '/',
				      src: 'https://player.vimeo.com/video/%id%?autoplay=1'
				    },
				    gmaps: {
				      index: '//maps.google.',
				      src: '%id%&output=embed'
				    }

				    // you may add here more sources

				  },

				  srcAction: 'iframe_src', // Templating object key. First part defines CSS selector, second attribute. "iframe_src" means: find "iframe" and set attribute "src".
				}
	    });
	});
});