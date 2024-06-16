/**
 * Accordion Navigation
 *
 * @package LiLO
 */
// accordion.js
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.accordion .accordion-header').forEach(function (accordionHeader) {
        var toggle = accordionHeader.querySelector('.accordion-toggle');
        accordionHeader.addEventListener('click', function () {
            const accordionContent = this.nextElementSibling;

            // Toggle the "open" class
            accordionContent.classList.toggle('open');

            if (this.classList.toggle('open')) {
                toggle.textContent = '-';
            } else {
                toggle.textContent = '+';
            }
        });
    });
});
