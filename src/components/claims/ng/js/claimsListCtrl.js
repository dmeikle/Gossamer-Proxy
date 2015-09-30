
module.controller('claimsListCtrl', function($scope, $modal, claimsListSrv, claimsEditSrv, templateSrv, tablesSrv, toastsSrv) {

  $scope.newAlert = toastsSrv.newAlert;
  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};

  $scope.previouslyClickedObject = {};

  // Load up the table service so we can watch it!
  $scope.tablesSrv = tablesSrv;
  $scope.$watch('tablesSrv.sortResult', function() {
    if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
      $scope.claimsList = tablesSrv.sortResult.Claims;
      $scope.loading = false;
    }
  });

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  var apiPath = '/admin/claims/';

  $scope.setItemsPerPage = function(number) {
    $scope.itemsPerPage = number;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;
    getClaimsList();
  };

  function getClaimsList() {
    $scope.loading = true;
    claimsListSrv.getClaimsList(row, numRows).then(function(response) {
      $scope.claimsList = claimsListSrv.claimsList;
      $scope.totalItems = claimsListSrv.claimsCount;
    }).then(function() {
      $scope.loading = false;
    });
  }

  $scope.fetchAutocomplete = function(viewVal) {
    var searchObject = {};
    searchObject.name = viewVal;

    return claimsListSrv.fetchAutocomplete(searchObject);
  };

  $scope.openAddNewClaimModal = function() {
    var template = templateSrv.claimsAddNewModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'claimsModalCtrl',
      size: 'xl'
    });

    modalInstance.result.then(function(claim) {
      claimsEditSrv.save(claim).then(function() {
        getClaimsList();
      });
    });
  };

  $scope.openClaimsScheduleModal = function(claim) {
    var template = templateSrv.claimScheduleModal;
    $modal.open({
      templateUrl: template,
      controller: 'claimModalCtrl',
      size: 'lg',
      resolve: {
        claim: function() {
          return claim;
        }
      }
    });
  };

  $scope.openClaimsAdvancedSearch = function() {
    $scope.sidePanelOpen = true;
    $scope.selectedClaims = undefined;
    $scope.sidePanelLoading = true;
    claimsListSrv.getAdvancedSearchFilters().then(function() {
      $scope.sidePanelLoading = false;
      $scope.searching = true;
    });
  };

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    getClaimsList();
  };

  $scope.search = function(searchObject) {
    $scope.noResults = undefined;
    var copiedObject = angular.copy(searchObject);
    if (copiedObject && Object.keys(copiedObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      claimsListSrv.search(copiedObject).then(function() {
        $scope.claimsList = claimsListSrv.searchResults;
        $scope.totalItems = claimsListSrv.searchResultsCount;
        $scope.loading = false;
      });
    }
  };

  $scope.resetSearch = function() {
    $scope.searchSubmitted = false;
    $scope.basicSearch.query = {};
    getClaimsList();
  };

  $scope.closeSidePanel = function() {
    if ($scope.searching) {
      $scope.searching = false;
    }
    if ($scope.selectedClaim) {
      $scope.selectedClaim = undefined;
      $scope.previouslyClickedObject = undefined;
    }
    if (!$scope.selectedClaim && !$scope.searching) {
      $scope.sidePanelOpen = false;
    }
  };

  $scope.selectRow = function(clickedObject) {
    $scope.searching = false;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      $scope.sidePanelLoading = true;
      claimsListSrv.getClaimDetail(clickedObject)
        .then(function() {
          $scope.selectedClaim = claimsListSrv.claimDetail;
          $scope.sidePanelOpen = true;
          $scope.sidePanelLoading = false;
        });
    }
  };

  $scope.$watch('currentPage + itemsPerPage', function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getClaimsList(row, numRows);
  });
});

module.controller('claimModalCtrl', function($modalInstance, $scope) {
  $scope.claim = {};

  $scope.confirm = function() {
    $modalInstance.close($scope.claim);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };
});
