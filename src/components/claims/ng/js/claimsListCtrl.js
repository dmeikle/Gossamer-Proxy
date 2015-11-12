
module.controller('claimsListCtrl', function($scope, $location, $modal, claimsEditSrv, claimsListSrv, 
    claimsLocationsListSrv, tablesSrv) {

    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }
    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.selectedClaim = {};

    $scope.tablesSrv = tablesSrv;

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function () {
        $scope.loading = true;
        row = (($scope.currentPage - 1) * $scope.itemsPerPage);
        numRows = $scope.itemsPerPage;
        getClaimsList();
    });

    $scope.$watch('tablesSrv.sortResult', function() {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });

    $scope.selectRow = function(clickedObject) {
        $scope.searching = false;
        if ($scope.previouslyClickedObject !== clickedObject) {
            $scope.previouslyClickedObject = clickedObject;
            $scope.selectedClaim = clickedObject;
            $scope.sidePanelLoading = true;
            $scope.sidePanelOpen = true;
            claimsListSrv.getClaimLocations(clickedObject.id)
                .then(function() {
                    $scope.selectedClaim.locations = claimsListSrv.claimsLocations;
                });
            claimsListSrv.getClaimContacts(clickedObject)
                .then(function() {
                    $scope.selectedClaim.contacts = claimsListSrv.claimContacts;
                    $scope.sidePanelLoading = false;
                });
        }
    };

    $scope.openAddNewWizard = function() {
        var modalInstance = $modal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            backdrop: 'static'
        });

        modalInstance.result.then(function() {
            getClaimsList();
        });
    };

    $scope.assignPM = function (claim) {

        $modal.open({
            templateUrl: '/render/claims/assignPMModal',
            controller: 'claimsPMModalCtrl',
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

    function getClaimsList() {
        $scope.loading = true;
        claimsListSrv.getClaimsList(row, numRows).then(function(response) {
            $scope.claimsList = response.data.Claims;
            $scope.totalItems = response.data.ClaimsCount[0].rowCount;
            $scope.loading = false;
        });
    }


    $scope.search = function(searchObject) {
        $scope.noResults = undefined;
        var copiedObject = angular.copy(searchObject);
        if (copiedObject && Object.keys(copiedObject).length > 0) {
            $scope.searchSubmitted = true;
            $scope.loading = true;
            claimsListSrv.search(copiedObject).then(function() {
                $scope.claimsList = claimsListSrv.searchResults;
                $scope.totalItems = claimsListSrv.searchResultsCount;
                $scope.loading = false;
            });
        }
    };

    $scope.resetSearch = function() {
        $scope.searchSubmitted = false;
        $scope.basicSearch.query = {};
        getStaffList();
    };
});

module.controller('claimsPMModalCtrl', function ($modalInstance, $scope, claimsListSrv, claim) {
    $scope.staffList = [];

    $scope.claim = claim;


    $scope.autocomplete = function (value) {
        return autocomplete(value, 'projectmanager');
    };


    $scope.selectPM = function (Staff_id) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        claim.projectManager_id = Staff_id;
        delete claim.currentClaimPhases_id;
        delete claim.workAuthorizationReceiveDate;
        delete claim.ClaimTypes_id;
        
        claimsListSrv.saveProjectManager(claim, formToken).then(function (response) {
            $scope.claim.jobNumber = response.jobNumber;
            $scope.confirm();
        });
    };


    $scope.confirm = function () {
        $modalInstance.close($scope.claim.query);
    };

    $scope.cancel = function () {
        $modalInstance.dismiss('cancel');
    };
});