module.controller('staffEditCtrl', function($scope, $location, staffEditSrv) {

  // Run on load
  $scope.loading = true;
  $scope.authorizationLoading = true;
  $scope.authorization = {};
  getStaffDetail();

  function getStaffDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    staffEditSrv.getStaffDetail(object).then(function() {
      $scope.staff = staffEditSrv.staffDetail;
      $scope.loading = false;

      staffEditSrv.getStaffCreds(object).then(function() {
        $scope.authorization.username = staffEditSrv.staffCreds.username;
        $scope.authorizationLoading = false;
      });
    });
  }

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    staffEditSrv.save(object, formToken).then(function() {
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
        staffEditSrv.generateEmailReset(object, formToken);
        break;
      default:
        staffEditSrv.saveCredentials(object, formToken).then(function(){
          $scope.credentialStatus = staffEditSrv.credentialStatus;
        });
    }
  };

  $scope.resetCredentials = function() {
    $scope.authorization.username = staffEditSrv.staffCreds.username;
    $scope.authorization.password = undefined;
    $scope.authorization.passwordConfirm = undefined;
  };

  $scope.clearErrors = function() {
    $scope.credentialStatus = undefined;
  };
});
