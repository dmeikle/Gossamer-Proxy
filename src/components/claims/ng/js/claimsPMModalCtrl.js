
module.controller('claimsPMModalCtrl', function($uibModalInstance, $scope, claimsListSrv, claim) {
    $scope.staffList = [];

    $scope.claim = claim;


    $scope.autocomplete = function(value) {
        return autocomplete(value, 'projectmanager');
    };


    $scope.selectPM = function(Staff_id) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        claim.projectManager_id = Staff_id;
        delete claim.currentClaimPhases_id;
        delete claim.workAuthorizationReceiveDate;
        delete claim.ClaimTypes_id;

        claimsListSrv.saveProjectManager(claim, formToken).then(function(response) {
            $scope.claim.jobNumber = response.jobNumber;
            $scope.confirm();
        });
    };


    $scope.confirm = function() {
        $uibModalInstance.close($scope.claim.query);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

});
