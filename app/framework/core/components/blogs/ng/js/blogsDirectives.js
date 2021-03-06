module.directive('getDepartment', function () {
    var departments = [{
            "id": "1",
            "name": "Accounting",
            "isActive": "1",
            "Departments_id": "1"
        }, {
            "id": "2",
            "name": "Administration",
            "isActive": "1",
            "Departments_id": "2"
        }, {
            "id": "3",
            "name": "Content Processing",
            "isActive": "1",
            "Departments_id": "3"
        }, {
            "id": "4",
            "name": "Construction",
            "isActive": "1",
            "Departments_id": "4"
        }, {
            "id": "5",
            "name": "Emergency",
            "isActive": "1",
            "Departments_id": "5"
        }, {
            "id": "6",
            "name": "Scoping",
            "isActive": "1",
            "Departments_id": "6"
        }];

    return {
        restrict: 'A',
        transclude: true,
        scope: false,
        replace: true,
        link: function (scope, element, attrs) {
            for (var department in departments) {
                if (departments.hasOwnProperty(department) && scope.$parent.staff) {
                    if (departments[department].id === scope.$parent.staff.Departments_id) {
                        element.text(departments[department].name);
                    }
                }
            }
        }
    };
});


module.directive('boolToString', function () {
    return {
        restrict: 'A',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
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

module.directive('blogsAdvancedSearchFilters', function (staffListSrv, $compile) {
    return {
        restrict: 'E',
        replace: true,
        scope: false,
        link: function (scope, element, attrs) {
            var fields = staffListSrv.advancedSearch.fields;
            for (var filter in fields) {
                if (fields.hasOwnProperty(filter)) {
                    element[0].appendChild(fields[filter]);
                }
            }
            $compile(element.contents())(scope);
        }
    };
});
