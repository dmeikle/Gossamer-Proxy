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

  $scope.project = {};
  $scope.claim = {};
  $scope.claim.query= {};


  // datepicker stuffs
  $scope.isOpen = {};
  $scope.dateOptions = {'starting-day':1};
  $scope.openDatepicker = function(event) {
    var datepicker = event.target.parentElement.dataset.datepickername;
    $scope.isOpen[datepicker] = true;
  };

  var autocomplete = function(value, type) {
    return claimsEditSrv.autocomplete(value, type);
  };

  $scope.autocompleteBuilding = function(value) {
    return autocomplete(value, 'buildingName');
  };

  $scope.autocompleteStrata = function(value) {
    return autocomplete(value, 'stratanumber');
  };

  $scope.autocompleteAddress = function(value) {
    return autocomplete(value, 'address');
  };

  $scope.selectAddress = function(item, model, label) {
    $scope.claim.ProjectAddress = item;
    $scope.claim.query.ProjectAddresses_id = item.id;
    if (item.buildingYear.parseInt <= 1980) {
      $scope.claim.query.asbestosTestRequired = 'true';
    } else {
      $scope.claim.query.asbestosTestRequired = 'false';
    }
  };

  $scope.saveProjectAddress = function(project) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    claimsEditSrv.saveProjectAddress(project, formToken).then(function(response){
      $scope.claim.projectAddress = response.data.ProjectAddress[0];
      $scope.claim.query.ProjectAddresses_id = response.data.ProjectAddress[0].id;
      $scope.toggleAdding();
      $scope.nextPage();
    });
  };

  $scope.save = function() {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    return claimsEditSrv.save($scope.claim.query, formToken, $scope.currentPage + 1);
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
