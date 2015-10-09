module.controller('warehouseListCtrl', function($scope, $location, warehouseListSrv) {

  // Stuff to run on controller load
  $scope.itemsPerPage = 20;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  // $scope.basicSearch = {};
  // $scope.advancedSearch = {};
  // $scope.autocomplete = {};

  $scope.getWarehouseList = function() {
    warehouseListSrv.getLocationList(row, numRows)
      .then(function(response) {
        $scope.locationList = response.data.Locations;
        $scope.totalItems = response.data.LocationsCount;
      });
  };

  $scope.deleteLocation = function(location) {
    if (window.confirm("Really delete Warehouse?")) {
      warehouseListSrv.deleteLocation(location, formToken)
        .then(function() {
          $scope.getWarehouseList();
        });
    }
  };

  $scope.$watchGroup(['currentPage','itemsPerPage'], function() {
    $scope.loading = true;
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    if ($scope.grouped) {
      tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
    } else {
      getStaffList(row, numRows);
    }
  });
});
