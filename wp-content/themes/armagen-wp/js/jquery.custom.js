jQuery(document).ready( function($)
{
		

	
		
/**
 * Smooth scrolling anchors
*/
	$('a[href*=#]:not([href=#])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html,body').animate({
				scrollTop: target.offset().top
			}, 1000);
				return false;
			}
		}
	});






if(!Modernizr.svg) {
    $('img[src*="svg"]').attr('src', function() {
        return $(this).attr('src').replace('.svg', '.png');
    });
}





/**
 * Back-to-Top on scroll-up only
*/

	$("a.backtop").hide();
	
	$(document).ready(function () {
		var mywindow = $(window);
		var mypos = mywindow.scrollTop();
		var up = false;
		var newscroll;
		mywindow.scroll(function () {
			newscroll = mywindow.scrollTop();
			if ($(this).scrollTop() === 0) {
				$("a.backtop").hide();
				$('a.backtop.rotate').css('display','none');
			}
			 else if (newscroll > mypos && !up) {
				$('a.backtop').stop().fadeOut();
				up = !up;
				console.log(up);
			} else if(newscroll < mypos && up) {
				$('a.backtop').stop().fadeIn();
				$('a.backtop.rotate').css('display','block');
				up = !up;
			}
			mypos = newscroll;
			e.preventDefault();
		});
	});








/**
 * Magnific Popup for homepage compounds
*/
	$('.modal-link').magnificPopup({
	  type:'inline',
	  midClick: true,
	  removalDelay: 300,
	  mainClass: 'mfp-fade'
	});


/**
 * Magnific Popup for BBB image
*/
	$('.image-link').magnificPopup({ 
	  type: 'image',
	  mainClass: 'mfp-with-zoom', // this class is for CSS animation below
	
	  zoom: {
		enabled: true, // By default it's false, so don't forget to enable it
	
		duration: 300, // duration of the effect, in milliseconds
		easing: 'ease-in-out', // CSS transition easing function 
	
		// The "opener" function should return the element from which popup will be zoomed in
		// and to which popup will be scaled down
		// By defailt it looks for an image tag:
		opener: function(openerElement) {
		  // openerElement is the element on which popup was initialized, in this case its <a> tag
		  // you don't need to add "opener" option if this code matches your needs, it's defailt one.
		  return openerElement.is('img') ? openerElement : openerElement.find('img');
		}
	  }
	
	});


/**
 * Owlslider
*/
/* Homepage Timeline */
	
		$("#timeline-slider").owlCarousel({
			navigation : true,
			autoPlay : false,
			pagination : false,
			navigationText : ["<span>‹</span>","<span>›</span>"],
			//scrollPerPage : true,
			items : 5,
			itemsDesktop : false,
			itemsDesktopSmall : false,
			itemsTablet: false,
			itemsMobile : [800,1]
		});
		//$(this).find(".owl-prev span").addClass("rotate");






});