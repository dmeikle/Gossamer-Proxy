module.controller('initialJobsheetCtrl', function($scope) {
  $scope.jobSheet = new AngularQueryObject();
  $scope.jobSheet.query.ownerTenant = [];
  $scope.jobSheet.query.ownerTenant.push({});
  
  $scope.addOwnerTenant = function() {
    $scope.jobSheet.query.ownerTenant.push({});
  };

  $scope.removeOwnerTenant = function(index) {
    $scope.jobSheet.query.ownerTenant = $scope.jobSheet.query.ownerTenant.splice(index, 1);
  };
});
