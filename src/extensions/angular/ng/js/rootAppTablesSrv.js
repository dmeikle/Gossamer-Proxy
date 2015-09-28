module.service('tablesSrv', function(searchSrv) {
  var self = this;

  self.sortResult = {};

  this.sortByColumn = function(column, direction, apiPath) {
    var config = {};
    config['directive::ORDER_BY'] = column.toLowerCase();
    config['directive::DIRECTION'] = direction;
    searchSrv.sortByColumn(config, apiPath + '/0/20').then(function() {
      self.sortResult = searchSrv.sortResult;
    });
  };

  this.clearSort = function(apiPath) {
    searchSrv.searchCall(undefined, apiPath + '/0/20').then(function(response) {
      self.sortResult = response.data;
    });
  };

  this.groupBy = function(apiPath, columnName) {
    var config = {};
    config['directive::GROUP_BY'] = columnName;
    searchSrv.searchCall(config, apiPath + '/0/20').then(function(response) {
      self.grouped = true;
      self.groupResult = response.data;
    });
  };

  this.clearGrouping = function(apiPath) {
    self.grouped = false;
  };

  // Watch tablesSrv.grouped in your controller, detect change, then grab .groupResult
  // and make that the contents of your page
});
