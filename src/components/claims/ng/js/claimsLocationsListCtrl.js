module.controller('claimsLocationsListCtrl', function ($scope, $location, $modal,  claimsListSrv, tablesSrv, searchSrv) {

    var row = 0;
    var numRows = 20;
   

    $scope.tablesSrv = tablesSrv;

    getClaimsLocationsList();

    $scope.$watch('tablesSrv.sortResult', function () {
        if (tablesSrv.sortResult !== undefined && tablesSrv.sortResult !== {}) {
            $scope.claimsList = tablesSrv.sortResult.Claims;
            $scope.loading = false;
        }
    });


    $scope.openAddNewWizard = function () {
        var modalInstance = $modal.open({
            templateUrl: '/render/claims/claimsAddNewModal',
            controller: 'claimsModalCtrl',
            size: 'lg',
            keyboard: false,
            backdrop: "static"
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
        
        claimsListSrv.getClaimLocations(claimId).then(function (response) {
            $scope.claimsLocations = claimsListSrv.claimsLocations;
        }).then(function () {
            $scope.loading = false;
        });
    }


});
