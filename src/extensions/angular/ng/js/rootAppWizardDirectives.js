module.directive('addNewWizard', function($compile, $location, addNewWizardSrv) {
  return {
    restricted:'E',
    scope:false,
    link: function(scope, element, attrs) {
      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath;
      if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
      } else {
        apiPath = a.pathname.slice(0, -1);
      }

      scope.loading = true;

      addNewWizardSrv.getWizardPages(apiPath).then(function() {
        scope.loading = false;
        scope.wizardPages = addNewWizardSrv.wizardPages;
      });
    },
    controller: function($scope) {
      $scope.page = 0;

      $scope.nextPage = function(currentPage) {
        $scope.page++;
        for (var page in $scope.wizardPages) {
          if ($scope.wizardPages.hasOwnProperty(page) && $scope.wizardPages[page].dataset.page === $scope.page) {
            $scope.visiblePage = $scope.wizardPages[page];
          }
        }
      };

      $scope.prevPage = function(currentPage) {
        $scope.page--;
        for (var page in $scope.wizardPages) {
          if ($scope.wizardPages.hasOwnProperty(page) && $scope.wizardPages[page].dataset.page === $scope.page) {
            $scope.visiblePage = $scope.wizardPages[page];
          }
        }
      };
    }
  };
});
