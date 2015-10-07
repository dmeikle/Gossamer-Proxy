

module.directive('companyAdvancedSearchFilters', function(companyListSrv, $compile) {
  return {
    restrict:'E',
    replace:true,
    scope:false,
    link: function(scope, element, attrs) {
      var fields = companyListSrv.advancedSearch.fields;
      console.log(companyListSrv.advancedSearch);
      for (var filter in fields) {
        if (fields.hasOwnProperty(filter)) {
          element[0].appendChild(fields[filter]);
        }
      }
      $compile(element.contents())(scope);
    }
  };
});