module.service('inventoryTransferSrv', function($http, searchSrv) {
  var self = this;

  this.autocomplete = function(value, type, apiPath) {
    var config = {};
    config[type] = value;
    return searchSrv.fetchAutocomplete(config, apiPath).then(function() {
      self.autocompleteResult = searchSrv.autocomplete;
    });
  };

  this.getLocation = function(object) {
    return $http.get('/admin/claims/locations/' + object.WarehouseLocations_id);
  };

  this.transfer = function(object) {

    return $http({
      method:'POST',
      url: '/admin/inventory/equipment/transfer',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      data: object
    });
  };
});
