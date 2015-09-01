module.controller('staffEditCtrl', function($scope, $location, staffSrv) {

  // Run on load
  $scope.staff = {};
  $scope.staff.loading = true;
  getStaffDetail();

  function getStaffDetail() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);

    staffSrv.getStaffDetail(object).then(function() {
      $scope.staff = staffSrv.staffDetail;
      $scope.staff.loading = false;
    });
  }

  $scope.save = function(object) {
    object.dob = object.dob.toISOString().substring(0, 10);
    object.hireDate = object.hireDate.toISOString().substring(0, 10);
    object.departureDate = object.departureDate.toISOString().substring(0, 10);

    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    staffSrv.save(object, formToken).then(function() {
      getStaffDetail();
    });
  };

  $scope.discardChanges = function() {
    $scope.staff = staffSrv.staffDetail;
  };
});
