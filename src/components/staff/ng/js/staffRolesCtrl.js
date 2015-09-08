module.controller('staffRolesCtrl', function($scope, $location, staffRolesSrv) {
  // Stuff to run on controller load
  $scope.staffRoles = {};
  $scope.staffRoles.loading = true;
  getStaffRoles();

  function getStaffRoles() {
    var object = {};
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    staffRolesSrv.getStaffRoles(object).then(function() {
      $scope.staffRoles = staffRolesSrv.staffRoles;
      $scope.staffRoles.loading = false;
    });
  }

  $scope.submitRoles = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    object.id = $location.absUrl().substring($location.absUrl().lastIndexOf('/') + 1, $location.absUrl().length);
    staffRolesSrv.saveRoles(object, formToken).then(function() {
      getStaffRoles();
    });
  };
});
