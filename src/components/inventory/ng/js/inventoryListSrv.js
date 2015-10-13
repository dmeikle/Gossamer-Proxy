module.service('inventoryListSrv', function(crudSrv, searchSrv) {
  var apiPath = '/admin/inventory/';

  this.getMaterialsList = function(row, numRows) {
    return crudSrv.getList(apiPath + 'materials/', row, numRows);
  };

  this.getEquipmentList = function(row, numRows) {
    return crudSrv.getList(apiPath + 'equipment/', row, numRows);
  };
});
