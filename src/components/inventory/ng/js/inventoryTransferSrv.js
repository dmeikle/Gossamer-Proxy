module.service('transferSrv', function(searchSrv) {
  var self = this;

  this.autocomplete = function(value, type, apiPath) {
    var config = {};
    config[type] = value;
    return searchSrv.fetchAutocomplete(config, apiPath).then(function() {
      self.autocompleteResult = searchSrv.autocomplete;
    });
  };
});
