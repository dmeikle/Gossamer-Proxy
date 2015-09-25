module.service('tablesSrv', function(searchSrv) {
  var self = this;

  self.sortResult = {};

  this.sortByColumn = function(columns, direction, apiPath) {
    var config = {};
    var sortString = columns.toString();

    config['directive::ORDER_BY'] = sortString.toLowerCase();
    config['directive::DIRECTION'] = direction;
    searchSrv.sortByColumn(config, apiPath + '/0/20').then(function() {
      self.sortResult = searchSrv.sortResult;
    });
  };

  this.clearSort = function(grouping, apiPath) {
    var config = {};
    if (grouping) {
      config['directive::ORDER_BY'] = grouping;
    }
    searchSrv.searchCall(config, apiPath + '/0/20').then(function(response) {
      self.sortResult = response.data;
    });
  };

  this.groupBy = function(apiPath, columnName, row, numRows) {
    var config = {};
    config['directive::ORDER_BY'] = columnName;
    searchSrv.searchCall(config, apiPath + '/' + row + '/' + numRows).then(function(response) {
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
