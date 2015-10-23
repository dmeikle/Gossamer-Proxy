module.directive('wizard', function($compile, $location, wizardSrv) {
    return {
        restricted: 'E',
        scope: false,
        link: function(scope, element, attrs) {
            wizardSrv.wizardLoading = true;

            var apiPath = '/render/' + element[0].dataset.module + '/' + element[0].dataset.filename;

            wizardSrv.getWizardPages(apiPath).then(function() {
                scope.wizardPages = wizardSrv.wizardPages;
                for (var page in wizardSrv.wizardPages) {
                    if (wizardSrv.wizardPages.hasOwnProperty(page)) {
                        element[0].appendChild(scope.wizardPages[page]);
                    }
                }
                wizardSrv.wizardLoading = false;
                $compile(element.contents())(scope);
            });
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