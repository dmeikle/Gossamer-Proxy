module.directive('boolToString', function() {
  return {
    restrict: 'A',
    replace: true,
    scope: false,
    link: function(scope, element, attrs) {
      switch (attrs.value) {
        case '0':
          element[0].innerText = 'No';
        break;
        default:
          element[0].innerText = 'Yes';

      }
    }
  };
});
