module.controller('vendorsListCtrl', function ($scope, $modal, tablesSrv, vendorsListSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.previouslyClickedObject = {};

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.vendorsList = tablesSrv.sortResult.Vendors;
            $scope.loading = false;
        }
    });
    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.Vendors'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.Vendors)
                $scope.vendorsList = tablesSrv.groupResult.Vendors;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            $scope.getMaterialsList();
        }
    });

    $scope.switchList = function (typeString) {
        $scope.listType = typeString;
        $scope.getList();
    };

    $scope.getList = function () {
        getVendorsList();
    };

    var getVendorsList = function () {
        $scope.loading = true;
        vendorsListSrv.getVendorsList(row, numRows)
                .then(function (response) {
                    $scope.vendorsList = response.data.Vendors;
                    $scope.totalItems = response.data.VendorsCount;
                    $scope.loading = false;
                });
    };

    $scope.selectRow = function (clickedObject) {
        $scope.searching = false;
        $scope.sidePanelOpen = true;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelLoading = true;
                vendorsListSrv.getMaterialDetails(clickedObject)
                        .then(function () {
                            $scope.selectedRow = vendorsListSrv.item;
                            $scope.sidePanelLoading = false;
                        });                    
        }
    };

    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            vendorsListSrv.search(copiedObject).then(function () {
                console.log(vendorsListSrv.searchResults);
                $scope.claimsList = vendorsListSrv.searchResults;
                $scope.totalItems = vendorsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        $scope.getList();
    };

    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedStaff = undefined;
        $scope.sidePanelLoading = true;
        vendorsListSrv.getAdvancedSearchFilters().then(function () {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        $scope.getList();
    };

    $scope.transferSelected = function () {
        openTransferModal();
    };


//    $scope.delete = function (object) {
//        var confirmed = window.confirm('Are you sure?');
//        if (confirmed) {
//            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//            vendorsEditSrv.delete(object, formToken).then(function () {
//                $scope.getList();
//            });
//        }
//    };

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function () {
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

