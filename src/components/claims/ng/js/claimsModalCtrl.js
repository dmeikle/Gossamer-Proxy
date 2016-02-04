
module.controller('claimsModalCtrl', function ($filter, $uibModalInstance, $scope, claimsEditSrv, 
    claimsLocationsEditSrv) {

    $scope.addNewClient = false;
    $scope.addingLocation = false;

    $scope.unitList = [];
    $scope.project = {};
    $scope.claim = {};
    $scope.claim.query = {};
    $scope.claim.query.currentClaimPhases_id = '1';
    $scope.currentPage = 0;
    $scope.wizardLoading = false;   
    $scope.sourceUnit = {};
    
    var init = function() {
        $scope.unitList = [];
        $scope.project = {};
        $scope.claim = {};
        $scope.claim.query = {};
        $scope.claim.query.currentClaimPhases_id = '1';
        $scope.currentPage = 0;
        $scope.wizardLoading = false;  
    };
    
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
        if (parseInt(item.buildingYear) < 1981) {
            $scope.claim.query.asbestosTestRequired = '1';
        } else {
            $scope.claim.query.asbestosTestRequired = '0';
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
        if ($scope.unit && !$scope.checkUnitExists($scope.unit)) {
            var object = {};
            object.unitNumber = $scope.unit;
            object.ProjectAddresses_id = $scope.claim.query.ProjectAddresses_id;
            object.Claims_id = $scope.claim.query.id;
            object.isActive = 1;
            
            $scope.saveNewClaimLocation(object).then(function(response) {
                $scope.unitList.push(response.data.ClaimsLocation[0]);
            });
            
            $scope.unit = '';
        }
    };

    $scope.getSourceUnitClass = function(unit) {
        if(unit.id == $scope.sourceUnit.id) {
            return 'bg-warning';
        }
        
        return '';
    };

    $scope.setSourceUnit = function(unit) {
        var data = {};
        data.id = $scope.claim.query.claim_id;
        data.sourceUnitClaimsLocations_id = unit.id;
        $scope.sourceUnit = unit;
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        
        return claimsEditSrv.save(data, formToken);
    };
    
    //check to ensure this isn't a duplicate entry
    $scope.checkUnitExists = function(unitNumber) {
        for (var i = 0; i < $scope.unitList.length; i++) {
            if (unitNumber === $scope.unitList[i].unitNumber) { 
                return true;
            }
        }
        
        return false;
    };
    
    $scope.removeFromUnitList = function(unit) {
        for (var i = 0; i < $scope.unitList.length; i++) {
            if (unit === $scope.unitList[i]) { 
                $scope.unitList.splice(i, 1);
            }
        }
        claimsLocationsEditSrv.delete(unit);
    };

    $scope.toggleAdding = function() {
        $scope.addNewClient = !$scope.addNewClient;
    };

    $scope.toggleAddingLocation = function() {
        $scope.addingLocation = !$scope.addingLocation;
    };

    $scope.setContentsNeeded = function(contents) {
        $scope.claim.query.contentsNeeded = contents;
    };

    $scope.confirm = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        $scope.claim.query.isActive = 1;
        $scope.claim.query.ClaimTypes_id = $scope.claim.ClaimTypes_id;
        $scope.claim.query.ClaimTypes_other = $scope.claim.ClaimTypes_other;
        $scope.claim.query.currentClaimPhases_id = $scope.claim.ClaimPhases_id;        
        $scope.claim.query.callInDate = $filter('date')($scope.claim.query.callInDate, 'yyyy-MM-dd', '+0000');
        
        claimsEditSrv.save($scope.claim.query, formToken).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                init();
                $uibModalInstance.close();
            }
        });
    };

    $scope.cancel = function() {
        init();
        $uibModalInstance.dismiss('cancel');           
    };
        

    $scope.nextPage = function() {
        $scope.currentPage++;
    };


    $scope.prevPage = function() {
        $scope.currentPage--;
    };

});
