module.directive('advancedSearchFilters', function($compile) {
    return {
        restrict: 'E',
        replace: true,
        scope: false,
        link: function(scope, element, attrs) {
            var parentScope = scope.$parent;
            parentScope.sidePanelLoading = true;
            var service = parentScope[attrs.service];
            var fields = service.advancedSearch.fields;
            if (!fields) {
                service.getAdvancedSearchFilters().then(function() {
                    fields = service.advancedSearch.fields;
                    for (var filter in fields) {
                        if (fields.hasOwnProperty(filter)) {
                            element[0].appendChild(fields[filter]);
                        }
                    }
                    $compile(element.contents())(scope);

                    parentScope.sidePanelLoading = false;
                });
            } else {
                for (var filter in fields) {
                    if (fields.hasOwnProperty(filter)) {
                        element[0].appendChild(fields[filter]);
                    }
                }
                $compile(element.contents())(scope);

                parentScope.sidePanelLoading = false;

            }
        }
    };
});