
module.controller('claimsModalCtrl', function ($q, $uibModalInstance, $scope, claimsEditSrv, 
    claimsLocationsEditSrv) {

    $scope.addNewClient = false;
    $scope.addingLocation = false;

    $scope.unitList = [];
    $scope.project = {};
    $scope.claim = {};
    $scope.claim.query = {};


    // datepicker stuffs
    $scope.isOpen = {};
    $scope.dateOptions = {
        'starting-day': 1
    };
    $scope.openDatepicker = function(event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    var autocomplete = function(value, type) {
        return claimsEditSrv.autocomplete(value, type);
    };

    $scope.autocompleteBuilding = function(value) {
        return autocomplete(value, 'buildingName');
    };

    $scope.autocompleteStrata = function(value) {
        return autocomplete(value, 'stratanumber');
    };

    $scope.autocompleteAddress = function(value) {
        return autocomplete(value, 'address1');
    };

    $scope.selectAddress = function(item) {
        $scope.claim.ProjectAddress = item;
        $scope.claim.query.ProjectAddresses_id = item.id;
        if (item.buildingYear.parseInt <= 1980) {
            $scope.claim.query.asbestosTestRequired = 'true';
        } else {
            $scope.claim.query.asbestosTestRequired = 'false';
        }
    };

    $scope.saveProjectAddress = function(project) {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.saveProjectAddress(project, formToken).then(function(response) {
            $scope.claim.ProjectAddress = response.data.ProjectAddress[0];
            $scope.claim.query.ProjectAddresses_id = response.data.ProjectAddress[0].id;
            $scope.toggleAdding();
            $scope.nextPage();
        });
    };

    $scope.saveNewClaimLocation = function(object) {
        return claimsLocationsEditSrv.save(object);
    };

    $scope.save = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        return claimsEditSrv.save($scope.claim.query, formToken, $scope.currentPage + 1);
    };

    $scope.saveAndNext = function() {
        $scope.save().then(function(response) {
            $scope.claim.query.id = response.data.Claim[0].Claim_id;
            $scope.nextPage();
        });
    };

    $scope.getClaimLocations = function() {
        return claimsEditSrv.getClaimLocations($scope.claim.ProjectAddress)
            .then(function(response) {
                $scope.claimLocations = response.data.ClaimLocations;
                return response;
            });
    };

    $scope.addToUnitList = function() {
        if ($scope.unit) {
            var object = {};
            object.unitNumber = $scope.unit;
            $scope.checkUnitExists(object).then(function(response) {
                if (response === false) {
                    $scope.saveNewClaimLocation(object).then(function(response) {
                        $scope.unitList.push(response.data.ClaimsLocation[0]);
                    });
                } else {
                    $scope.unitList.push(response);
                }
            });
        }
    };

    $scope.checkUnitExists = function(unit) {
        var unitCheck = function(unit) {
            for (var i = $scope.claimLocations.length - 1; i >= 0; i--) {
                if ($scope.claimLocations[i].unitNumber === unit.unitNumber) {
                    return $scope.claimLocations[i];
                }
            }
            return false;
        };


        if (!$scope.claimLocations) {
            return $scope.getClaimLocations().then(function() {
                return unitCheck(unit);
            });
        } else {
            return $q(function(resolve) {
                resolve(unitCheck(unit));
            });
        }
    };

    $scope.removeFromUnitList = function(unit) {
        for (var i = $scope.unitList.length - 1; i >= 0; i--) {
            if (unit === $scope.unitList[i]) { 
                $scope.unitList.splice(i, 1);
            }
        }
    };

    $scope.toggleAdding = function() {
        $scope.addNewClient = !$scope.addNewClient;
    };

    $scope.toggleAddingLocation = function() {
        $scope.addingLocation = !$scope.addingLocation;
    };

    $scope.confirm = function() {
        $uibModalInstance.close($scope.claim.query);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

module.controller('claimLocationModalCtrl', function($scope, $uibModalInstance, claimLocation) {
    if (claimLocation) {
        $scope.item = claimLocation;
    }

    $scope.confirm = function() {
        var data = $scope.item;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        data.FORM_SECURITY_TOKEN = formToken;
        $uibModalInstance.close(data);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});

module.controller('claimsEditModalCtrl', function($scope, $uibModalInstance, claim) {
    $scope.claim = claim;
    $scope.isOpen = {};
    $scope.openDatepicker = function (event) {
        var datepicker = event.target.parentElement.dataset.datepickername;
        $scope.isOpen[datepicker] = true;
    };

    $scope.submit = function() {
        var data = $scope.claim;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        data.FORM_SECURITY_TOKEN = formToken;
        $uibModalInstance.close(data);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };
});