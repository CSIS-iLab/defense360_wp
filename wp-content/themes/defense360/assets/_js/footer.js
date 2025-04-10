(function () {
  const footer = document.querySelector('#colophon')
  const content = document.querySelector('#content')

  // Setup event listeners to adjust the content's bottom margin based on the footer's height
  document.addEventListener(
    'DOMContentLoaded',
    () => (content.style.marginBottom = footer.offsetHeight - 1 + 'px')
  )
  window.addEventListener(
    'resize',
    () => (content.style.marginBottom = footer.offsetHeight - 1 + 'px')
  )
})()
