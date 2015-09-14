module.controller('toastsCtrl', function($scope, toastsSrv) {
  $scope.toasterService = toastsSrv;

  $scope.$watch('toasterService.alerts', function() {

  });
});
