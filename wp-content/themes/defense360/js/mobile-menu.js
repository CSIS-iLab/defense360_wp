/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	// Click on menu icon to toggle menu classes
	$(".header-mobileContainer").click(function() {
		$(".navigation-container").slideToggle('fast');
		$("body, .site-header").toggleClass("menu-mobile-active");
		$(".icon-menu").toggle();
		$(".close-icon").toggle();
	})

} )( jQuery );
