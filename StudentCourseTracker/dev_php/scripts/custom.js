/*jshint browser:true */
/*jshint devel:true */
/*global $:false */

$(document).on('change', '.btn-file :file', function() {
  var input = $(this);
  var numFiles = input.get(0).files ? input.get(0).files.length : 1;
  var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
  input.trigger('fileselect', [numFiles, label]);
});

$(document).ready(function() {
  $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
    if ($(this).get(0).files[0].size < 2097000) {
      var input = $(this).parents('.input-group').find(':text');
      var log = numFiles > 1 ? numFiles + ' files selected' : label;
      console.log(input.length);
      if (input.length) {
        input.val(log);
      } else {
        if (log) {
          alert(log);
        }
      }
    } else {
      //TODO #8 add cross browser validations!
      $(this).val('').clone(true);
      $(this).attr('oninvalid', 'this.setCustomValidity(\'Error: file selected is larger then 2MB\')');

      $(this).reportValidity();
      //$(this).setCustomValidity('Please select a photo');
      //alert('Sorry, the file is to large.<br>' +
      //      'Please use a file smaller then 2MB.');
    }

  });
});

// TODO #4 revisit to cascade changes to previous selects if selected is changed a second time
$('select').change(function() {
  var id = $(this).attr('id');
  var nextSelect = (parseInt(id.charAt(0)) + 1) + 'course';
  $('#' + nextSelect).html(''); //Clear
  $('#' + id + ' option:not(:selected)')
    .clone()
    .appendTo('#' + nextSelect);
});
