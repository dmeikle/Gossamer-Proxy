module.controller('claimsLocationsListCtrl', function($scope, $location, $modal, claimsListSrv,
    claimsLocationsListSrv, claimsLocationsEditSrv, tablesSrv) {

    var row = 0;
    var numRows = 20;

    $scope.currentPage = 1;
    $scope.itemsPerPage = 20;

    $scope.tablesSrv = tablesSrv;

    $scope.$watch('tablesSrv.sortResult', function() {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
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


    $scope.openClaimLocationModal = function(object) {
        var modalInstance = $modal.open({
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
            if (document.getElementById('Claims_id')) {
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


    $scope.getList = function() {
        $scope.loading = true;
        if (document.getElementById('Claim_id')) {
            var claimId = document.getElementById('Claim_id').value;

            claimsLocationsListSrv.getList(claimId).then(function(response) {
                $scope.claimsLocations = response.data.ClaimsLocations;
                $scope.loading = false;
            });
        }
    };

    $scope.getStatusColor = function(item) {
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
            if (document.getElementById('Claims_id')) {
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
