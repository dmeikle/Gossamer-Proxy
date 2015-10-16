module.controller('inventoryListCtrl', function($scope, $modal, tablesSrv, inventoryListSrv, inventoryEditSrv) {
  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};
  $scope.previouslyClickedObject = {};
  $scope.listType = 'materials';

  // Load up the table service so we can watch it!
  $scope.tablesSrv = tablesSrv;
  $scope.$watch('tablesSrv.sortResult', function() {
    if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
      $scope.inventoryList = tablesSrv.sortResult.InventoryItems;
      $scope.loading = false;
    }
  });
  $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.InventoryItems'], function() {
    $scope.grouped = tablesSrv.grouped;
    if ($scope.grouped === true) {
      if (tablesSrv.groupResult && tablesSrv.groupResult.InventoryItems) $scope.inventoryList = tablesSrv.groupResult.InventoryItems;
      $scope.loading = false;
    } else if ($scope.grouped === false) {
      $scope.getMaterialsList();
    }
  });

  $scope.switchList = function(typeString) {
    $scope.listType = typeString;
    $scope.getList();
  };

  $scope.getList = function() {
    switch ($scope.listType) {
      case 'materials':
        getMaterialsList();
        break;
      default:
        getEquipmentList();
    }
  };

  var getMaterialsList = function() {
    $scope.loading = true;
    inventoryListSrv.getMaterialsList(row, numRows)
      .then(function(response) {
        $scope.inventoryList = response.data.InventoryItems;
        $scope.totalItems = response.data.InventoryItemsCount;
        $scope.loading = false;
      });
  };

  var getEquipmentList = function() {
    $scope.loading = true;
    inventoryListSrv.getEquipmentList(row, numRows)
      .then(function(response) {
        $scope.inventoryList = response.data.InventoryItems;
        $scope.totalItems = response.data.InventoryItemsCount;
        $scope.loading = false;
      });
  };

  $scope.selectRow = function(clickedObject) {
    $scope.searching = false;
    $scope.sidePanelOpen = true;
    if ($scope.previouslyClickedObject !== clickedObject) {
      $scope.previouslyClickedObject = clickedObject;
      $scope.sidePanelLoading = true;
      switch ($scope.listType) {
        case 'materials':
          inventoryListSrv.getMaterialDetails(clickedObject)
            .then(function() {
              $scope.selectedRow = inventoryListSrv.item;
              $scope.sidePanelLoading = false;
            });
          break;
        default:
          inventoryListSrv.getEquipmentDetails(clickedObject)
            .then(function() {
              $scope.selectedRow = inventoryListSrv.item;
              $scope.sidePanelLoading = false;
            });
      }
    }
  };

  $scope.search = function(searchObject) {
    $scope.noResults = undefined;
    var copiedObject = angular.copy(searchObject);
    if (copiedObject && Object.keys(copiedObject).length > 0) {
      $scope.searchSubmitted = true;
      $scope.loading = true;
      inventoryListSrv.search(copiedObject).then(function() {
        console.log(inventoryListSrv.searchResults);
        $scope.claimsList = inventoryListSrv.searchResults;
        $scope.totalItems = inventoryListSrv.searchResultsCount;
        $scope.loading = false;
      });
    }
  };

  $scope.resetSearch = function() {
    $scope.searchSubmitted = false;
    $scope.basicSearch.query = {};
    $scope.getList();
  };

  $scope.openAdvancedSearch = function() {
    $scope.sidePanelOpen = true;
    $scope.selectedStaff = undefined;
    $scope.sidePanelLoading = true;
    inventoryListSrv.getAdvancedSearchFilters().then(function() {
      $scope.sidePanelLoading = false;
      $scope.searching = true;
    });
  };

  $scope.resetAdvancedSearch = function() {
    $scope.advancedSearch.query = {};
    $scope.getList();
  };

  $scope.transferSelected = function() {
    openTransferModal();
  };

  var openTransferModal = function() {
    var modalInstance = $modal.open({
      templateUrl: '/render/inventory/transferModal',
      controller: 'transferModalController',
      size: 'md',
      resolve: {
        multiSelectArray:function() {
          return $scope.multiSelectArray;
        }
      }
    });

    modalInstance.result.then(function(result, formToken) {
      inventoryEditSrv.save(result, formToken);
    });
  };

  $scope.delete = function(object) {
    var confirmed = window.confirm('Are you sure?');
    if (confirmed) {
      var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
      inventoryEditSrv.delete(object, formToken).then(function() {
        $scope.getList();
      });
    }
  };

  $scope.$watchGroup(['currentPage', 'itemsPerPage'], function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    if ($scope.grouped) {
      tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
    } else {
      $scope.getList();
    }
  });
});


module.controller('transferModalController', function($scope, claimsEditSrv, multiSelectArray) {
  $scope.equipmentList = multiSelectArray;

  var autocomplete = function(value, type) {
    return claimsEditSrv.autocomplete(value, type);
  };

  $scope.autocompleteAddress = function(value) {
    return autocomplete(value, 'address1');
  };
});
