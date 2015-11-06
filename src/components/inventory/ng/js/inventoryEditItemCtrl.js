module.controller('inventoryEditItemCtrl', function($scope, $location, inventoryEditSrv) {
    $scope.item = new AngularQueryObject();


    $scope.getDetails = function() {
        inventoryEditSrv.getDetails($scope.item).then(function(response) {
            $scope.item = response.data.InventoryItem;
        });
    };

    $scope.saveItem = function() {
        var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
        inventoryEditSrv.save($scope.item, formToken).then(function(response) {
            //do not fire a redirect to reload page
        });
    };
});