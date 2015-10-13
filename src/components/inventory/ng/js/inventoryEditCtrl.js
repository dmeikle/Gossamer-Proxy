module.controller('inventoryEditCtrl', function($scope, inventoryEditSrv) {
  $scope.warehouse = new AngularQueryObject();

  $scope.getWarehouseDetails = function() {
    warehouseEditSrv.getWarehouseDetails().then(function(response) {
      $scope.warehouse = response.data.Warehouse;
    });
  };

  $scope.saveWarehouse = function(object) {
    warehouseEditSrv.save(object).then(function(){
      $scope.getWarehouseDetails();
    });
  };
});
