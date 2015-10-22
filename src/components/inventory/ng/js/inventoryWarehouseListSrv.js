module.service('warehouseListSrv', function(crudSrv) {
  var apiPath = '/admin/inventory/warehouse/';

  this.getWarehouseList = function(row, numRows) {
    return crudSrv.getList(apiPath, row, numRows);
  };

  this.deleteWarehouse = function(object, formToken) {
    return crudSrv.delete(apiPath, object, formToken);
  };
});
