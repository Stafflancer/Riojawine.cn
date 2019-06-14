// external js: masonry.pkgd.js
jQuery(document).ready(function($){
	$('.grid').masonry({
	  itemSelector: '.grid-item',
	  columnWidth: '.grid-sizer',
	  percentPosition: true
	});
});