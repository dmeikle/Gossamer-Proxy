module.controller('inventoryCtrl', function ($scope, costCardItemTypeSrv, accountingTemplateSrv, inventorySrv, $modal, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;
    $scope.loading = true;
    $scope.previouslyClickedObject = {};
    $scope.noSearchResults = false;

    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.advSearch = {};
    $scope.basicSearch.query = '';
    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    // Load up the table service so we can watch it!
    $scope.tablesSrv = tablesSrv;
    
    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.list = tablesSrv.sortResult.InventoryItems;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['tablesSrv.grouped', 'tablesSrv.groupResult.InventoryItems'], function () {
        $scope.grouped = tablesSrv.grouped;
        if ($scope.grouped === true) {
            if (tablesSrv.groupResult && tablesSrv.groupResult.InventoryItems)
                $scope.list = tablesSrv.groupResult.InventoryItems;
            $scope.loading = false;
        } else if ($scope.grouped === false) {
            getList();
        }
    });

    function getList() {
        $scope.loading = true;
        $scope.noSearchResults = false;
        inventorySrv.getList(row, numRows)
                .then(function () {
                    $scope.loading = false;
                    $scope.list = inventorySrv.list;
                    $scope.totalItems = inventorySrv.listRowCount;
                    if (inventorySrv.error.showError === true) {
                        $scope.error.showError = true;
                    }
                });
    }

    $scope.$watch('basicSearch.query', function () {
        if ($scope.basicSearch.query.length === 0) {
            getList();
        }
    });

    $scope.$watch('currentPage + itemsPerPage', function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getList(row, numRows);
    });

//    $scope.closeSidePanel = function () {
//        $scope.sidePanelOpen = false;
//    };

    //Search
    $scope.search = function (searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            inventorySrv.search(copiedObject).then(function () {
                $scope.list = inventorySrv.searchResults;
                $scope.totalItems = inventorySrv.searchResultsCount;
                if ($scope.totalItems === 0) {
                    $scope.noSearchResults = true;
                }
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function () {
        $scope.searchSubmitted = false;
        $scope.noSearchResults = false;
        $scope.basicSearch.query = '';
        getList();
    };

    $scope.autoSearch = function (searchString) {
        if (searchString.length >= 3) {
            $scope.search(searchString);
        }
    };

    //Modal
    $scope.openModal = function (item) {
        $scope.modalLoading = true;
        var template = accountingTemplateSrv.inventoryModal();
        var modal = $modal.open({
            template: template,
            controller: 'inventoryModalCtrl',
            size: 'md',
            resolve: {
                inventoryItem: function () {
                    return item;
                }
            }
        });
        modal.opened.then(function () {
            $scope.modalLoading = false;
        });
        modal.result.then(function () {
            getList();
        });
    };
    
    $scope.remove = function(object){
        var item = {};
        item.isActive = 0;
        item.id = object.id;
        
        inventorySrv.saveItem(item, formToken).then(function(){
            getList();
        });
    };
});