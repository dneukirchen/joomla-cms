/**
* PLEASE DO NOT MODIFY THIS FILE.
* WORK ON THE ES6 VERSION.
* OTHERWISE YOUR CHANGES WILL BE REPLACED ON THE NEXT BUILD.
**/

/**
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

Joomla = window.Joomla || {};

(function (Joomla, document) {
  document.addEventListener('DOMContentLoaded', function () {
    var modalAssociationsOptions = Joomla.getOptions('modal-associations');
    if (modalAssociationsOptions) {
      var functionName = modalAssociationsOptions.func;
      var links = [].slice.call(document.querySelectorAll('.select-link'));

      links.forEach(function (item) {
        item.addEventListener('click', function (event) {
          if (window.self !== window.top) {
            // Run function on parent window.
            window.parent[functionName](event.target.getAttribute('data-id'));
          }
        });
      });
    }
  });
})();