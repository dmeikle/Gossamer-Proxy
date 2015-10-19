module.controller('claimsEditCtrl', function ($scope, $location, claimsEditSrv) {

    // Run on load
    $scope.loading = true;
    $scope.authorizationLoading = true;
    $scope.authorization = {};
    $scope.isOpen = {};
    getProjectAddress();
    getClaimDetails();
    
    // datepicker stuffs
    $scope.dateOptions = {'starting-day': 1};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    function getClaimDetails() {
       
        var claimId = document.getElementById('Claim_id').value;

        claimsEditSrv.getClaimDetails(claimId).then(function () {
            $scope.claim = claimsEditSrv.claimDetails;            
            $scope.loading = false;
            
        });
    }

    function getProjectAddress() {
       
        var addressId = document.getElementById('Claim_ProjectAddresses_id').value;
        
        claimsEditSrv.getProjectAddress(addressId).then(function () {
            $scope.projectAddress = claimsEditSrv.projectAddress;
            $scope.loading = false;
        });
    }

    $scope.save = function (object) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        object.id = object.claimsId;
        claimsEditSrv.save(object, formToken).then(function () {
            getClaimDetails();
        });
    };

    $scope.discardChanges = function () {
        getClaimDetails();
    };



    $scope.clearErrors = function () {
        $scope.credentialStatus = undefined;
    };
    
});
