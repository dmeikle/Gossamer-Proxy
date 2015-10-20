module.controller('claimsContactsList', function ($scope, claimsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.contacts = [];
    
    listContactsByClaim();

    
    function listContactsByClaim() {
        var jobNumber = document.getElementById('Claim_jobNumberHidden').value;
        
        claimsEditSrv.getContacts(jobNumber).then(function () {
            $scope.contacts = claimsEditSrv.contacts;
            $scope.loading = false;
        });
    }
    
});
