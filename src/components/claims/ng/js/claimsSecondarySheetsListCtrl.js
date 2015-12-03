
module.controller('secondarySheetsListCtrl', function($scope, $uibModal, secondarySheetsListSrv, tablesSrv) {

    
    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.selectedSheet = {};

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
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.selectedSheet = clickedObject;
            $scope.sidePanelLoading = true;
            $scope.sidePanelOpen = true;
            secondarySheetsListSrv.getSheetLocations(clickedObject.id)
                .then(function() {
                    $scope.selectedSheet.locations = secondarySheetsListSrv.secondarySheetsLocations;
                });
            secondarySheetsListSrv.getSheetContacts(clickedObject)
                .then(function() {
                    $scope.selectedSheet.contacts = secondarySheetsListSrv.claimContacts;
                    $scope.sidePanelLoading = false;
                });
        }
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
        
        secondarySheetsListSrv.getSheetsList(claimId, claimLocationsId).then(function(response) {
            $scope.sheetsList = secondarySheetsListSrv.sheetsList;
            $scope.totalItems = secondarySheetsListSrv.sheetsCount;
            $scope.loading = false;
        });
    }


    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            secondarySheetsListSrv.search(copiedObject).then(function() {
                $scope.secondarySheetsList = secondarySheetsListSrv.searchResults;
                $scope.totalItems = secondarySheetsListSrv.searchResultsCount;
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