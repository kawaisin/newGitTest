/****************************** DOCUMENT READY *******************************/


jQuery.noConflict();
jQuery(document).ready(function($){



// Smooth Scrolling

$(function() {
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 500);
        return false;
      }
    }
  });
});
	
	
	
	// display image caption on top of image
$(".tiled-gallery-item img").each(function() {
    var imageCaption = $(this).attr("alt");
    if (imageCaption != '') {
        var imgWidth = $(this).width();
        var imgHeight = $(this).height();
        var position = $(this).position();
        var positionTop = (position.top + imgHeight - 36)
        $("<span class='img-caption'><em>" + imageCaption +
            "</em></span>").css({
            "position": "absolute",
            "top": positionTop + "px",
            "left": "2px",
            "width": imgWidth + "px"
        }).insertAfter(this);
    }
});
	
	//Remove active class
	$( "#menu-item-75,#menu-item-76,#menu-item-77,#menu-item-105" ).removeClass( "active" )
	
	
	// External Link add attr
	$("a[href^='htt']").not("a[href*='"+document.domain+"']").attr("target","_blank").addClass("outLink");
	$("a[href$='pdf']").attr('target','_blank');
	
	// Add Active class
		//Get base url
	var url = window.location.href.split("#")[0];
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');
 
	//Works with relative and absolute links
	$('ul.nav a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');
	
	$('.bxslider').bxSlider ({
	})
	
	// handle links with @href started with '#' only
	$(document).on('click', 'a[href^="#"]', function(e) {
	    // target element id
	    var id = $(this).attr('href');
	    
	    // target element
	    var $id = $(id);
	    if ($id.length === 0) {
	        return;
	    }
	    
	    // prevent standard hash navigation (avoid blinking in IE)
	    e.preventDefault();
	    
	    // top position relative to the document
	    var pos = $(id).offset().top - 50;
	    
	    // animated top scrolling
	    $('body, html').animate({scrollTop: pos});
	});
	
	$(".navbar-nav li a").click(function(event) {
    if (!$(this).parent().hasClass('dropdown'))
        $(".navbar-collapse").collapse('hide');
	});


	
}); //close doc ready