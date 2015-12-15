
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
        $scope.saving = true;
        $scope.save().then(function(response) {
            $scope.saving = false;
            $scope.claim.query = response.data.Claim[0];
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
            object.ProjectAddresses_id = $scope.claim.query.ProjectAddresses_id;
            object.Claims_id = $scope.claim.query.id;

            // $scope.checkUnitExists(object).then(function(response) {
            //     if (response === false && $scope.claimLocations.indexOf($scope.unit)) {
            //         $scope.saveNewClaimLocation(object).then(function(response) {
            //             $scope.unitList.push(response.data.ClaimsLocation[0]);
            //         });
            //     } else if ($scope.claimLocations.indexOf($scope.unit)) {
            //         $scope.unitList.push(response);
            //     }
            // });


            $scope.saveNewClaimLocation(object).then(function(response) {
                $scope.unitList.push(response.data.ClaimsLocation[0]);
            });
        }
    };

    // DEPRECATED

    // $scope.checkUnitExists = function(unit) {
    //     var unitCheck = function(unit) {
    //         for (var i = $scope.claimLocations.length - 1; i >= 0; i--) {
    //             if ($scope.claimLocations[i].unitNumber === unit.unitNumber) {
    //                 return $scope.claimLocations[i];
    //             }
    //         }
    //         return false;
    //     };


    //     if (!$scope.claimLocations) {
    //         return $scope.getClaimLocations().then(function() {
    //             return unitCheck(unit);
    //         });
    //     } else {
    //         return $q(function(resolve) {
    //             resolve(unitCheck(unit));
    //         });
    //     }
    // };

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
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        claimsEditSrv.save($scope.claim.query, formToken).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        if ($scope.claim.query.id) {
            var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
            claimsEditSrv.setInactive($scope.claim.query, formToken).then(function() {
                $uibModalInstance.dismiss('cancel');
            });
        } else {
            $uibModalInstance.dismiss('cancel');
        }
    };
});


module.controller('claimLocationModalCtrl', function($scope, $uibModalInstance, claimLocation, claim, claimsLocationsEditSrv) {

    if (claimLocation) {
        $scope.item = claimLocation;
    }
    if (claim) {
        $scope.claim = claim;
    }

    $scope.confirm = function() {
        var object = $scope.item;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;

        if (document.getElementById('Claim_id')) {
            object.Claims_id = document.getElementById('Claim_id').value;

            claimsLocationsEditSrv.save(object, formToken).then(function(response) {
                if (!response.data.result || response.data.result !== 'error') {
                    $uibModalInstance.close();
                }
            });
        } else {
            object.Claims_id = claim.Claims_id; //$scope.selectedClaim.Claims_id;

            claimsLocationsEditSrv.save(object, formToken).then(function(response) {
                if (!response.data.result || response.data.result !== 'error') {
                    $uibModalInstance.close();
                }
            });
        }
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