
const header = document.querySelector('#masthead')
const pageHeaderHeight = header.offsetHeight - 1
console.log(pageHeaderHeight)
// Listen for scroll events
window.addEventListener("scroll", function() {
  // const header = document.querySelector("header");
  console.log(window.scrollY)
  if (window.scrollY > pageHeaderHeight) {
    header.classList.add("scrolled");
  } else {
    header.classList.remove("scrolled");
  }
});

