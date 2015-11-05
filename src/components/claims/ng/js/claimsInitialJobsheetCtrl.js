module.controller('initialJobsheetCtrl', function($scope, $location, claimsInitialJobsheetSrv, claimsEditSrv) {
    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }

    var claimId = apiPath.slice(apiPath.indexOf('jobsheet') + 9, apiPath.lastIndexOf('/') + 1);
    var claimLocationId = apiPath.slice(apiPath.lastIndexOf('/') + 1);

    $scope.loading = true;
    $scope.jobSheet = new AngularQueryObject();
    $scope.jobSheet.query.contacts = [];
    $scope.jobSheet.query.contacts.push({});
    $scope.claimsEditSrv = claimsEditSrv;

    $scope.getClaimDetails = function() {
        if (!$scope.claimsEditSrv.claimDetails && !$scope.gettingDetails) {
            $scope.gettingDetails = true;
            claimsEditSrv.getClaimDetails(claimId).then(function(response) {
                $scope.claim = response.data.Claim;
                claimsEditSrv.getProjectAddress($scope.claim.ProjectAddresses_id).then(function(response) {
                    $scope.projectAddress = response.data.ProjectAddress;
                    $scope.loading = false;
                });
            });
        }
    };
    $scope.getClaimDetails();

    $scope.addOwnerTenant = function() {
        $scope.jobSheet.query.contacts.push({});
    };

    $scope.removeOwnerTenant = function(e, index) {
        e.preventDefault();
        $scope.jobSheet.query.contacts.splice(index, 1);
    };

    function save(object, objectType, formToken) {
        return claimsInitialJobsheetSrv.save(object, objectType, formToken, claimId + claimLocationId);
    }

    $scope.saveClaimLocation = function(object) {
        var objectType = 'ClaimLocation';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function() {
            $scope.nextPage();
        });
    };

    $scope.saveContacts = function(object) {
        var objectType = 'Contacts';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function() {
            $scope.nextPage();
        });
    };

    $scope.saveAffectedAreas = function(object) {
        var objectType = 'AffectedAreas';
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        save(object, objectType, formToken).then(function() {
            $scope.nextPage();
        });
    };

    $scope.finish = function() {
        $scope.saveClaimLocation($scope.ClaimLocation);
        $scope.saveContacts($scope.jobSheet.query.contacts);
        $scope.saveAffectedAreas($scope.jobSheet.query.affectedAreas);
        var uri = '/admin/claim/initial-jobsheet/get/' + claimId + claimLocationId;
        window.location.pathname = uri;
    };
});