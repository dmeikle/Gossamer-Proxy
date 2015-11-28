module.controller('initialJobsheetCtrl', function($scope, $rootScope, $location, claimsInitialJobsheetSrv, 
    claimsEditSrv) {
    var a = document.createElement('a');
    a.href = $location.absUrl();
    var apiPath;
    if (a.pathname.lastIndexOf('/') !== a.pathname.length - 1) {
        apiPath = a.pathname;
    } else {
        apiPath = a.pathname.slice(0, -1);
    }

    var claimId = document.getElementById('ClaimLocation_Claims_id').value;
    var claimLocationId = document.getElementById('ClaimLocation_ClaimsLocations_id').value;

    $scope.loading = true;
    $scope.paLoading = true;
    $scope.jobSheet = new AngularQueryObject();
    $scope.jobSheet.query.contacts = [];
    $scope.jobSheet.query.contacts.push({});
    $scope.claimsEditSrv = claimsEditSrv;

    getClaimDetails();

    $rootScope.$on('setLoading', function(event, boolean) {
        $scope.loading = boolean;
    });

    $rootScope.$on('setPaLoading', function(event, boolean) {
        $scope.paLoading = boolean;
    });

    function getClaimDetails() {
        if (!$scope.claimsEditSrv.claimDetails && !$rootScope.gettingDetails) {
            $rootScope.gettingDetails = true;
            claimsEditSrv.getClaimDetails(claimId).then(function(response) {
                $scope.claim = response.data.Claim;
                $rootScope.$broadcast('setLoading', false);
                claimsEditSrv.getProjectAddress($scope.claim.ProjectAddresses_id)
                    .then(function(response) {
                        $scope.projectAddress = response.data.ProjectAddress;
                        $rootScope.$broadcast('setPaLoading', false);
                    });
            });
        }
    }

    $scope.addOwnerTenant = function() {
        $scope.jobSheet.query.contacts.push({});
    };

    $scope.removeOwnerTenant = function(e, index) {
        e.preventDefault();
        $scope.jobSheet.query.contacts.splice(index, 1);
    };

    function save(claimLocation, contacts, affectedAreas) {
        var object = {};
        object.ClaimLocation = claimLocation;
        object.Contacts = contacts;
        object.AffectedAreas = {};
        object.AffectedAreas.AreaTypes_id = [];
        for (var area in affectedAreas) {
            if (claimsInitialJobsheetSrv.roomList.indexOf(area) > 0) {
                object.AffectedAreas.AreaTypes_id.push(claimsInitialJobsheetSrv.roomList.indexOf(area));
            }
        }
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return claimsInitialJobsheetSrv.save(object, formToken, claimId + '/' + claimLocationId);
    }

    $scope.finish = function() {
        save($scope.item, $scope.jobSheet.query.contacts, $scope.jobSheet.query.affectedAreas)
            .then(function() {
                // var uri = '/admin/claim/initial-jobsheet/view/' + claimId + '/' + claimLocationId;
                // window.location.pathname = uri;
            });
    };
});