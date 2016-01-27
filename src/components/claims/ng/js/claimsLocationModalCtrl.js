
module.controller('claimLocationModalCtrl', function($scope, $uibModalInstance, claimLocation, claim, claimsLocationsEditSrv) {

    if (claimLocation) {
        $scope.location = claimLocation;
    }
    if (claim) {
        $scope.claim = claim;
    }
    
//    console.log(claim);
//    console.log(claimLocation);
    $scope.confirm = function() {
        var object = getClaimLocationObject();
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
//        console.log(object);
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
        if(claim) {
            $scope.location.Claims_id = claim.id;
            return $scope.location;
        } else {
            return $scope.location;
        }
    }
});
