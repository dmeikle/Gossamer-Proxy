

module.directive('subcontractorsAdvancedSearchFilters', function (subcontractorsListSrv, $compile) {
    return {
        restrict: 'E',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
            var fields = subcontractorsListSrv.advancedSearch.fields;
            console.log(subcontractorsListSrv.advancedSearch);
            for (var filter in fields) {
                if (fields.hasOwnProperty(filter)) {
                    element[0].appendChild(fields[filter]);
                }
            }
            $compile(element.contents())(scope);
        }
    };
});