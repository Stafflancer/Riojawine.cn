(jQuery),	
function(a) {
        "use strict";
        function d() {}
        function f() {}		
		 
		 jQuery(document).ready(function(a) {
            var e = jQuery(".ult-no-mobile").length;
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) && e >= 1 ? jQuery(".ult-animation").css("opacity", 1) : d(), f(), jQuery(".ubtn").hover(function() {}, 
			function() {}),
			 /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ? jQuery(".ifb-flip-box").on("click", function(a) {
                var b = jQuery(this);
                b.hasClass("ifb-hover") ? b.removeClass("ifb-hover") : b.addClass("ifb-hover")
            }) : jQuery(".ifb-flip-box").on("hover", function(a) {
                var b = jQuery(this);
                b.hasClass("ifb-hover") ? b.removeClass("ifb-hover") : b.addClass("ifb-hover")
            }), 
			 jQuery(".square_box-icon").each
        })
    }(jQuery) 
	