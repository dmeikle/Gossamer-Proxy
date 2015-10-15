module.service('inventoryListSrv', function($http, crudSrv, searchSrv) {
  var apiPath = '/admin/inventory/';

  this.getMaterialsList = function(row, numRows) {
    return crudSrv.getList(apiPath + 'materials/', row, numRows);
  };

  this.getEquipmentList = function(row, numRows) {
    return crudSrv.getList(apiPath + 'equipment/', row, numRows);
  };

  this.getAdvancedSearchFilters = function() {
    return searchSrv.getAdvancedSearchFilters('/render/inventory/inventoryAdvancedSearchFilters').then(function() {
      self.advancedSearch.fields = searchSrv.advancedSearch.fields;
    });
  };

  this.getEquipmentDetails = function(object) {
    return crudSrv.getDetails(apiPath + 'items/', object.id);
  };

  this.getMaterialDetails = function(object) {
    return crudSrv.getDetails(apiPath + 'items/', object.id);
  };

  this.transfer = function(array, typeString) {
    var config = {};
    var inventoryIds = [];
    for (var i = 0; i < array.length; i++) {
      inventoryIds[i] = array[i].id;
    }
    config.inventoryIds = inventoryIds.toString();
    return $http({
      method:'GET',
      url: apiPath + typeString + '/transfer',
      params: config
    });
  };

});
