jQuery(document).ready(function() {
  jQuery('.uc_classic_carousel > .owl-carousel').owlCarousel({
		loop: false,
		margin:0,
		nav: false,
		scrollPerPage: true,
		pagination : false,
		responsiveClass: true,
		responsive: {
		  0: {
			items: 1,
			nav: false,
			mouseDrag: true,
			touchDrag: true,
			scrollPerPage: true
		  },
		  600: {
			items: 2,
			nav: false,
			mouseDrag: true,
			touchDrag: true,
			scrollPerPage: true
		  },
		  800: {
			items: 2,
			nav: false,
			mouseDrag: true,
			touchDrag: true,
			scrollPerPage: true
		  },
		  992: {
			items: 3,
			nav: false,
			mouseDrag: true,
			touchDrag: true,
			scrollPerPage: true
		  },
		  1024: {
			items:3,
			nav: false,
			loop: false,
			mouseDrag: true,
			touchDrag: true,
			margin:0,
			scrollPerPage: true
		  }
		}
  })
  
  jQuery('.prev-page').click(function (e) {
	var owl = jQuery(".owl-carousel").data('owlCarousel');
	owl.prev();
	  
  });
  
  jQuery('.next-page').click(function (e) { 
	var owl = jQuery(".owl-carousel").data('owlCarousel');
	owl.next();
	  
  });
           
});