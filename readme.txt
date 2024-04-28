=== LiLO Theme ===
Author URI: https://liste-lebenswerte-ortenau.de
Theme URI: https://liste-lebenswerte-ortenau.de
Contributors: LiLO
Tags: one-column, blog, news, custom-background, custom-logo, custom-header, custom-menu, grid-layout, entertainment, editor-style, block-styles, block-patterns, rtl-language-support, featured-image-header, featured-images, flexible-header, custom-colors, full-width-template, sticky-post, threaded-comments, translation-ready, theme-options, two-columns, three-columns
Requires at least: 5.2
Tested up to: 6.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Child Theme: Dynamico 1.1.4

This theme, like WordPress, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned with others.

Customized styles and functions by Manuel Ziel.

== Description ==
This Theme is a Child-Theme of Dynamico. Used for LiLO (Liste Lebenswerte Ortenau) 
and LHL (Liste Haslach Lebenswert).

Current base funtions:
- Remove categories on home feed. To remove set the current ID's in the functions.php code.
- Extra Styles: 
    - theme 
    - PayPal button style
    - responsive style
    - plugins (Tribe Events)

Roadmap:
- Add search form in the menu  
- Add function add_anchor_to_headings to set all headings as anchor

== Installation ==

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Click on the 'Upload Theme' button to upload the Zip-File of the theme.

== Examples ==

Anker:
Use https://liste-lebenswerte-ortenau.de/example-site-or-article/#example-headline
Unwanted characters are ÄäÖöÜüß and convert it to ae oe ue , but allows umlauts and ß 

Button Paypal:
Use [lilo_paypal_donate_button] as shortcode for LiLO.
Use [lhl_paypal_donate_button] as shortcode for LHL.

== Changelog ==
Semantic Versioning -> https://semver.org/

= 1.2.0 - 2024-04-26 =
- Add PayPal button shortcode
- Add PayPal button for LHL
- Add custom footer copyright
- Add anker to any headline

= 1.1.0 - 2024-04-15 =
- Add PayPal button style
- Fix styles header main

= 1.0.1 - 2024-04-13 =
- FIX css-styles and remove old styles from custromizer

= 1.0.0 - 2024-03-11 =
- Add exclude specific categories from home feed