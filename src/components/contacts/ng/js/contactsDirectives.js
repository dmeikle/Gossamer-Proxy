

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

module.directive('contactsAdvancedSearchFilters', function(contactsListSrv, $compile) {
  return {
    restrict:'E',
    replace:true,
    scope:false,
    link: function(scope, element, attrs) {
      var fields = contactsListSrv.advancedSearch.fields;
      for (var filter in fields) {
        if (fields.hasOwnProperty(filter)) {
          element[0].appendChild(fields[filter]);
        }
      }
      $compile(element.contents())(scope);
    }
  };
});
