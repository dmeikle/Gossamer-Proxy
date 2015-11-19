module.controller('claimsLocationsListCtrl', function ($scope, $location, $uibModal, claimsListSrv, tablesSrv) {

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
            backdrop: 'static'
        });

        modalInstance.result.then(function (claim) {
            claimsEditSrv.save(claim).then(function () {
                getClaimsList();
            });
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

});
