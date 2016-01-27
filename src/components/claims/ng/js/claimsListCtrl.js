
module.controller('claimsListCtrl', function($scope, $controller, $location, $uibModal, claimsEditSrv, claimsListSrv, 
    photoUploadSrv, tablesSrv, searchSrv) {


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
    
    $scope.claimsListSrv = claimsListSrv;
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
            templateUrl: '/render/claims/addNewWizardPages',
            controller: 'claimsModalCtrl',
            size: 'lg',
            backdrop: 'static'
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
            backdrop: 'static',
            resolve: {
                claim: function() {
                    return claim;
                }
            }
        });
    };

    $scope.openPhotoUploadModal = function(claim) {
        $uibModal.open({
            templateUrl: '/render/claims/photoUploadModal',
            controller: 'photoUploadModalCtrl',
            size: 'lg',
            backdrop: 'static',
            resolve: {
                claim: function() {
                    return claim;
                },
                
                photoCounts: function() {
                    return photoUploadSrv.getPhotoCount(claim.id).then(function(response) {
                        return response.data.folderList.unitNumbers;
                    });
                }
            }
        });
    };
    
    $scope.openCustomersModal = function(template, location, customer) {
        $uibModal.open({
            templateUrl: template,
            controller: 'ClaimsLocationsCustomerModalCtrl',
            controllerAs: 'modal',
            size: 'md',
            backdrop: 'static',
            resolve: {
                location: function() {
                    return location;
                },
                customer: function() {
                    return customer;
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



    $scope.openAdvancedSearch = function () {
        $scope.sidePanelOpen = true;
        $scope.selectedStaff = undefined;
        $scope.searching = true;
    };

    $scope.resetAdvancedSearch = function () {
        $scope.advancedSearch.query = {};
        getClaimsList();
    };
    
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
        getClaimsList();
    };

    $scope.remove = function(object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.setInactive(object, formToken).then(function() {
            getClaimsList();
        });
    };
});
