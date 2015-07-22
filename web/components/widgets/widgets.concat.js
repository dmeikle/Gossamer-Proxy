var module = angular.module('widgetAdmin', []);

module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
  var widgetList = widgetAdminSrv.getWidgetList(0,10);

  widgetList.success(function(data, status, headers, config){

    $log.info(data);
    $scope.widgetList = data.Widgets;
    $scope.widgetCount = data.WidgetsCount;
    $scope.pagination = data.pagination;

  })
  .error(function(data, status, headers, config){

    $log.error('Getting the widget list failed! ' + status);

  });

  $scope.addNewWidget = function($scope) {

  };
});

module.directive('widgetAdminList', function($compile, templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    templateUrl: template.widgetAdminList,
    link: function(scope, element) {
      scope.addNewWidgetRow = function(){
        // element.getElementsByTagName('td')[0].before($compile('<widget-admin-list-row></widget-admin-list-row>')(scope));
        element.after($compile('<widget-admin-list-row></widget-admin-list-row>')(scope));
      };
    }
  };
});

module.directive('widgetAdminListRow', function(templateSrv){
  var template = templateSrv;
  return {
    restrict:'E',
    templateUrl: template.widgetAdminListRow,
    scope: {
      newWidget: '=ngModel'
    }
  };
});

module.service('widgetAdminSrv', function($http, $log){

  // var apiPath = ???

  this.createNewWidget = function(widgetObject){
    var widgetName = widgetObject.name;
    var widgetComponent = widgetObject.component;
    return $http.put(apiPath + '/new');
  };

  this.getWidgetList = function(startRow, bound){
    var apiPath = 'http://work.server.phoenix/admin/staff';
    return $http.get(apiPath + '/' + startRow + '/' + bound);
  };


  this.deleteWidget = function(widgetId) {
    return $http.delete(apiPath + widgetId);
  };

  this.updateWidget = function(widgetId, widgetObject) {
    return $http.patch(apiPath + '/' + widgetId + '/update');
  };
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.widgetAdminListRow = '/render/widgets/widgetAdminListRow';
});
