module.controller('warehouseListCtrl', function ($scope, $location, warehouseListSrv, tablesSrv) {

    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    // $scope.basicSearch = {};
    // $scope.advancedSearch = {};
    // $scope.autocomplete = {};

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.warehouseList = tablesSrv.sortResult.WarehouseLocations;
            $scope.loading = false;
        }
    });
    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.WarehouseLocations'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.WarehouseLocations)
                $scope.warehouseList = tablesSrv.groupResult.WarehouseLocations;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            $scope.getWarehouseList();
        }
    });

    $scope.getWarehouseList = function () {
        $scope.loading = true;
        warehouseListSrv.getWarehouseList(row, numRows)
            .then(function (response) {
                $scope.warehouseList = response.data.WarehouseLocations;
                $scope.totalItems = response.data.WarehouseLocationsCount;
                $scope.loading = false;
            });
    };

    $scope.deleteLocation = function (location) {
        if (window.confirm("Really delete Warehouse?")) {
            warehouseListSrv.deleteLocation(location, formToken)
                .then(function () {
                    $scope.getWarehouseList();
                });
        }
    };

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;

        if ($scope.grouped) {
            tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
        } else {
            $scope.getWarehouseList(row, numRows);
        }
    });
});
