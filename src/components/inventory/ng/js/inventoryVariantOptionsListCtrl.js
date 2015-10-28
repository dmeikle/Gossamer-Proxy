module.controller('variantOptionsListCtrl', function($scope, $modal, variantOptionsListSrv, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.basicSearch = new AngularQueryObject();
    $scope.advancedSearch = new AngularQueryObject();
    $scope.previouslyClickedObject = {};

    var apiPath = "/admin/inventory/variantoptions/";

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
            $scope.getList();
        }
    });

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

    $scope.setItemsPerPage = function(number) {
        $scope.itemsPerPage = number;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
    };

    $scope.getList = function() {
        $scope.loading = true;
        variantOptionsListSrv.getList(apiPath, row, numRows).then(function(response) {
            $scope.variantList = response.VariantOptions;
            $scope.totalItems = response.VariantOptionsCount;
            $scope.loading = false;
        });
    };

    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            variantOptionsListSrv.search(apiPath, copiedObject).then(function() {
                $scope.claimsList = variantOptionsListSrv.searchResults;
                $scope.totalItems = variantOptionsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        $scope.getList();
    };

    $scope.delete = function(object) {
        var confirmed = window.confirm('Are you sure?');
        if (confirmed) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            variantOptionsListSrv.delete(object, formToken).then(function() {
                $scope.getList();
            });
        }
    };

    $scope.openVariantModal = function(variant) {
        var modalInstance = $modal.open({
            templateUrl: '/render/inventory/variantModal',
            controller: 'variantModalCtrl',
            size: 'md',
            resolve: {
                variant: function() {
                    return variant;
                }
            }
        });

        modalInstance.result.then(function() {

        });
    };
});

module.controller('variantModalCtrl', function($modalInstance, $scope, variant) {
    $scope.variant = variant ? variant : new AngularQueryObject();
    $scope.selectedLocale = 'en_US';

    $scope.selectLocale = function(localeString) {
        $scope.selectedLocale = localeString;
    };

    $scope.submit = function() {
        $modalInstance.close(data);
    };

    $scope.close = function() {
        $modalInstance.dismiss('cancel');
    };
});