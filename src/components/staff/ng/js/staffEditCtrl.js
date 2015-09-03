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

      staffSrv.getStaffCreds(object).then(function(){
        $scope.authorization.username = staffSrv.staffCreds.username;
        $scope.authorizationLoading = false;
      });
    });


  }

  // $scope.checkUsernameExists = function(object) {
  //   object.id = $scope.staff.id;
  //   staffSrv.checkUsernameExists(object).then(function(){
  //     StaffAuthorization_username.$setValidity(staffSrv.usernameExists);
  //   });
  // };

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    staffSrv.save(object, formToken).then(function() {
      getStaffDetail();
    });
  };

  $scope.discardChanges = function() {
    getStaffDetail();
  };
});
