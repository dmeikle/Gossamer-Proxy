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
});
