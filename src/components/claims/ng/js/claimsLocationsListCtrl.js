
module.controller('claimsLocationsListCtrl', function ($scope, $uibModal, tablesSrv, claimsListSrv, claimsLocationsListSrv) {


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
            },
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
