/*jshint browser:true */
/*jshint devel:true */

function TextboxValidator(myTargetId, myColor) {
  // primative vars
  var regExp = new RegExp(/^\w$/);
  var errorColor = (myColor === undefined) ? '#FF0000' : myColor;

  // input text element
  var targetId = myTargetId;
  var defaultColor = myTargetId.style.borderColor;
  targetId.style.borderWidth = '1px';

  // -------------------------- gets / sets
  this.setRegExp = function(myRegExp) {
    regExp = myRegExp;
  };

  this.setErrorColor = function(myColor) {
    errorColor = myColor;
  };

  this.check = function() {
    var flag = regExp.test(targetId.value);

    targetId.style.borderColor = (flag) ? defaultColor : errorColor;
    targetId.style.Color = (flag) ? defaultColor : errorColor;

    return flag;
  };
}
