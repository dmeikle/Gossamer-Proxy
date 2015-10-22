module.service('warehouseEditSrv', function(crudSrv) {
  var apiPath = '/admin/inventory/warehouse/';
  var objectType = 'Warehouse';

  this.getWarehouseDetails = function(object) {
    return crudSrv.getDetails(apiPath, object);
  };

  this.saveWarehouse = function(object, formToken) {
    return crudSrv.save(object, objectType, formToken, apiPath);
  };
});
