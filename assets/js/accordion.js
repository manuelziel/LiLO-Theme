/**
 * Accordion Navigation
 *
 * @package LiLO
 */
// accordion.js
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.accordion .accordion-header').forEach(function (accordionHeader) {
        let toggle = accordionHeader.querySelector('.accordion-toggle');
        let icon = new DOMParser().parseFromString(liloScreenReaderText.icon, 'text/html').body.firstElementChild;

        // Set initial aria-expanded attribute and append icon.
        accordionHeader.setAttribute('aria-expanded', 'false');
        toggle.appendChild(icon);

        accordionHeader.addEventListener('click', function () {
            const accordionContent = this.nextElementSibling;
            const isExpanded = this.getAttribute('aria-expanded') === 'true';

            // Toggle aria-expanded attribute.
            this.setAttribute('aria-expanded', !isExpanded);

            // Toggle the "open" class for content and header.
            accordionContent.classList.toggle('open');
            this.classList.toggle('open');
        });
    });
});