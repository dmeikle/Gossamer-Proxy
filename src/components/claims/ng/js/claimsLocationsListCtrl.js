
module.controller('claimsLocationsListCtrl', function ($scope, $uibModal, tablesSrv, claimsListSrv, claimsLocationsEditSrv, claimsEditSrv) {


    var row = 0;
    var numRows = 20;

    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;


    $scope.loading = true;
    $scope.tablesSrv = tablesSrv;

    getClaimsLocationsList();

    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });


    $scope.openAddNewWizard = function () {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: "static"

        });
    };

    $scope.openClaimLocationModal = function(object) {
        var modalInstance = $uibModal.open({
            templateUrl: '/render/claims/claimLocationModal',
            controller: 'claimLocationModalCtrl',
            size: 'md',
            resolve: {
                claimLocation: function() {
                    return object;
                }
            }
        });

         modalInstance.result.then(function(object) {
            if (document.getElementById('Claim_id')) {
                object.Claims_id = document.getElementById('Claim_id').value;
                
                claimsLocationsEditSrv.save(object).then(function() {
                    $scope.getList();
                });
            } else {
                object.Claims_id = $scope.selectedClaim.Claims_id;
                
                claimsLocationsEditSrv.save(object).then(function() {
                    claimsListSrv.getClaimLocations($scope.selectedClaim.Claims_id)
                        .then(function() {
                            $scope.selectedClaim.locations = claimsListSrv.claimsLocations;
                        });
                });
            }
            
        });
    };


    function getClaimsLocationsList() {
        $scope.loading = true;
        var claimId = document.getElementById('Claim_id').value;

        claimsListSrv.getClaimLocations(claimId).then(function () {
            $scope.claimsLocations = claimsListSrv.claimsLocations;
            $scope.loading = false;
        });
    }

    $scope.getStatusColor = function (item) {
        if (item.WorkStatus_id == 1) {
            return 'warning';
        } else if (item.WorkStatus_id == 2) {
            return 'success';
        } else {
            return 'danger';
        }
    };

    $scope.delete = function(object) {
        object.FORM_SECURITY_TOKEN = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.isActive = '0';
        claimsLocationsEditSrv.delete(object).then(function() {
            if (document.getElementById('Claim_id')) {
                object.Claims_id = document.getElementById('Claim_id').value;

                claimsLocationsEditSrv.save(object).then(function() {
                    $scope.getList();
                });
            } else {
                object.Claims_id = $scope.selectedClaim.Claims_id;

                claimsLocationsEditSrv.save(object).then(function() {
                    claimsListSrv.getClaimLocations($scope.selectedClaim.Claims_id)
                        .then(function() {
                            $scope.selectedClaim.locations = claimsListSrv.claimsLocations;
                        });
                });
            }
        });
    };

});
