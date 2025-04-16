;(function () {
  const header = document.querySelector('#masthead')
  const content = document.querySelector('#content')
  let unscrolledHeaderHeight = header.offsetHeight // store initial header height

  // Helper to update unscrolled header height if needed.
  function updateUnscrolledHeaderHeight() {
    // Remove the scrolled class temporarily if present, measure, then restore it.
    const wasScrolled = header.classList.contains('scrolled')
    if (wasScrolled) {
      header.classList.remove('scrolled')
    }
    unscrolledHeaderHeight = header.offsetHeight
    if (wasScrolled) {
      header.classList.add('scrolled')
    }
  }

  // Adjust the content's top margin based on the header's current height
  function adjustContentMarginTop() {
    const remPixels = parseFloat(
      getComputedStyle(document.documentElement).fontSize
    )

    if (window.innerWidth < 770) {
      content.style.marginTop = header.offsetHeight + 'px'
    } else {
      content.style.marginTop = unscrolledHeaderHeight + 2 * remPixels + 'px'
    }
  }

  // Handle scroll events to update header class and margin-top
  function handleScroll() {
    const currentHeaderHeight = header.offsetHeight
    if (window.scrollY > currentHeaderHeight) {
      header.classList.add('scrolled')
    } else {
      header.classList.remove('scrolled')
    }

    // Update the top margin in case the header height changes
    adjustContentMarginTop()
  }

  // Setup event listeners
  document.addEventListener('DOMContentLoaded', () => {
    updateUnscrolledHeaderHeight()
    adjustContentMarginTop()
  })
  window.addEventListener('resize', () => {
    updateUnscrolledHeaderHeight()
    adjustContentMarginTop()
  })
  window.addEventListener('scroll', handleScroll)
})()
