/* Source and licensing information for the line(s) below can be found at https://devpanecom.digissol.pro/core/assets/vendor/tabbable/index.umd.min.js. */
/*!
* tabbable 5.3.2
* @license MIT, https://github.com/focus-trap/tabbable/blob/master/LICENSE
*/
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?t(exports):"function"==typeof define&&define.amd?define(["exports"],t):(e="undefined"!=typeof globalThis?globalThis:e||self,function(){var n=e.tabbable,o=e.tabbable={};t(o),o.noConflict=function(){return e.tabbable=n,o}}())}(this,(function(e){"use strict";var t=["input","select","textarea","a[href]","button","[tabindex]:not(slot)","audio[controls]","video[controls]",'[contenteditable]:not([contenteditable="false"])',"details>summary:first-of-type","details"],n=t.join(","),o="undefined"==typeof Element,r=o?function(){}:Element.prototype.matches||Element.prototype.msMatchesSelector||Element.prototype.webkitMatchesSelector,i=!o&&Element.prototype.getRootNode?function(e){return e.getRootNode()}:function(e){return e.ownerDocument},a=function(e,t,o){var i=Array.prototype.slice.apply(e.querySelectorAll(n));return t&&r.call(e,n)&&i.unshift(e),i=i.filter(o)},l=function e(t,o,i){for(var a=[],l=Array.from(t);l.length;){var u=l.shift();if("SLOT"===u.tagName){var c=u.assignedElements(),d=e(c.length?c:u.children,!0,i);i.flatten?a.push.apply(a,d):a.push({scope:u,candidates:d})}else{r.call(u,n)&&i.filter(u)&&(o||!t.includes(u))&&a.push(u);var f=u.shadowRoot||"function"==typeof i.getShadowRoot&&i.getShadowRoot(u);if(f){var s=e(!0===f?u.children:f.children,!0,i);i.flatten?a.push.apply(a,s):a.push({scope:u,candidates:s})}else l.unshift.apply(l,u.children)}}return a},u=function(e,t){return e.tabIndex<0&&(t||/^(AUDIO|VIDEO|DETAILS)$/.test(e.tagName)||e.isContentEditable)&&isNaN(parseInt(e.getAttribute("tabindex"),10))?0:e.tabIndex},c=function(e,t){return e.tabIndex===t.tabIndex?e.documentOrder-t.documentOrder:e.tabIndex-t.tabIndex},d=function(e){return"INPUT"===e.tagName},f=function(e){return function(e){return d(e)&&"radio"===e.type}(e)&&!function(e){if(!e.name)return!0;var t,n=e.form||i(e),o=function(e){return n.querySelectorAll('input[type="radio"][name="'+e+'"]')};if("undefined"!=typeof window&&void 0!==window.CSS&&"function"==typeof window.CSS.escape)t=o(window.CSS.escape(e.name));else try{t=o(e.name)}catch(e){return console.error("Looks like you have a radio button with a name attribute containing invalid CSS selector characters and need the CSS.escape polyfill: %s",e.message),!1}var r=function(e,t){for(var n=0;n<e.length;n++)if(e[n].checked&&e[n].form===t)return e[n]}(t,e.form);return!r||r===e}(e)},s=function(e){var t=e.getBoundingClientRect(),n=t.width,o=t.height;return 0===n&&0===o},p=function(e,t){return!(t.disabled||function(e){return d(e)&&"hidden"===e.type}(t)||function(e,t){var n=t.displayCheck,o=t.getShadowRoot;if("hidden"===getComputedStyle(e).visibility)return!0;var a=r.call(e,"details>summary:first-of-type")?e.parentElement:e;if(r.call(a,"details:not([open]) *"))return!0;var l=i(e).host,u=(null==l?void 0:l.ownerDocument.contains(l))||e.ownerDocument.contains(e);if(n&&"full"!==n){if("non-zero-area"===n)return s(e)}else{if("function"==typeof o){for(var c=e;e;){var d=e.parentElement,f=i(e);if(d&&!d.shadowRoot&&!0===o(d))return s(e);e=e.assignedSlot?e.assignedSlot:d||f===e.ownerDocument?d:f.host}e=c}if(u)return!e.getClientRects().length}return!1}(t,e)||function(e){return"DETAILS"===e.tagName&&Array.prototype.slice.apply(e.children).some((function(e){return"SUMMARY"===e.tagName}))}(t)||function(e){if(/^(INPUT|BUTTON|SELECT|TEXTAREA)$/.test(e.tagName))for(var t=e.parentElement;t;){if("FIELDSET"===t.tagName&&t.disabled){for(var n=0;n<t.children.length;n++){var o=t.children.item(n);if("LEGEND"===o.tagName)return!!r.call(t,"fieldset[disabled] *")||!o.contains(e)}return!0}t=t.parentElement}return!1}(t))},h=function(e,t){return!(f(t)||u(t)<0||!p(e,t))},m=t.concat("iframe").join(",");e.focusable=function(e,t){return(t=t||{}).getShadowRoot?l([e],t.includeContainer,{filter:p.bind(null,t),flatten:!0,getShadowRoot:t.getShadowRoot}):a(e,t.includeContainer,p.bind(null,t))},e.isFocusable=function(e,t){if(t=t||{},!e)throw new Error("No node provided");return!1!==r.call(e,m)&&p(t,e)},e.isTabbable=function(e,t){if(t=t||{},!e)throw new Error("No node provided");return!1!==r.call(e,n)&&h(t,e)},e.tabbable=function(e,t){return function e(t){var n=[],o=[];return t.forEach((function(t,r){var i=!!t.scope,a=i?t.scope:t,l=u(a,i),c=i?e(t.candidates):a;0===l?i?n.push.apply(n,c):n.push(a):o.push({documentOrder:r,tabIndex:l,item:t,isScope:i,content:c})})),o.sort(c).reduce((function(e,t){return t.isScope?e.push.apply(e,t.content):e.push(t.content),e}),[]).concat(n)}((t=t||{}).getShadowRoot?l([e],t.includeContainer,{filter:h.bind(null,t),flatten:!1,getShadowRoot:t.getShadowRoot}):a(e,t.includeContainer,h.bind(null,t)))},Object.defineProperty(e,"__esModule",{value:!0})}));
//# sourceMappingURL=index.umd.min.js.map

/* Source and licensing information for the above line(s) can be found at https://devpanecom.digissol.pro/core/assets/vendor/tabbable/index.umd.min.js. */