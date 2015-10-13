module.controller('inventoryListCtrl', function($scope, tablesSrv, inventoryListSrv) {
  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  $scope.basicSearch = {};
  $scope.advancedSearch = {};
  $scope.autocomplete = {};

  $scope.listType = 'inventory';

  // Load up the table service so we can watch it!
  $scope.tablesSrv = tablesSrv;
  $scope.$watch('tablesSrv.sortResult', function() {
    if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
      $scope.inventoryList = tablesSrv.sortResult.WarehouseLocations;
      $scope.loading = false;
    }
  });
  $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.WarehouseLocations'], function() {
      $scope.grouped = tablesSrv.grouped;
      if ($scope.grouped === true) {
        if(tablesSrv.groupResult && tablesSrv.groupResult.WarehouseLocations) $scope.inventoryList = tablesSrv.groupResult.WarehouseLocations;
        $scope.loading = false;
      } else if ($scope.grouped === false) {
        $scope.getMaterialsList();
      }
  });

  $scope.getMaterialsList = function() {
    $scope.loading = true;
    inventoryListSrv.getMaterialsList(row, numRows)
      .then(function(response) {
        $scope.inventoryList = response.data.WarehouseLocations;
        $scope.totalItems = response.data.WarehouseLocationsCount;
        $scope.loading = false;
      });
  };

  $scope.getEquipmentList = function() {
    $scope.loading = true;
    inventoryListSrv.getEquipmentList(row, numRows)
      .then(function(response) {
        $scope.inventoryList = response.data.WarehouseLocations;
        $scope.totalItems = response.data.WarehouseLocationsCount;
        $scope.loading = false;
      });
  };

  $scope.$watchGroup(['currentPage','itemsPerPage'], function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    if ($scope.grouped) {
      tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
    } else {
      switch ($scope.listType) {
        case 'inventory':
          $scope.getEquipmentList(row, numRows);
          break;
        default:
          $scope.getMaterialsList(row, numRows);
      }
    }
  });
});
