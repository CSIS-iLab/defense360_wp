/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

( function( $ ) {
	var width = $(window).width();
	// Click on menu icon to toggle menu classes
	$(".header-mobileContainer").click(function() {
		$(".navigation-container").slideToggle('fast');
		$("body, .site-header").toggleClass("menu-mobile-active");
		$(".header-mobileContainer .icon-menu").toggle();
		$(".header-mobileContainer .close-icon").toggle();

		// Hide Search
		$(".header-searchFormContainer").hide();
		$(".header-searchContainer .icon-search").show();
		$(".header-searchContainer .close-icon").hide();
	});

	// Toggle Search
	$(".header-searchContainer .icon-search, .nav-searchIconContainer .icon-search, .search-closeContainer .close-icon, .header-searchContainer .close-icon").click(function() {

		if(width < 770) {
			// Hide Menu
			$(".navigation-container").hide();
			$("body, .site-header").removeClass("menu-mobile-active");
			$(".header-mobileContainer .icon-menu").show();
			$(".header-mobileContainer .close-icon").hide();
		}

		// Show Search
		$(".header-searchFormContainer").slideToggle("fast");
		$(".header-searchContainer .icon-search").toggle();
		$(".header-searchContainer .close-icon").toggle();
		$(".header-searchInputContainer .search-field").focus();
	});

	window.addEventListener('resize', function(event){
	  width = $(window).width();
	});

} )( jQuery );