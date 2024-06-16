/**
 * Scroll to Top Button
 *
 * @package LiLO
 */
// scroll-to-top.js
document.addEventListener('DOMContentLoaded', function() {
    let scrollTopButton = document.getElementById('scroll-to-top');
    let footer = document.querySelector('footer'); 

    window.addEventListener('scroll', function() {
        let footerOffsetTop = footer.offsetTop;
        let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        let windowHeight = window.innerHeight;
        let buttonHeight = 20;

        // Button appears after scrolling down
        if (scrollTop > 200) {
            scrollTopButton.style.display = 'block';
        } else {
            scrollTopButton.style.display = 'none';
        }

        // Button stops at footer
        if (scrollTop + windowHeight > footerOffsetTop) {
            scrollTopButton.style.bottom = (scrollTop + windowHeight - footerOffsetTop - buttonHeight) + 'px';
        } else {
            scrollTopButton.style.bottom = '20px';
        }
    });

    scrollTopButton.addEventListener('click', function() {
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
});
