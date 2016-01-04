
module.controller('claimLocationModalCtrl', function($scope, $uibModalInstance, claimLocation, claim, claimsLocationsEditSrv) {

    if (claimLocation) {
        $scope.location = claimLocation;
    }
    if (claim) {
        $scope.claim = claim;
    }

    $scope.confirm = function() {
        var object = getClaimLocationObject();
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        claimsLocationsEditSrv.save(object, formToken).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
    
    function getClaimLocationObject() {
        if($scope.location) {
            return $scope.location;
        }
        
        var object = {};
        object.Claims_id = claim.id;
        
    }
});
