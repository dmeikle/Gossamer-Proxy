module.controller('initialJobsheetCtrl', function($scope, $rootScope, claimsInitialJobsheetSrv, claimsEditSrv) {
    

    
    var editPage;
    if (document.getElementById('editPage')) {
        editPage = true;
    }
    $scope.loading = true;
    $scope.paLoading = true;
    $scope.jobSheet = new AngularQueryObject();
    $scope.jobSheet.affectedAreas = {};
    $scope.jobSheet.contacts = [];
    $scope.jobSheet.contacts.push({});
    $scope.claimsEditSrv = claimsEditSrv;

    getClaimDetails();
    $scope.getClaimDetails = getClaimDetails;
   
    

    function getClaimDetails() {

        var claimId = document.getElementById('ClaimLocation_Claims_id').value;
        var claimLocationId = document.getElementById('ClaimLocation_ClaimsLocations_id').value;

        claimsInitialJobsheetSrv.getJobsheetDetails(claimId, claimLocationId).then(function(response) {
            //var areaList = claimsInitialJobsheetSrv.roomList;
            $scope.areaList = response.data.AffectedAreas;
            $scope.location = response.data.ClaimLocation[0];
            $scope.contacts = response.data.Contacts;
            $scope.equipment = response.data.InventoryEquipment;
            $scope.claim = response.data.Claim[0];
            $scope.loading = false;
            for (var i = 0; i < $scope.areaList.length; i++) {
                var index = $scope.areaList[i].AreaTypes_id;
                $scope.jobSheet.affectedAreas[parseInt(index)] = true;
            }
            $rootScope.gettingDetails = false;
        });


    }

    $scope.addOwnerTenant = function() {
        $scope.contacts.push({});
    };

    $scope.removeOwnerTenant = function(e, index) {
        $scope.contacts.splice(index, 1);
    };

    function save(claimLocation, contacts, affectedAreas) {
        var object = {};
        object.ClaimLocation = claimLocation;
        object.Contacts = contacts;
        object.AffectedAreas = affectedAreas;
        object.AffectedAreas.AreaTypes_id = [];
        
        var claimId = document.getElementById('ClaimLocation_Claims_id').value;
        var claimLocationId = document.getElementById('ClaimLocation_ClaimsLocations_id').value;

        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return claimsInitialJobsheetSrv.save(object, formToken, claimId + '/' + claimLocationId);
    }

    $scope.finish = function() {
        if (!editPage) {
            save($scope.location, $scope.jobSheet.contacts, $scope.jobSheet.affectedAreas)
                .then(function() {
                    var uri = '/admin/claim/initial-jobsheet/view/' + claimId + '/' + claimLocationId;
                    window.location.pathname = uri;
                });
        } else {
            save($scope.location, $scope.contacts, $scope.jobSheet.affectedAreas);
        }
    };
});