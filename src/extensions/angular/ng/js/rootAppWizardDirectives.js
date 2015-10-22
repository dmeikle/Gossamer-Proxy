module.directive('wizard', function($compile, $location, wizardSrv) {
  return {
    restricted:'E',
    scope:true,
    link: function(scope, element, attrs) {

      var apiPath = '/render/' + element[0].dataset.module + '/' + element[0].dataset.filename;

      scope.$parent.$parent.wizardLoading = true;

      wizardSrv.getWizardPages(apiPath).then(function() {
        scope.wizardPages = wizardSrv.wizardPages;
        for (var page in wizardSrv.wizardPages) {
          if (wizardSrv.wizardPages.hasOwnProperty(page)) {
            element[0].appendChild(scope.wizardPages[page]);
          }
        }
        $compile(element.contents())(scope);
        scope.$parent.$parent.wizardLoading = false;
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
