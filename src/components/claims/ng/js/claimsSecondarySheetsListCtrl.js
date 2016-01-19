
module.controller('secondarySheetsListCtrl', function($scope, $uibModal, claimsSecondarySheetsSrv, tablesSrv) {

    
    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.selectedSheet = {};
    $scope.lastItem = {};
    
    $scope.tablesSrv = tablesSrv;

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getSheetsList();
    });

    $scope.$watch('tablesSrv.sortResult', function() {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.sheetsList = tablesSrv.sortResult.Sheets;
            $scope.loading = false;
        }
    });

    $scope.selectRow = function(clickedObject) {
        $scope.searching = false;
        $scope.lastItem = {};
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.selectedSheet = clickedObject;
            $scope.sidePanelLoading = true;
            $scope.sidePanelOpen = true;
            claimsSecondarySheetsSrv.getSheetActions(clickedObject)
                .then(function(response) {
                    $scope.selectedSheet.actionsList = response.sheetActionsList;
                    $scope.sidePanelLoading = false;
                    $scope.hasActions = response.sheetActionsListCount > 0;
                });
        }
    };
    
    $scope.getClass = function(item) {
        if(item.isDone == 1) {
            return 'bg-success';
        }
        
        return '';
    };
    
    $scope.isNewHeading = function(item) {
        if(item.SecondarySheetCategories_id == $scope.lastItem.SecondarySheetCategories_id) {
            return false;
        }
        
        $scope.lastItem = item;
        return true;
    };
    
    $scope.openAddNewWizard = function() {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/secondarySheetsAddNewModal',
            controller: 'secondarySheetsModalCtrl',
            size: 'lg',
            backdrop: 'static'
        });

        modalInstance.result.then(function() {
            getSheetsList();
        });
    };

    $scope.assignPM = function (claim) {

        $uibModal.open({
            templateUrl: '/render/claims/assignPMModal',
            controller: 'secondarySheetsPMModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: 'static',
            resolve: {
                claim: function () {
                    return claim;
                }
            }
        });
    };

    $scope.closeSidePanel = function() {
        $scope.sidePanelOpen = false;                
    };

    function getSheetsList() {
        $scope.loading = true;
        var claimId = document.getElementById('Claims_id').value;
        var claimLocationsId = document.getElementById('ClaimsLocations_id').value;
        var affectedAreasId = document.getElementById('AffectedAreas_id').value;
        
        $scope.claimId = claimId;
        $scope.claimsLocationsId = claimLocationsId;
        $scope.affectedAreasId = affectedAreasId;
        
        claimsSecondarySheetsSrv.getSheetsList(claimId, claimLocationsId, affectedAreasId).then(function(response) {
            $scope.sheetsList = response.sheetsList;
            $scope.totalItems = response.sheetsCount;
            $scope.loading = false;
        });
    }


    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            claimsSecondarySheetsSrv.search(copiedObject).then(function() {
                $scope.secondarySheetsList = claimsSecondarySheetsSrv.searchResults;
                $scope.totalItems = claimsSecondarySheetsSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getSheetsList();
    };
});

