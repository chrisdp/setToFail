/*jshint browser:true */
/*jshint devel:true */
/*globals TextboxValidator */

var setAge;
var validate;
(function() {
  'use strict';
  window.addEventListener('onload', onSetUp());

  var txtAge;
  var txtPrice;
  var form;
  var v1;
  var v2;
  function onSetUp(e) {
    txtAge = document.getElementById('txtAge');
    txtPrice = document.getElementById('txtPrice');

    v1 = new TextboxValidator(txtAge);
    v2 = new TextboxValidator(txtPrice);
    console.log(txtAge);
  }

  setAge = function(age) {
    console.log(age);
    txtAge.value = age;
  };

  validate = function() {
    console.log('i made it');
    if ((!v1.check()) || (!v2.check())) {
      console.log('I FAILED!');
      return false;
    }
  };
}());
