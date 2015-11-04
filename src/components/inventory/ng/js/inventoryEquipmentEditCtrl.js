module.controller('inventoryEquipmentEditCtrl', function($scope, $location,
    inventoryEquipmentEditSrv, inventoryTransferSrv) {
    $scope.item = new AngularQueryObject();
    $scope.loading = true;

    $scope.$watch('item', function() {
        if ($scope.item && $scope.item.id && !$scope.haveDetails) {
            $scope.getDetails();
            $scope.getTransferList();
        }
    });
    $scope.getDetails = function() {
        inventoryEquipmentEditSrv.getDetails($scope.item).then(function(response) {
            $scope.item = response.data.InventoryEquipment[0];
            $scope.haveDetails = true;
            $scope.loading = false;
        });
    };

    $scope.inventoryTransferSrv = inventoryTransferSrv;
    $scope.$watch('inventoryTransferSrv.transferHistory', function() {
        if ($scope.inventoryTransferSrv.transferHistory) {
            $scope.transferHistory = $scope.inventoryTransferSrv.transferHistory;
            $scope.loading = false;
        }
    });
    $scope.getTransferList = function() {
        if (!$scope.transferHistory) {
            inventoryTransferSrv.getEquipmentTransferHistory($scope.item)
                .then(function(response) {
                    inventoryTransferSrv.transferHistory = response.data.InventoryEquipmentHistorys;
                });
        }
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEquipmentEditSrv.save($scope.item, formToken).then(function(response) {
            window.location.href = '/admin/inventory';
        });
    };
});