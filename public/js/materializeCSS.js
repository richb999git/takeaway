document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.collapsible');
    var options = {accordion: false};
    var instances = M.Collapsible.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var options = {};
  var instances = M.Sidenav.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.slider');
  var options = {height: 600, indicators: true};
  var instances = M.Slider.init(elems, options);
});