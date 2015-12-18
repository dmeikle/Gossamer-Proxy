
module.controller('claimLocationModalCtrl', function($scope, $uibModalInstance, claimLocation, claim, claimsLocationsEditSrv) {

    if (claimLocation) {
        $scope.item = claimLocation;
    }
    if (claim) {
        $scope.claim = claim;
    }

    $scope.confirm = function() {
        var object = $scope.item;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        if (document.getElementById('Claim_id')) {
            object.Claims_id = document.getElementById('Claim_id').value;

            claimsLocationsEditSrv.save(object, formToken).then(function(response) {
                if (!response.data.result || response.data.result !== 'error') {
                    $uibModalInstance.close();
                }
            });
        } else {
            object.Claims_id = claim.Claims_id; 

            claimsLocationsEditSrv.save(object, formToken).then(function(response) {
                if (!response.data.result || response.data.result !== 'error') {
                    $uibModalInstance.close();
                }
            });
        }
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});
