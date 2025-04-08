/**
 * Mobile Navigation
 * Toggles the mobile menu and the search bar
 */

(function ($) {
  var width = $(window).width()

  // Click on menu icon to toggle menu classes
  $('.header-mobileContainer').click(function () {
    $('.navigation-container').toggleClass('active')
    $('body, .site-header').toggleClass('menu-mobile-active')
    $('.header-mobileContainer .icon-menu').toggle()
    $('.header-mobileContainer .close-icon').toggle()

    // Hide Search by removing the active class
    $('.header-searchFormContainer').removeClass('active')
    $('.header-searchContainer .icon-search').show()
    $('.header-searchContainer .close-icon').hide()
  })

  // Toggle Search
  $(
    '.header-searchContainer .icon-search, .nav-searchIconContainer .icon-search, .search-closeContainer .close-icon, .header-searchContainer .close-icon'
  ).click(function () {
    if (width < 770) {
      // Hide Menu
      $('.navigation-container').removeClass('active')
      $('body, .site-header').removeClass('menu-mobile-active')
      $('.header-mobileContainer .icon-menu').show()
      $('.header-mobileContainer .close-icon').hide()
    }

    // Toggle search form appearance via its CSS active class
    $('.header-searchFormContainer').toggleClass('active')
    $('.header-searchContainer .icon-search').toggle()
    $('.header-searchContainer .close-icon').toggle()
    $('.header-searchInputContainer .search-field').focus()
  })

  $(window).on('resize', function () {
    width = $(window).width()
  })
})(jQuery)
