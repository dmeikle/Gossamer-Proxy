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
    var editPage;
    if (document.getElementById('editPage')) {
        editPage = true;
    }
    $scope.loading = true;
    $scope.paLoading = true;
    $scope.jobSheet = new AngularQueryObject();
    $scope.jobSheet.query.affectedAreas = {};
    $scope.jobSheet.query.contacts = [];
    $scope.jobSheet.query.contacts.push({});
    $scope.claimsEditSrv = claimsEditSrv;

    getClaimDetails();
    $scope.getClaimDetails = getClaimDetails;
    $rootScope.$on('setLoading', function(event, boolean) {
        $scope.loading = boolean;
    });

    $rootScope.$on('setPaLoading', function(event, boolean) {
        $scope.paLoading = boolean;
    });

    function getClaimDetails() {
        if (!$rootScope.gettingDetails) {
            $rootScope.gettingDetails = true;
            claimsEditSrv.getClaimDetails(claimId).then(function(response) {
                $scope.claim = response.data.Claim;
                if (!editPage) {
                    $rootScope.$broadcast('setLoading', false);
                    $rootScope.gettingDetails = false;
                }
                claimsEditSrv.getProjectAddress($scope.claim.ProjectAddresses_id)
                    .then(function(response) {
                        $scope.projectAddress = response.data.ProjectAddress;
                        $rootScope.$broadcast('setPaLoading', false);
                    });
                if (editPage) {
                    claimsInitialJobsheetSrv.getJobsheetDetails(claimId, claimLocationId)
                        .then(function(response) {
                            var areaList = claimsInitialJobsheetSrv.roomList;
                            $scope.item = response.data.ClaimLocation[0];
                            $scope.jobSheet.query.contacts = response.data.Contacts;
                            for (var area in response.data.AffectedAreas) {
                                $scope.jobSheet.query.affectedAreas[areaList[response.data.AffectedAreas[area].AreaTypes_id]] = true;
                            }
                            $rootScope.$broadcast('setLoading', false);
                            $rootScope.gettingDetails = false;
                        });
                }
            });
        }
    }

    $scope.addOwnerTenant = function() {
        $scope.jobSheet.query.contacts.push({});
    };

    $scope.removeOwnerTenant = function(e, index) {
        e.preventDefault();
        $scope.jobSheet.query.contacts[index].isActive = '0';
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
        if (!editPage) {
            save($scope.item, $scope.jobSheet.query.contacts, $scope.jobSheet.query.affectedAreas)
                .then(function() {
                    var uri = '/admin/claim/initial-jobsheet/view/' + claimId + '/' + claimLocationId;
                    window.location.pathname = uri;
                });
        } else {
            save($scope.item, $scope.jobSheet.query.contacts, $scope.jobSheet.query.affectedAreas)
                .then(function() {
                    $rootScope.$broadcast('setLoading', true);
                    $scope.getClaimDetails();
                });
        }
    };
});