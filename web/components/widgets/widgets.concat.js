var module = angular.module('widgetAdmin', ['ui.bootstrap']);

module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
  $scope.getWidgetList = function(row, numRows) {
    widgetAdminSrv.getWidgetList(row, numRows).then(function(response){
      $scope.numPages = response.widgetCount / $scope.widgetsPerPage;
      $scope.widgetList = response.widgetList;
      $scope.widgetCount = response.widgetCount;
    });
  };


  $scope.$watch('currentPage + numPerPage', function() {
    var begin = (($scope.currentPage - 1) * $scope.numPerPage);
    var end = begin + $scope.numPerPage;
  });

  $scope.addNewWidget = function(newWidgetOb) {
    widgetAdminSrv.createNewWidget(newWidgetOb);
    $scope.widgetList.unshift(newWidgetOb);
    $scope.newWidget = {};
    $scope.newWidgetForm.$setPristine();
  };

  $scope.selectPage = function(pageNum) {
    $scope.currentPage = pageNum;
  };


  // Stuff to run on controller load
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
  $scope.getWidgetList(0, $scope.widgetsPerPage);
});

module.directive('widgetAdminList', function($compile, templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    templateUrl: template.widgetAdminList
  };
});

module.service('widgetAdminSrv', function($http, $log){

  var apiPath = '/super/widgets';

  this.createNewWidget = function(widgetObject){
    var data = {'widget':{}};
    data.widget.name = widgetObject.name;
    data.widget.component = widgetObject.component;
    data.widget.description = widgetObject.description;
    data.widget.module = widgetObject.module;
    data.widget.htmlKey = widgetObject.htmlKey;
    // return $http.post(apiPath + '/0', data);
  };

  this.getWidgetList = function(row, numRows){
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response){
        return {
          widgetList: response.data.Widgets,
          widgetCount: response.data.WidgetsCount[0].rowCount,
          pagination: response.data.pagination
        };
      });
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
