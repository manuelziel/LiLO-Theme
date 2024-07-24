/**
 * Stick the navigation to the top of the page when scrolling
 *
 * @package LiLO
 */
// sticky-navigation.js
window.addEventListener('scroll', function() {
    let header = document.querySelector('.primary-navigation-wrap');
    let stickyOffset = window.pageYOffset || document.documentElement.scrollTop;
    var sticky = header.offsetTop;
  
    if (stickyOffset > sticky) {
      header.classList.add('fixed');
    } else {
      header.classList.remove('fixed');
    }
  });