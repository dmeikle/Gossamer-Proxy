var module = angular.module('phoenixRestorations', []);

module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
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
        self.searchResults = response.data;
        self.searchResultsCount = response.data;
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

  this.sortByColumn = function(config, apiPath) {
    return $http({
      url:apiPath,
      method: 'GET',
      params: config
    }).then(function(response) {
      self.sortResult = response.data;
    });
  };
});

module.directive('columnSortable', function($compile, $location) {
  return {
    restricted:'A',
    scope:false,
    link: function(scope, element, attrs) {
      var a = document.createElement('a');
      a.setAttribute('ng-click', 'sortByColumn($event)');
      a.innerText = element[0].innerText;
      element[0].innerHTML = '';

      var clear = document.createElement('a');
      clear.setAttribute('ng-click', 'clearSort()');
      clear.setAttribute('class', 'clear-sort');
      element[0].appendChild(a);
      element[0].appendChild(clear);
      $compile(element.contents())(scope);
    },
    controller: function($scope, tablesSrv) {
      $scope.sorting = {};

      var a = document.createElement('a');
      a.href = $location.absUrl();
      var apiPath = a.pathname;
      $scope.sortByColumn = function(event) {
        if (!$scope.sorting[event.target.innerText] || $scope.sorting[event.target.innerText] === 'desc') {
          $scope.sorting[event.target.innerText] = 'asc';
        } else if ($scope.sorting[event.target.innerText] === 'asc') {
          $scope.sorting[event.target.innerText] = 'desc';
        }
        tablesSrv.sortByColumn(event.target.innerText, $scope.sorting[event.target.innerText], apiPath);
      };

      $scope.clearSort = function() {
        tablesSrv.clearSort(apiPath);
      };
    }
  };
});

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
    searchSrv.searchCall(undefined, apiPath + '/0/20').then(function() {
      self.sortResult = searchSrv.searchResults;
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
