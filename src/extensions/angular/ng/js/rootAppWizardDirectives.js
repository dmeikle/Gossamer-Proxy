module.directive('addNewWizard', function($compile, $location, addNewWizardSrv) {
  return {
    restricted:'E',
    scope:false,
    link: function(scope, element, attrs) {

      var apiPath = '/render/' + element[0].dataset.module + '/addNewWizardPages';

      scope.modalLoading = true;

      if (!addNewWizardSrv.wizardPages) {
        addNewWizardSrv.getWizardPages(apiPath).then(function() {
          scope.wizardPages = addNewWizardSrv.wizardPages;
          element[0].appendChild(scope.wizardPages[0]);
          $compile(element.contents())(scope);
          scope.modalLoading = false;
        });
      }
    },
    controller: function($scope) {
      $scope.currentPage = 0;
      var wizard = document.getElementsByTagName('add-new-wizard')[0];

      $scope.nextPage = function() {
        $scope.currentPage++;
        switchPage();
      };

      $scope.prevPage = function() {
        $scope.currentPage--;
        switchPage();
      };

      var switchPage = function() {
        while (wizard.firstChild) {
          wizard.removeChild(wizard.firstChild);
        }
        wizard.appendChild($scope.wizardPages[$scope.currentPage]);
        $compile(wizard.children)($scope);
      };
    }
  };
});
