(function($) {
// tiny helper function to add breakpoints
function getGridSize() {
return (window.innerWidth < 700) ? 1 :
       (window.innerWidth < 1200) ? 2 : 4;
}

var flexslider;

// Delaying after resize
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$(window).load(function() {
	

    if($(".gform_validation_error").size() > 0)
    {

    	$("html, body").animate({scrollTop: (parseInt($('.gform_validation_error').offset().top) - 150) + "px" }, 500);
    }

    /* Equalheights */
    for ( var i = 0, l = 5; i < l; i++ ) {
    	if($(".eq-height-"+(i+1)).size() > 0)
	    	$(".eq-height-"+(i+1)).matchHeight();
	}


    $(".widget_become_customer_widget form").submit(function () {
    	$("html, body").delay(500).animate({scrollTop:$(".widget_become_customer_widget").offset().top-100+"px"});
    });

    // The slider
    if($('.flexslider').size() > 0 &&
       $('.flexslider ul.slides li').size() > 0)
    {
      // The slider
      $('.flexslider').flexslider({
        animation: "fade",
        directionNav: true,
        controlNav: false
      });

    }

});

$(window).resize(function() {
	/* Equalheights */
    for ( var i = 0, l = 5; i < l; i++ ) {
    	if($(".eq-height-"+(i+1)).size() > 0)
	    	$(".eq-height-"+(i+1)).matchHeight();
	}
});
})(jQuery);
