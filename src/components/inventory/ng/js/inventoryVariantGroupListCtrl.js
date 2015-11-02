module.controller('variantGroupsListCtrl', function($scope, $modal, variantGroupListSrv, variantGroupEditSrv, tablesSrv) {
    // Stuff to run on controller load
    $scope.itemsPerPage = 20;
    $scope.currentPage = 1;

    var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    var numRows = $scope.itemsPerPage;

    $scope.basicSearch = new AngularQueryObject();
    $scope.advancedSearch = new AngularQueryObject();
    $scope.previouslyClickedObject = {};

    var apiPath = "/admin/inventory/variantgroups/";

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
        variantGroupListSrv.getList(apiPath, row, numRows).then(function(response) {
            $scope.groupList = response.VariantGroups;
            $scope.totalItems = response.VariantGroupsCount;
            $scope.loading = false;
        });
    };

    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            variantGroupListSrv.search(apiPath, copiedObject).then(function() {
                $scope.claimsList = variantGroupListSrv.searchResults;
                $scope.totalItems = variantGroupListSrv.searchResultsCount;
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
            variantGroupListSrv.delete(apiPath, object, formToken).then(function() {
                $scope.getList();
            });
        }
    };

    $scope.openVariantModal = function(variantGroup) {
        var modalInstance = $modal.open({
            templateUrl: '/render/inventory/variantGroupModal',
            controller: 'variantGroupModalCtrl',
            size: 'sm',
            resolve: {
                variantGroup: function() {
                    return variantGroup;
                }
            }
        });

        modalInstance.result.then(function(result) {
            variantGroupEditSrv.save(apiPath, result);
            $scope.getList();
        });
    };
});

module.controller('variantGroupModalCtrl', function($modalInstance, $scope, variantGroup, variantGroupEditSrv) {
    $scope.selectedGroup = variantGroup;
    var apiPath = "/admin/inventory/variantgroups/";

    $scope.getDetails = function() {
        $scope.loading = true;
        if (variantGroup && variantGroup.id) {
            variantGroupEditSrv.getDetails(apiPath, variantGroup).then(function(response) {
                $scope.variantGroup = response.data.VariantGroup[0];
                $scope.loading = false;
            });
        } else {
            $scope.variantGroup = {};
            $scope.loading = false;
        }
    }();

    $scope.$watch('defaultLocale', function() {
        if ($scope.defaultLocale) {
            $scope.selectLocale($scope.defaultLocale);
        }
    });

    $scope.selectLocale = function(localeString) {
        $scope.selectedLocale = localeString;
    };

    $scope.submit = function() {
        var data = $scope.variantGroup;
        data.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
        $modalInstance.close(data);
    };

    $scope.close = function() {
        $modalInstance.dismiss('cancel');
    };
});