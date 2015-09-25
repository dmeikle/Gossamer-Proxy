module.directive('createNewWizard', function($compile, $location) {
  return {
    restricted:'E',
    scope:false,
    link: function(scope, element, attrs) {

    },
    controller: function($scope, createNewWizardSrv) {
      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath;
      if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
      } else {
        apiPath = a.pathname.slice(0, -1);
      }


    }
  };
});
