// (function($) {

// 	var $grid = $('#faq-cpu').masonry({
// 	  // options...
// 	});
// 	// layout Masonry after each image loads
// 	//$grid.imagesLoaded().progress( function() {
// 	  $grid.masonry('layout');
// 	//});

// })(jQuery);



var elem = document.querySelector('#faq-cpu');
console.log(elem);
var msnry = new Masonry( elem, {
  // options
	itemSelector: '.faq-category-wrapper',
	// columnWidth: '.grid-sizer',
	// gutter: '.gutter-sizer',
	// percentPosition: true
});
console.log(msnry);
console.log(msnry.itemSelector);