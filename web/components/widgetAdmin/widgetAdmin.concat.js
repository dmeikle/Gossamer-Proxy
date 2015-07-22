var module = angular.module('widgetAdmin', []);

module.controller('viewWidgetsCtrl', function(widgetAdminSrv){
  var widgetList = widgetAdminSrv.getWidgetList();

  widgetList.success(function(data, status, headers, config){
    $log(data);
  });
});

module.service('widgetAdminSrv', function($http, $log){
  this.getWidgetList = function(startRow, bound){
    // apiPath = ???
    var apiPath = 'admin/staff/';
    $http.get(apiPath + '/' + startRow + '/' + bound);
  };
});
