
module.controller('claimsListCtrl', function($scope, $controller, $location, $uibModal, claimsEditSrv, claimsListSrv, tablesSrv, searchSrv) {


    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }
    var row = 0;
    var numRows = 20;
    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;
    $scope.basicSearch = {};
    $scope.advancedSearch = {};
    $scope.autocomplete = {};
    $scope.selectedClaim = {};
    $scope.loading = true;

    $scope.tablesSrv = tablesSrv;
    $controller('claimsLocationsListCtrl', {$scope: $scope});

    $scope.$watch('tablesSrv.sortResult', function() {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });

    $scope.$watchGroup(['currentPage', 'itemsPerPage'], function() {
        if ($scope.currentPage && $scope.itemsPerPage) {
            row = (($scope.currentPage - 1) * $scope.itemsPerPage);
            numRows = $scope.itemsPerPage;

            if ($scope.grouped) {
                tablesSrv.groupBy(apiPath, $scope.groupedBy, row, numRows);
            } else {
                getClaimsList();
            }
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
        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            backdrop: "static"
        });

        modalInstance.result.then(function() {
            getClaimsList();
        });
    };

    $scope.assignPM = function(claim) {

        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/assignPMModal',
            controller: 'claimsPMModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: "static",
            resolve: {
                claim: function() {
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

module.controller('claimsPMModalCtrl', function($uibModalInstance, $scope, claimsListSrv, claim) {
    $scope.staffList = [];

    $scope.claim = claim;


    $scope.autocomplete = function(value) {
        return autocomplete(value, 'projectmanager');
    };


    $scope.selectPM = function(Staff_id) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        claim.projectManager_id = Staff_id;
        delete claim.currentClaimPhases_id;
        delete claim.workAuthorizationReceiveDate;
        delete claim.ClaimTypes_id;

        claimsListSrv.saveProjectManager(claim, formToken).then(function(response) {
            $scope.claim.jobNumber = response.jobNumber;
            $scope.confirm();
        });
    };


    $scope.confirm = function() {
        $uibModalInstance.close($scope.claim.query);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

});

module.controller('claimsModalCtrl', function($uibModalInstance, $scope, claimsEditSrv) {

    $scope.addNewClient = false;


    $scope.project = {};
    $scope.claim = {};
    $scope.claim.query = {};


    // datepicker stuffs
    $scope.isOpen = {};
    $scope.dateOptions = {
        'starting-day': 1
    };
    $scope.openDatepicker = function(event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    var autocomplete = function(value, type) {
        return claimsEditSrv.autocomplete(value, type);
    };

    $scope.autocompleteBuilding = function(value) {
        return autocomplete(value, 'buildingName');
    };

    $scope.autocompleteStrata = function(value) {
        return autocomplete(value, 'stratanumber');
    };

    $scope.autocompleteAddress = function(value) {
        return autocomplete(value, 'address1');
    };

    $scope.selectAddress = function(item, model, label) {
        $scope.claim.ProjectAddress = item;
        $scope.claim.query.ProjectAddresses_id = item.id;
        if (item.buildingYear.parseInt <= 1980) {
            $scope.claim.query.asbestosTestRequired = 'true';
        } else {
            $scope.claim.query.asbestosTestRequired = 'false';
        }
    };

    $scope.saveProjectAddress = function(project) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.saveProjectAddress(project, formToken).then(function(response) {
            $scope.claim.ProjectAddress = response.data.ProjectAddress[0];
            $scope.claim.query.ProjectAddresses_id = response.data.ProjectAddress[0].id;
            $scope.toggleAdding();
            $scope.nextPage();
        });
    };

    $scope.save = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return claimsEditSrv.save($scope.claim.query, formToken, $scope.currentPage + 1);
    };

    $scope.saveAndNext = function() {
        $scope.save().then(function(response) {
            $scope.claim.query.id = response.data.Claim[0].Claim_id;
            $scope.nextPage();
        });
    };

    $scope.toggleAdding = function() {
        $scope.addNewClient = !$scope.addNewClient;
    };

    $scope.confirm = function() {
        $uibModalInstance.close($scope.claim.query);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});