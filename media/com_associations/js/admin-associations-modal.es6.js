/**
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

Joomla = window.Joomla || {};

((Joomla, document) => {
  document.addEventListener('DOMContentLoaded', () => {
    const modalAssociationsOptions = Joomla.getOptions('modal-associations');
    if (modalAssociationsOptions) {
      const functionName = modalAssociationsOptions.func;
      const links = [].slice.call(document.querySelectorAll('.select-link'));

      links.forEach((item) => {
        item.addEventListener('click', (event) => {
          if (window.self !== window.top) {
            // Run function on parent window.
            window.parent[functionName](event.target.getAttribute('data-id'));
          }
        });
      });
    }
  });
})();
