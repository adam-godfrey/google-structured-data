define(['jquery'], function($) {
  'use strict';

  return function() {
    $.validator.addMethod(
      'validate-latitude',
      function(value, element) {
        var patt = new RegExp(/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/);
        return patt.test(value);
      },
      $.mage.__('Please enter a valid latitide')
    );
    $.validator.addMethod(
      'validate-longitude',
      function(value, element) {
        var patt = new RegExp(/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/);
        return patt.test(value);
      },
      $.mage.__('Please enter a valid longitude')
    );
  }
});