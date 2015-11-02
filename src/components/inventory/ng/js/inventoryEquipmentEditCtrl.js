module.controller('inventoryEquipmentEditCtrl', function($scope, $location, inventoryEquipmentEditSrv) {
    $scope.item = new AngularQueryObject();

    $scope.$watch('item', function() {
        if ($scope.item && $scope.item.id) {
            $scope.getDetails();
        }
    });
    $scope.getDetails = function() {
        inventoryEquipmentEditSrv.getDetails($scope.item).then(function(response) {
            $scope.item = response.data.InventoryItem;
        });
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEquipmentEditSrv.save($scope.item, formToken).then(function(response) {
            window.location.href = '/admin/inventory';
        });
    };
});