$(function () {
  $('select').material_select();
  $('#rangoPrecio').ionRangeSlider({type: 'double', min: 0, prefix: '$'});
});
