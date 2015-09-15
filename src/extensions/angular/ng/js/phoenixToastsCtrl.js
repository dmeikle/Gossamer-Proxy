module.controller('toastsCtrl', function($scope, toastsSrv) {

  $scope.addNewAlert = toastsSrv.newAlert;

  $scope.alerts = toastsSrv.alerts;

  $scope.dismissAlert = toastsSrv.dismissAlert;

});
