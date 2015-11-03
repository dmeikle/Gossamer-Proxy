module.controller('inventoryEquipmentEditCtrl', function($scope, $location,
 inventoryEquipmentEditSrv, inventoryTransferSrv) {
    $scope.item = new AngularQueryObject();

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
        });
    };

    $scope.getTransferList = function() {
        $scope.transferHistory = inventoryTransferSrv.getEquipmentTransferHistory($scope.item);
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEquipmentEditSrv.save($scope.item, formToken).then(function(response) {
            window.location.href = '/admin/inventory';
        });
    };
});