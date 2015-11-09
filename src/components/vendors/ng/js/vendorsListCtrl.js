module.controller('vendorsListCtrl', function($scope, $uibModal, tablesSrv, vendorsListSrv,
    vendorLocationEditSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;


    $scope.poItemsPerPage = 10;
    $scope.poCurrentPage = 1;
    var poRow = (($scope.poCurrentPage - 1) * $scope.poItemsPerPage);
    var poNumRows = $scope.poItemsPerPage;
    $scope.purchaseOrdersList = [];

    $scope.vendorsList = [];
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.previouslyClickedObject = {};
    $scope.vendorsListSrv = vendorsListSrv;
    $scope.selectedRow = {};

    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;

    $scope.$watch('tablesSrv.sortResult', function() {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.vendorsList = tablesSrv.sortResult.Vendors;
            $scope.loading = false;
        }
    });

    $scope.getClass = function(item) {
        switch (item.status) {
            case 'completed':
                return 'success';
            case 'waiting delivery':
                return 'warning';
        }

        return 'danger';
    };

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.Vendors'], function() {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.Vendors)
                $scope.vendorsList = tablesSrv.groupResult.Vendors;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            $scope.getMaterialsList();
        }
    });

    $scope.switchList = function(typeString) {
        $scope.listType = typeString;
        $scope.getList();
    };

    $scope.closeSidePanel = function() {
        $scope.sidePanelOpen = false;
        $scope.selectedRow = undefined;
    };

    $scope.getList = function() {
        getVendorsList();
    };

    var getVendorsList = function() {
        $scope.loading = true;
        vendorsListSrv.getVendorsList(row, numRows)
            .then(function(response) {
                $scope.vendorsList = response.data.Vendors;
                $scope.totalItems = response.data.VendorsCount;
                $scope.loading = false;
            });
    };

    $scope.selectRow = function(clickedObject) {
        $scope.searching = false;
        $scope.sidePanelOpen = true;
        $scope.selectedRow = clickedObject;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.sidePanelLoading = true;
            vendorsListSrv.getVendorLocations(clickedObject, 0, 5)
                .then(function(response) {
                    $scope.vendorLocations = response.data.VendorLocations;
                    $scope.sidePanelLoading = false;
                });
        }
    };

    $scope.$on('vendorLocationSaved', function() {
        $scope.sidePanelLoading = true;
        vendorsListSrv.getVendorLocations($scope.previouslyClickedObject, 0, 5)
            .then(function(response) {
                $scope.vendorLocations = response.data.VendorLocations;
                $scope.sidePanelLoading = false;
            });
    });

    $scope.search = function(searchObject) {
        $scope.noResults = undefined;

        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            vendorsListSrv.search(copiedObject).then(function() {
                $scope.vendorsList = vendorsListSrv.searchResults;
                $scope.totalItems = vendorsListSrv.searchResultsCount;
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
        $scope.selectedRow = undefined;
        $scope.sidePanelLoading = true;
        vendorsListSrv.getAdvancedSearchFilters().then(function() {
            $scope.sidePanelLoading = false;
            $scope.searching = true;
        });
    };

    $scope.resetAdvancedSearch = function() {
        $scope.advancedSearch.query = {};
        $scope.getList();
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

    $scope.edit = function(item) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/vendors/editVendorModal',
            controller: 'vendorModalController',
            size: 'md',
            resolve: {
                vendor: function() {
                    return item;
                }
            }
        });

        modalInstance.result.then(function(result) {
            getVendorsList();
        });
    };

    $scope.viewPurchaseOrders = function(object) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/vendors/purchaseOrdersModal',
            controller: 'purchaseOrdersModalController',
            size: 'lg',
            resolve: {
                purchaseOrders: function() {
                    return vendorsListSrv.getVendorPurchaseOrders(object, poRow, poNumRows);
                },
                vendor: function() {
                    return object;
                }
            }
        });
    };

    $scope.openVendorLocationModal = function(object) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/vendors/purchaseOrdersModal',
            controller: 'vendorLocationModalController',
            size: 'lg',
            resolve: {
                vendor: function() {
                    return $scope.selectedRow;
                },
                vendorLocation: function() {
                    return object;
                },
                purchaseOrders: function() {
                    return vendorsListSrv.getVendorPurchaseOrders($scope.selectedRow, poRow, poNumRows, object);
                }
            }
        });
    };

    $scope.openAddVendorLocationModal = function(object) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/vendors/addVendorLocationModal',
            controller: 'addVendorLocationModalCtrl',
            size: 'lg',
            resolve: {
                vendor: function() {
                    return object;
                }
            }
        });

        modalInstance.result.then(function(result) {
            $scope.sidePanelLoading = true;
            vendorLocationEditSrv.save(result).then(function() {
                vendorsListSrv.getVendorLocations($scope.previouslyClickedObject, 0, 5)
                    .then(function(response) {
                        $scope.vendorLocations = response.data.VendorLocations;
                        $scope.sidePanelLoading = false;
                    });
            });
        });
    };
});