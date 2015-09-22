var module = angular.module('rootApp', []);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});

angular.module('dropzone', []).directive('dropzone', function () {
  return function (scope, element, attrs) {
    var config, dropzone;

    config = scope[attrs.dropzone];

    // create a Dropzone for the element with the given options
    dropzone = new Dropzone(element[0], config.options);

    // bind the given event handlers
    angular.forEach(config.eventHandlers, function (handler, event) {
      dropzone.on(event, handler);
    });
  };
});

module.service('photoSrv', function($http) {
  this.getPhoto = function(apiPath) {
    return $http({
      url:apiPath,
      method:'GET'
    });
  };
});

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

module.controller('toastsCtrl', function($scope, toastsSrv) {

  $scope.alerts = toastsSrv.alerts;

  $scope.dismissAlert = toastsSrv.dismissAlert;

});

module.service('toastsSrv', function() {

  var self = this;

  this.alerts = {};

  this.newAlert = function(alert) { //Expects {domNodeId: <value>, message: <value>, type: <error, info, warning, success>}
    if (!self.alerts[alert.domNodeId]) {
      self.alerts[alert.domNodeId] = [];
    }
    if (alert.hasOwnProperty('domNodeId') && alert.hasOwnProperty('message')&& alert.hasOwnProperty('type')) {
      self.alerts[alert.domNodeId].push(alert);
    }
  };

  this.dismissAlert = function(alert) {
    self.alerts[alert.domNodeId].splice(self.alerts[alert.domNodeId].indexOf(alert), 1);
  };
});
