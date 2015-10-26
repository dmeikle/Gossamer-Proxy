
var module = angular.module('inventoryAdmin', ['ui.bootstrap']);

module.config(function($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data) {
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };

});

module.controller('inventoryEditCtrl', function ($scope, $location, inventoryEditSrv) {
    $scope.getDetails = function() {
        inventoryEditSrv.getDetails($scope.item).then(function (response) {
            $scope.item = response.data.InventoryItem;
        });
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEditSrv.save($scope.item, formToken).then(function (response) {
            window.location.href = '/admin/inventory';
        });
    };
});

module.service('inventoryEditSrv', function(crudSrv) {
    var apiPath = '/admin/inventory/items/';
    var objectType = 'InventoryItem';

    this.getDetails = function(object) {
        return crudSrv.getDetails(apiPath, object.id);
    };

    this.save = function(object, formToken) {
        var requestPath;
        if (!object.id || object.id === '') {
            requestPath = apiPath + '0';
        } else {
            requestPath = apiPath + object.id;
        }

        for (var property in object) {
            if (object.hasOwnProperty(property) && !object[property]) {
                delete object[property];
            }
        }

        return crudSrv.save(object, objectType, formToken, requestPath);
    };

    this.delete = function(object, formToken) {
        return crudSrv.delete(apiPath + 'remove/', object, formToken);
    };
});

module.controller('inventoryListCtrl', function($scope, $modal, tablesSrv,
    inventoryListSrv, inventoryEditSrv, inventoryTransferSrv) {
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
                $scope.inventoryList = response.data.InventoryEquipments;
                $scope.totalItems = response.data.InventoryEquipmentsCount;
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

    $scope.closeSidePanel = function() {
        if ($scope.searching) {
            $scope.searching = false;
        }
        if ($scope.selectedStaff) {
            $scope.selectedStaff = undefined;
            $scope.previouslyClickedObject = undefined;
        }
        if (!$scope.selectedStaff && !$scope.searching) {
            $scope.sidePanelOpen = false;
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
                multiSelectArray: function() {
                    return $scope.multiSelectArray;
                }
            }
        });

        modalInstance.result.then(function(result) {
            inventoryTransferSrv.transfer(result);
            $scope.getList();
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

module.controller('transferModalController', function($scope, $modalInstance,
    inventoryTransferSrv, multiSelectArray, wizardSrv) {
    $scope.transfer = {};
    $scope.loading = true;
    $scope.equipmentList = multiSelectArray;
    $scope.warehouseLocation = inventoryTransferSrv.getLocation($scope.equipmentList[0])
        .then(function() {
            $scope.loading = false;
        });

    $scope.$watch('wizardSrv.wizardLoading', function() {
        $scope.wizardLoading = wizardSrv.wizardLoading;
    });

    var autocomplete = function(value, type, apiPath) {
        return inventoryTransferSrv.autocomplete(value, type, apiPath);
    };

    $scope.autocompleteJobNumber = function(value) {
        return autocomplete(value, 'jobNumber', '/admin/claims/').then(function() {
            return inventoryTransferSrv.autocompleteResult.Claims;
        });
    };

    $scope.autocompleteWarehouseLocation = function(value) {
        return autocomplete(value, 'WarehouseLocation_id', '/admin/inventory/warehouse').then(function() {
            return inventoryTransferSrv.autocompleteResult.Claims;
        });
    };

    $scope.submit = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        for (var property in $scope.transfer) {
            if ($scope.transfer.hasOwnProperty(property) &&
                !$scope.transfer[property]) {
                delete $scope.transfer[property];
            }
        }
        var data = $scope.transfer;
        data.inventoryIds = [];
        for (var equipment in $scope.equipmentList) {
            if ($scope.equipmentList.hasOwnProperty(equipment)) {
                data.inventoryIds.push($scope.equipmentList[equipment].InventoryEquipment_id);
            }
        }
        data.FORM_SECURITY_TOKEN = formToken;
        $modalInstance.close(data);
    };

    $scope.close = function() {
        $modalInstance.dismiss('cancel');
    };
});
module.service('inventoryListSrv', function($http, crudSrv, searchSrv) {
    var apiPath = '/admin/inventory/';

    this.getMaterialsList = function(row, numRows) {
        return crudSrv.getList(apiPath + 'materials/', row, numRows);
    };

    this.getEquipmentList = function(row, numRows) {
        return crudSrv.getList(apiPath + 'equipment/', row, numRows);
    };

    this.getAdvancedSearchFilters = function() {
        return searchSrv.getAdvancedSearchFilters('/render/inventory/inventoryAdvancedSearchFilters').then(function() {
            self.advancedSearch.fields = searchSrv.advancedSearch.fields;
        });
    };

    this.getEquipmentDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

    this.getMaterialDetails = function(object) {
        return crudSrv.getDetails(apiPath + 'items/', object.id);
    };

});

module.service('inventoryTransferSrv', function($http, searchSrv) {
    var self = this;

    this.autocomplete = function(value, type, apiPath) {
        var config = {};
        config[type] = value;
        return searchSrv.fetchAutocomplete(config, apiPath).then(function() {
            self.autocompleteResult = searchSrv.autocomplete;
        });
    };

    this.getLocation = function(object) {
        return $http.get('/admin/claims/locations/' + object.WarehouseLocations_id);
    };

    this.transfer = function(object) {

        return $http({
            method: 'POST',
            url: '/admin/inventory/equipment/transfer',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            data: object
        });
    };
});

module.controller('warehouseEditCtrl', function($scope, $location, warehouseEditSrv) {
    $scope.warehouse = new AngularQueryObject();

    $scope.getWarehouseDetails = function() {
        warehouseEditSrv.getWarehouseDetails().then(function(response) {
            $scope.warehouse = response.data.Warehouse;
        });
    };

    $scope.saveWarehouse = function(object) {
        warehouseEditSrv.save(object).then(function() {
            $scope.getWarehouseDetails();
        });
    };
});

module.service('warehouseEditSrv', function(crudSrv) {
    var apiPath = '/admin/inventory/warehouse/';
    var objectType = 'Warehouse';

    this.getWarehouseDetails = function(object) {
        return crudSrv.getDetails(apiPath, object);
    };

    this.saveWarehouse = function(object, formToken) {
        return crudSrv.save(object, objectType, formToken, apiPath);
    };
});

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

module.service('warehouseListSrv', function (crudSrv) {
    var apiPath = '/admin/inventory/warehouse/';

    this.getWarehouseList = function (row, numRows) {
        return crudSrv.getList(apiPath, row, numRows);
    };

    this.deleteWarehouse = function (object, formToken) {
        return crudSrv.delete(apiPath, object, formToken);
    };
});
