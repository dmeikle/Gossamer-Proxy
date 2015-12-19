
module.controller('inventoryListCtrl', function($scope, $uibModal, tablesSrv,
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
    $scope.editing = {};
    $scope.listType = 'materials';
    $scope.inventoryListSrv = inventoryListSrv;
    //used for displaying vendor prices in list
    $scope.vendorSearch = false;
    
    //used for redrawing page after editing an item from advanced search results
    $scope.currentSearchParams = {};
    
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
    
    $scope.closeSidePanel = function() {
        $scope.sidePanelOpen = false;                
    };


    $scope.editVendorItem = function (item) {
        if ($scope.editing && $scope.editing[item.id]) {
            delete $scope.editing[item.id];
        } else {
            $scope.oldItem = angular.copy($scope.editing[item.id]);
            $scope.editing[item.id] = true;
        }
    };

    $scope.saveVendorItem = function(item) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        var copiedItem = angular.copy(item);
        copiedItem.Vendors_id = $scope.advancedSearch.query.Vendors_id;
        copiedItem.id = copiedItem.VendorItems_id;
        copiedItem.price = copiedItem.vendorPrice;
        $scope.editVendorItem(item);
        inventoryEditSrv.saveVendorItem(copiedItem, formToken);
    };

    $scope.discardVendorItem = function(item) {
        item = $scope.oldItem;
        $scope.editVendorItem(item);
    };
    
    var getMaterialsList = function () {

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

                    inventoryListSrv.getEquipmentTransferHistory(clickedObject)
                        .then(function(response) {
                            $scope.selectedRow = inventoryListSrv.item;
                            $scope.transferHistory = response.data.InventoryEquipmentHistorys;

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
        $scope.vendorSearch = (searchObject.Vendors_id !== undefined);
        $scope.currentSearchParams = searchObject;

        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;

            inventoryListSrv.search(copiedObject, $scope.currentPage - 1, $scope.itemsPerPage).then(function () {
               
                $scope.inventoryList = inventoryListSrv.searchResults;                

                $scope.totalItems = inventoryListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        $scope.vendorSearch = false;

        $scope.getList();
    };

    $scope.openAdvancedSearch = function() {
        $scope.sidePanelOpen = true;
        $scope.selectedStaff = undefined;

        $scope.searching = true;
    };

    $scope.resetAdvancedSearch = function() {
        $scope.advancedSearch.query = {};
        $scope.vendorSearch = false;
        $scope.getList();
    };

    $scope.transferSelected = function() {
        openTransferModal();
    };

    var openTransferModal = function() {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/inventory/transferModal',
            controller: 'transferModalController',
            size: 'md',
            resolve: {
                multiSelectArray: function() {
                    return $scope.multiSelectArray;
                }
            }
        });

        modalInstance.result.then(function() {
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

module.controller('transferModalController', function($scope, $uibModalInstance,
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
        return autocomplete(value, 'jobNumber', '/admin/claims/autocompletelocations');
    };

    $scope.autocompleteWarehouseLocation = function(value) {
        return autocomplete(value, 'warehouseLocation', '/admin/inventory/warehouse/');
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

        inventoryTransferSrv.transfer(data).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });  
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };

});


module.controller('inventoryVendorItemModalCtrl', function ($uibModalInstance, $scope, inventoryeditSrv) {
    
    $scope.item = {};
    $scope.item.InventoryItems_id = item.InventoryItems_id;
    $scope.item.Vendors_id = vendor.Vendors_id;
    
    $scope.save = function () {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return inventoryeditSrv.saveVendorItem($scope.claim.query, formToken, $scope.currentPage + 1);
    };


    $scope.submit = function (item) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEditSrv.saveVendorItem(item, formToken);
        $uibModalInstance.close();
    };

    $scope.close = function () {
        $uibModalInstance.dismiss('cancel');
    };
});

