/**
 * Page Template Switcher
 * 
 * Unminified ES6 source code available in page-template-switcher.src.js
 * 
 * @package LiLO
 */
!function(e){function t(n){if(o[n])return o[n].exports;var r=o[n]={i:n,l:!1,exports:{}};return e[n].call(r.exports,r,r.exports,t),r.l=!0,r.exports}var o={};t.m=e,t.c=o,t.d=function(e,o,n){t.o(e,o)||Object.defineProperty(e,o,{configurable:!1,enumerable:!0,get:n})},t.n=function(e){var o=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(o,"a",o),o},t.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},t.p="",t(t.s=0)}([function(e,t){function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function n(e,t){if(!e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return!t||"object"!==typeof t&&"function"!==typeof t?e:t}function r(e,t){if("function"!==typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function, not "+typeof t);e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,enumerable:!1,writable:!0,configurable:!0}}),t&&(Object.setPrototypeOf?Object.setPrototypeOf(e,t):e.__proto__=t)}var a=function(){function e(e,t){for(var o=0;o<t.length;o++){var n=t[o];n.enumerable=n.enumerable||!1,n.configurable=!0,"value"in n&&(n.writable=!0),Object.defineProperty(e,n.key,n)}}return function(t,o,n){return o&&e(t.prototype,o),n&&e(t,n),t}}(),i=wp.plugins.registerPlugin,l=wp.element.Component,p=wp.compose.compose,s=wp.data.withSelect,u=function(e){function t(){return o(this,t),n(this,(t.__proto__||Object.getPrototypeOf(t)).apply(this,arguments))}return r(t,e),a(t,[{key:"componentDidUpdate",value:function(){var e=this.props,t=e.pageTemplate,o=e.postType;if(!o||"page"!==o.slug)return null;var n="lilo-fullwidth-page-layout",r="lilo-page-title-hidden";"templates/template-fullwidth.php"===t?(document.body.classList.add(n),document.body.classList.remove(r)):"templates/template-no-title.php"===t?(document.body.classList.add(r),document.body.classList.remove(n)):"templates/template-fullwidth-no-title.php"===t?(document.body.classList.add(n),document.body.classList.add(r)):"templates/template-sidebar-left-no-title.php"===t?(document.body.classList.add(r),document.body.classList.remove(n)):"templates/template-sidebar-right-no-title.php"===t?(document.body.classList.add(r),document.body.classList.remove(n)):(document.body.classList.remove(n),document.body.classList.remove(r))}},{key:"render",value:function(){return null}}]),t}(l);i("lilo-page-template-switcher",{render:p(s(function(e){var t=e("core/editor"),o=t.getEditedPostAttribute,n=e("core"),r=n.getPostType;return{pageTemplate:o("template"),postType:r(o("type"))}}))(u)})}]);
