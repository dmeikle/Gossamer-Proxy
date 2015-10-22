module.controller('claimsModalCtrl', function($scope, $modalInstance, claim) {
 
  $scope.claim = claim;
  
  var autocomplete = function(value, type, apiPath) {
    return claimsModalSrv.autocomplete(value, type, apiPath);
  };

  $scope.autocompleteJobNumber = function(value) {
    return autocomplete(value, 'jobNumber', '/admin/claims/').then(function() {
      return claimsModalSrv.autocompleteResult.Claims;
    });
  };
  
   

  $scope.submit = function() {
    $modalInstance.close($scope.transfer);
  };

  $scope.close = function() {
    $modalInstance.dismiss('cancel');
  };
});