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

// Function to adjust the content's top margin based on the header's current height
function adjustContentMargin() {
  const remPixels = parseFloat(
    getComputedStyle(document.documentElement).fontSize
  )

  if (window.innerWidth < 770) {
    content.style.marginTop = header.offsetHeight + 'px'
  } else {
    content.style.marginTop = unscrolledHeaderHeight + 2 * remPixels + 'px'
  }
}

// Function to handle scroll events and update header class based on scroll position
function handleScroll() {
  const currentHeaderHeight = header.offsetHeight
  if (window.scrollY > currentHeaderHeight) {
    header.classList.add('scrolled')
  } else {
    header.classList.remove('scrolled')
  }

  // Update content margin in case the header height changes during scroll
  adjustContentMargin()
}

// Initial adjustment once the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', () => {
  updateUnscrolledHeaderHeight()
  adjustContentMargin()
})
// Adjust margin on window resize as header dimensions may change
window.addEventListener('resize', () => {
  updateUnscrolledHeaderHeight()
  adjustContentMargin()
})
// Listen for scroll events
window.addEventListener('scroll', handleScroll)
