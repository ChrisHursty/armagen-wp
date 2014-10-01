jQuery(document).ready(function ($) {

	var armagenJS = {
		'nav' : $('#navigation'),
		'menu' : $('#navigation .nav-menu'),
		'submenu' : false,
	};

	// Enable menu toggle for small screens
	(function() {
		if ( ! armagenJS.nav ) {
			return;
		}

		button = armagenJS.nav.find('.menu-toggle');
		if ( ! button ) {
			return;
		}

		// Hide button if menu is missing or empty.
		if ( ! armagenJS.menu || ! armagenJS.menu.children().length ) {
			button.hide();
			return;
		}

		button.on( 'click', function() {
			armagenJS.nav.toggleClass('toggled-on');
			armagenJS.menu.slideToggle( '200' );
		} );
	})();

	// Centers the submenus directly under the top menu
    function portfolio_desktop_submenus() {
		if ( document.body.clientWidth > 780 && !armagenJS.submenu ) {
			armagenJS.menu.attr('style','');
			armagenJS.nav.find('div > ul > li').each( function() {
				var ul = $(this).find('> ul');
			    if ( ul.length > 0 ) {
			        var parent_width = $(this).outerWidth( true );
			        var child_width = ul.outerWidth( true );
			        var new_width = parseInt((child_width - parent_width)/2);
			        ul.css('margin-left', -new_width + "px");
			    }
			});
			armagenJS.submenu = true;
		}
	}

	// Clears submenu alignment for the mobile menu
	function portfolio_mobile_submenus() {
		if ( document.body.clientWidth <= 780 && armagenJS.submenu ) {
			armagenJS.nav.find('ul').css('margin-left', '');
			armagenJS.submenu = false;
		}
	}

	// Fired by the resize event
	function menu_alignment() {
		portfolio_desktop_submenus();
		portfolio_mobile_submenus();
	}

	// Debounce function
	// http://remysharp.com/2010/07/21/throttling-function-calls/
	function debounce(fn, delay) {
		var timer = null;
			return function () {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
			  fn.apply(context, args);
			}, delay);
		};
	}

	// If the site title and menu don't fit on the same line, clear the menu
	if ( $('#branding .col-width').width() < ( $('#logo').outerWidth() + armagenJS.nav.outerWidth() ) ) {
		$('body').addClass('clear-menu');
	}

	// Menu Alignment
    portfolio_desktop_submenus();

    // Recheck menu alignment on resize
    $(window).on( 'resize', debounce( menu_alignment, 100) );

});