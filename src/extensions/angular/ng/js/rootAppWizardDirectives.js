module.directive('wizard', function($compile, $location, wizardSrv) {
    return {
        restricted: 'E',
        scope: false,
        link: function(scope, element, attrs) {


            var apiPath = '/render/' + element[0].dataset.module + '/' + element[0].dataset.filename;
            if(element[0].dataset.params) {
                apiPath += '?' + element[0].dataset.params;
            }
            scope.wizardLoading = true;
            if (!scope.$parent.wizardPages) {
                wizardSrv.getWizardPages(apiPath).then(function() {
                    scope.$parent.wizardPages = wizardSrv.wizardPages;
                    for (var page in wizardSrv.wizardPages) {
                        if (wizardSrv.wizardPages.hasOwnProperty(page)) {
                            element[0].appendChild(scope.$parent.wizardPages[page]);
                        }
                    }
                    $compile(element.contents())(scope);
                    scope.wizardLoading = false;
                });
            } else {

                for (var page in wizardSrv.wizardPages) {
                    if (wizardSrv.wizardPages.hasOwnProperty(page)) {
                        element[0].appendChild(scope.$parent.wizardPages[page]);
                    }
                }
                wizardSrv.wizardLoading = false;
                $compile(element.contents())(scope);

                scope.wizardLoading = false;
            }

        },
        controller: function($scope) {
            $scope.currentPage = 0;
            var wizard = document.getElementsByTagName('wizard')[0];

            $scope.nextPage = function() {
                $scope.currentPage = $scope.currentPage + 1;
            };

            $scope.prevPage = function() {
                $scope.currentPage = $scope.currentPage - 1;
            };
        }
    };
});
