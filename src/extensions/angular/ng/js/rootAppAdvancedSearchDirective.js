
module.directive('advancedSearchFilters', function ($compile) {
    return {
        restrict: 'E',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
            var fields = scope.$parent[attrs.service].advancedSearch.fields;
            for (var filter in fields) {
                if (fields.hasOwnProperty(filter)) {
                    element[0].appendChild(fields[filter]);
                }
            }
            $compile(element.contents())(scope);
        }
    };
});
