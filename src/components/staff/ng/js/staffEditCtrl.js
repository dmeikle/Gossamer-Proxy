module.controller('staffEditCtrl', function($scope, $location, staffSrv) {

  // Run on load
  $scope.loading = true;
  $scope.authorizationLoading = true;
  $scope.authorization = {};
  getStaffDetail();

  function getStaffDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    staffSrv.getStaffDetail(object).then(function() {
      $scope.staff = staffSrv.staffDetail;
      $scope.loading = false;

      staffSrv.getStaffCreds(object).then(function() {
        $scope.authorization.username = staffSrv.staffCreds.username;
        $scope.authorizationLoading = false;
      });
    });
  }

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    staffSrv.save(object, formToken).then(function() {
      getStaffDetail();
    });
  };

  $scope.discardChanges = function() {
    getStaffDetail();
  };

  $scope.submitCredentials = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.id = $scope.staff.id;
    switch (object.emailUser) {
      case true:
        staffSrv.generateEmailReset(object, formToken);
        break;
      default:
        staffSrv.saveCredentials(object, formToken).then(function(){
          $scope.credentialStatus = staffSrv.credentialStatus;
        });
    }
  };

  $scope.resetCredentials = function() {
    $scope.authorization.username = staffSrv.staffCreds.username;
    $scope.authorization.password = undefined;
    $scope.authorization.passwordConfirm = undefined;
  };

  $scope.clearErrors = function() {
    $scope.credentialStatus = undefined;
  };
});
