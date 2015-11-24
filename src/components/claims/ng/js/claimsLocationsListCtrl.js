
module.controller('claimsLocationsListCtrl', function ($scope, $uibModal, tablesSrv, claimsLocationsListSrv) {


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
            object.Claims_id = document.getElementById('Claim_id').value;

            claimsLocationsEditSrv.save(object).then(function() {
                $scope.getList();
            });
        });
    };


    $scope.getList = function() {
        $scope.loading = true;
        var claimId = document.getElementById('Claim_id').value;

        claimsLocationsListSrv.getList(claimId).then(function(response) {
            $scope.claimsLocations = response.data.ClaimsLocations;
            $scope.loading = false;
        });
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
            $scope.getList();
        });
    };

});
