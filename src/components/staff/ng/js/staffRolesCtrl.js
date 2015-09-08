module.controller('staffRolesCtrl', function($scope, $location, staffSrv) {
  // Stuff to run on controller load
  $scope.staffRoles = {};
  $scope.staffRoles.loading = true;
  getStaffRoles();

  function getStaffRoles() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    staffSrv.getStaffRoles(object).then(function() {
      $scope.staffRoles = staffSrv.staffRoles;
      $scope.staffRoles.loading = false;
    });
  }

  $scope.submitRoles = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    staffSrv.saveRoles(object, formToken).then(function() {
      getStaffRoles();
    });
  };
});
