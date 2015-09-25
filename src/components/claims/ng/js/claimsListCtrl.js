module.controller('claimsListCtrl', function($scope, $location, $modal, claimsEditSrv) {
  var a = document.createElement('a');
  a.href = $location.absUrl();
  var apiPath;
  if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
    apiPath = a.pathname;
  } else {
    apiPath = a.pathname.slice(0, -1);
  }

  $scope.openAddNewWizard = function() {
    var modalInstance = $modal.open({
      templateUrl: '/render/claims/claimsAddNewModal',
      controller: 'claimsModalCtrl',
      size: 'lg'
    });

    modalInstance.result.then(function(claim) {
      claimsEditSrv.save(claim).then(function() {
        getClaimsList();
      });
    });
  };
});

module.controller('claimsModalCtrl', function($modalInstance, $scope) {
  $scope.confirm = function() {
    $modalInstance.close($scope.staff);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
