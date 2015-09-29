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
      size: 'lg',
      keyboard: false,
      backdrop:"static"
    });

    modalInstance.result.then(function(claim) {
      claimsEditSrv.save(claim).then(function() {
        getClaimsList();
      });
    });
  };
});

module.controller('claimsModalCtrl', function($modalInstance, $scope, claimsEditSrv) {
  $scope.addNewClient = false;

  $scope.claim = {};

  // datepicker stuffs
  $scope.isOpen = {};
  $scope.dateOptions = {'starting-day':1};
  $scope.openDatepicker = function(event) {
    var datepicker = event.target.parentElement.dataset.datepickername;
    $scope.isOpen[datepicker] = true;
  };

  $scope.save = function(object, formToken) {
    return claimsEditSrv.save(object, formToken, $scope.currentPage + 1).then(function() {

    });
  };

  $scope.toggleAdding = function() {
    $scope.addNewClient = !$scope.addNewClient;
  };

  $scope.confirm = function() {
    $modalInstance.close($scope.claim);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
