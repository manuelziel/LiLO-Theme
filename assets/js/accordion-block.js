/**
 * Accordion Navigation for Gutenberg Blocks
 *
 * @package LiLO
 */

// accordion-block.js
(function (blocks, element, editor) {
    const el = element.createElement;
    const InnerBlocks = editor.InnerBlocks;
    const RichText = editor.RichText;

    // Parsing the SVG icon once
    const iconHTML = new DOMParser().parseFromString(liloScreenReaderText.icon, 'text/html').body.firstElementChild;

    blocks.registerBlockType('custom/accordion', {
        title: 'Accordion',
        icon: 'list-view',
        category: 'layout',
        attributes: {
            title: { type: 'string', default: 'Accordion Title' },
        },
        edit: function (props) {
            function onChangeTitle(newTitle) {
                props.setAttributes({ title: newTitle });
            }

            return el(
                'div',
                { className: 'accordion' },
                el('div', { className: 'accordion-header' },
                    el('input', {
                        type: 'text',
                        value: props.attributes.title,
                        onChange: function (event) {
                            onChangeTitle(event.target.value);
                        },
                        placeholder: 'Accordion Title'
                    }),
                    el('span', { className: 'accordion-toggle', ref: function(span) {
                        if (span) {
                            span.innerHTML = ''; // Clear previous content
                            span.appendChild(iconHTML.cloneNode(true));
                        }
                    }})
                ),
                el('div', { className: 'accordion-content' },
                    el(InnerBlocks)
                )
            );
        },
        save: function (props) {
            return el(
                'div',
                { className: 'accordion' },
                el('div', { className: 'accordion-header' },
                    el(RichText.Content, {
                        value: props.attributes.title
                    }),
                    el('span', { className: 'accordion-toggle', ref: function(span) {
                        if (span) {
                            span.innerHTML = ''; // Clear previous content
                            span.appendChild(iconHTML.cloneNode(true));
                        }
                    }})
                ),
                el('div', { className: 'accordion-content' },
                    el(InnerBlocks.Content)
                )
            );
        }
    });
})(
    window.wp.blocks,
    window.wp.element,
    window.wp.blockEditor || window.wp.editor
);
