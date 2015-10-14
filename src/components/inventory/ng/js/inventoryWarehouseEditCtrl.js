module.controller('warehouseEditCtrl', function($scope, $location, warehouseEditSrv) {
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
