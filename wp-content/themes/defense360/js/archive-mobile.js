/**
 * Archive Mobile
 * Toggles the archive filtering
 */

( function( $ ) {

	function archiveFilterMobile() {
		var archiveEl = $(".archive-searchFilter");
		var width = $(window).width();

		if(archiveEl.length && width < 767) {
			$(".archive-searchFilter ul li:first-child").click(function() {
				$(".archive-searchFilter ul li:first-child").toggleClass("mobile-active");
				$(".archive-searchFilter ul").children().not(":first-child").toggle();
			});
		}
	}

	archiveFilterMobile();

	window.addEventListener('resize', function(event){
	  width = $(window).width();
	  archiveFilterMobile();

	  if(width > 766) {
	  	$(".archive-searchFilter ul").children().show();
	  }
	});

} )( jQuery );
