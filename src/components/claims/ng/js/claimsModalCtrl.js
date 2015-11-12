
module.controller('claimsModalCtrl', function ($uibModalInstance, $scope, claimsEditSrv, 
    claimsLocationsEditSrv) {

    $scope.addNewClient = false;
    $scope.addingLocation = false;


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
        claimsLocationsEditSrv.save(object).then(function() {
            $scope.toggleAddingLocation();
        });
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