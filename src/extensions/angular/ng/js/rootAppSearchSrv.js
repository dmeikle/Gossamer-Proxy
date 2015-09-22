module.service('searchSrv', function($http) {

  var self = this;

  this.advancedSearch = {};

  this.searchCall = function(object, apiPath) {
    config = {};
    for (var param in object) {
      if (object.hasOwnProperty(param)) {
        config[param] = object[param];
      }
    }

    return $http({
      url:apiPath,
      method:'GET',
      params:config
    });
  };

  this.search = function(object, apiPath) {
      return self.searchCall(object, apiPath + 'search').then(function(response) {
        self.searchResults = response.data.Staffs;
        self.searchResultsCount = response.data.StaffsCount[0].rowCount;
      });
  };

  this.getAdvancedSearchFilters = function(apiPath) {
    return $http.get(apiPath).then(function(response) {
      var elementList = document.implementation.createHTMLDocument('filters');
      elementList.body.innerHTML = response.data;
      self.advancedSearch.fields = [];
      for (var i = 0; i < elementList.body.children.length; i++) {
        self.advancedSearch.fields.push(elementList.body.children[i]);
      }
    });
  };
});
