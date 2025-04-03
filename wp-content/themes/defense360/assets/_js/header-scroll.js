const header = document.querySelector('#masthead')
const headerHeight = header.offsetHeight // Get current header height
// Function to adjust the content's top margin based on the header's current height
function adjustContentMargin() {
  document.querySelector('#content').style.marginTop = `calc(${headerHeight}px + 2rem)` // Append "px"
}

// Function to handle scroll events and update header class based on scroll position
function handleScroll() {
  // const header = document.querySelector('#masthead')
  // const headerHeight = header.offsetHeight // Update header height dynamically

  if (window.scrollY > headerHeight) {
    header.classList.add('scrolled')
  } else {
    header.classList.remove('scrolled')
  }

  // Update content margin in case the header height changes during scroll
  adjustContentMargin()
}

// Initial adjustment once the DOM content is fully loaded
document.addEventListener('DOMContentLoaded', adjustContentMargin)

// Adjust margin on window resize as header dimensions may change
window.addEventListener('resize', adjustContentMargin)

// Listen for scroll events
window.addEventListener('scroll', handleScroll)
