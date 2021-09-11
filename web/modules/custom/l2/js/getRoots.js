/**
 * @file
 * calculates roots of quadratic equation.
 */

(function ($, Drupal, drupalSettings) {

  'use strict';

  function calcRoots(a, b, c) {
    let d = b * b - 4 * a * c;
    if (d < 0) {
      return null;
    }
    let x1 = (-b + Math.sqrt(d)) / (2 * a);
    let x2 = (-b - Math.sqrt(d)) / (2 * a);
    return {x1: x1, x2: x2}
  }

  /**
   * Attaches the JS test behavior to calculate .
   */
  Drupal.behaviors.getRoots = {
    attach: function (context, settings) {
      if (context.parentElement == null) {
        let rows = context.querySelectorAll('.l2-table tbody .row');
        for (let i = 0; i < rows.length; i++) {
          let a = rows[i].querySelector('.a').innerText;
          let b = rows[i].querySelector('.b').innerText;
          let c = rows[i].querySelector('.c').innerText;
          let roots = calcRoots(a, b, c);
          let msg = (roots === null) ? '<span class="no-roots">No roots</span>' : 'x1 = ' + roots.x1 + ', x2 = ' + roots.x2;
          rows[i].querySelector('.roots').innerHTML = msg;
        }
      }
    }
  };
})(jQuery, Drupal, drupalSettings);
