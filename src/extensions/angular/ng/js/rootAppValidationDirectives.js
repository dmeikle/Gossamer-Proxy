module.directive('formGroup', function($compile) {
    return {
        restrict: 'C',
        link: function(scope, element, attrs) {            
            var nodes = element[0].getElementsByTagName('input');
            var classes = {};
            for (var i = nodes.length - 1; i >= 0; i--) {
                if (nodes[i].hasAttribute('uib-typeahead')) {
                    return;
                }
                var el = nodes[i];
                if (el.attributes && el.attributes['ng-model']) {
                    var model = el.attributes['ng-model'].value.slice(el.attributes['ng-model'].value.lastIndexOf('.') + 1);
                    if (i === 0) {
                        classes['has-error'] = 'hasError.' + model;
                    } else {
                        classes['has-error'] += '|| hasError.' + model;
                    }
                }
            }

            // TODO: Change how compile works to stop uiBootstrap throwing console errors

            attrs.$set('ng-class', '{\'has-error\':' + classes['has-error'] +'}');
            var oldClasses = attrs.class;            
            // var oldChildren = angular.element(element.html());
            attrs.$set('class', '');
            // element.empty();
            $compile(element)(scope);
            attrs.$set('class', oldClasses);
            // element.append(oldChildren);
            // $compile(element.contents())(scope);
        },
        controller: function($rootScope, $scope) {
            $scope.$on('errors', function(event, errors) {
                $scope.hasError = errors;
            });
        }
    };
});