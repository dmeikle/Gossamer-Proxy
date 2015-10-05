module.controller('initialJobsheetCtrl', function($scope, claimsInitialJobSrv) {
  $scope.jobSheet = new AngularQueryObject();
  $scope.jobSheet.query.ownerTenant = [];
  $scope.jobSheet.query.ownerTenant.push({});

  $scope.addOwnerTenant = function() {
    $scope.jobSheet.query.ownerTenant.push({});
    console.log('Object: ' + $scope.jobSheet.query.ownerTenant);
  };

  $scope.removeOwnerTenant = function(e, index) {
    e.preventDefault();
    $scope.jobSheet.query.ownerTenant = $scope.jobSheet.query.ownerTenant.splice(index, 1);
    console.log('Object: ' + $scope.jobSheet.query.ownerTenant);
  };

  $scope.submit = function() {
    claimsInitialJobSrv.save();
  };
});
