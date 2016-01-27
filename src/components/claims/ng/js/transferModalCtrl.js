module.controller('transferModalController', function($scope, $uibModalInstance, inventoryTransferSrv, multiSelectArray, location, wizardSrv) {
    $scope.transfer = {};
    $scope.loading = false;
    $scope.equipmentList = multiSelectArray;
    $scope.location = location;
    
    console.log($scope.equipmentList);
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
//    $scope.warehouseLocation = inventoryTransferSrv.getLocation($scope.equipmentList[0])
//        .then(function() {
//            $scope.loading = false;
//        });

    $scope.$watch('wizardSrv.wizardLoading', function() {
        $scope.wizardLoading = wizardSrv.wizardLoading;
    });

    var autocomplete = function(value, type, apiPath) {
        return inventoryTransferSrv.autocomplete(value, type, apiPath);
    };

    $scope.autocompleteJobNumber = function(value) {
        return autocomplete(value, 'jobNumber', '/admin/claims/autocompletelocations');
    };

    $scope.autocompleteWarehouseLocation = function(value) {
        return autocomplete(value, 'warehouseLocation', '/admin/inventory/warehouse/');
    };
    
    $scope.getClaimLocations = function(claim){
        $scope.transfer.Claims_id = claim[0].Claims_id;
        $scope.claimLocations = claim;
    };
    
    $scope.clearTransfer = function(){
        $scope.transfer = {};
        if($scope.claimLocations){
            $scope.claimLocations = null;
        }
    };

    $scope.submit = function() {        
        for (var property in $scope.transfer) {
            if ($scope.transfer.hasOwnProperty(property) &&
                !$scope.transfer[property]) {
                delete $scope.transfer[property];
            }
        }
        var data = $scope.transfer;
        data.inventoryIds = [];
        for (var equipment in $scope.equipmentList) {
            if ($scope.equipmentList.hasOwnProperty(equipment)) {
                data.inventoryIds.push($scope.equipmentList[equipment].InventoryEquipment_id);
            }
        }
        data.FORM_SECURITY_TOKEN = formToken;

        inventoryTransferSrv.transfer(data).then(function(response) {
            if (!response.data.result || response.data.result !== 'error') {
                $uibModalInstance.close();
            }
        });  
    };

    $scope.close = function() {
        $uibModalInstance.dismiss('cancel');
    };

});