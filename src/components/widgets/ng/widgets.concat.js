var module = angular.module('widgetAdmin', ['ui.bootstrap']);


module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});

module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
<<<<<<< HEAD
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
  widgetAdminSrv.getWidgetList(0, 10).then(function(response){
    $scope.numPages = response.widgetCount / $scope.widgetsPerPage;
    $scope.widgetList = response.widgetList;
    $scope.widgetCount = response.widgetCount;
  });

  $scope.$watch('currentPage + numPerPage', function() {
    var begin = (($scope.currentPage - 1) * $scope.numPerPage);
    var end = begin + $scope.numPerPage;
  });

  $scope.addNewWidget = function(newWidgetOb) {
    widgetAdminSrv.createNewWidget(newWidgetOb);
    $scope.widgetList.unshift(newWidgetOb);
    $scope.newWidget = {};
    $scope.newWidgetForm.$setPristine();
=======
  $scope.getWidgetList = function(row, numRows) {
    widgetAdminSrv.getWidgetList(row, numRows).then(function(response){
      $scope.numPages = response.widgetCount / $scope.widgetsPerPage;
      $scope.widgetList = response.widgetList;
      $scope.widgetCount = response.widgetCount;
    });
  };

  saveWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    widgetAdminSrv.createNewWidget(widgetObject, formToken).then(function(response) {
      $scope.widgetList.unshift(widgetObject);
      $scope.newWidget = {};
      $scope.newWidgetForm.$setPristine();
    });
>>>>>>> Something going on with the params the create api is receiving
  };
<<<<<<< HEAD
  $scope.selectPage = function(pageNo) {
    $scope.currentPage = pageNo;
=======

  $scope.addNewWidget = function(newWidgetObject) {
    saveWidget(newWidgetObject);
  };

  $scope.editWidget = function(widgetObject) {
    var row = angular.element( document.getElementById('#' + widgetObject.id));
    var tds = row.children('td');
    for (var i = 0; i < tds.length; i++) {
      tds[i].attr('contenteditable', 'true');
    }
  };

  $scope.confirmEditedWidget = function(widgetObject) {
    saveWidget(newWidgetObject);
  };

  $scope.selectPage = function(pageNum) {
    $scope.currentPage = pageNum;
>>>>>>> removed reference to sanitize, widget post works
  };

  $scope.$watch('currentPage + numPerPage', function() {
    var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
    var numRows = $scope.widgetsPerPage;

    $scope.getWidgetList(row, numRows);
  });

  // Stuff to run on controller load
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
  $scope.getWidgetList(0, $scope.widgetsPerPage);
});

module.directive('widgetAdminList', function($compile, templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    priority: 1000,
    terminal: true,
    templateUrl: template.widgetAdminList,
    link: function(scope, element){
      $compile(element[0].getElementsByTagName('widget-admin-list-row')[0])(scope);
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

  var apiPath = '/super/widgets';

<<<<<<< HEAD
  this.createNewWidget = function(widgetObject){
    var data = {'widget':{}};
    data.widget.name = widgetObject.name;
    data.widget.component = widgetObject.component;
    data.widget.description = widgetObject.description;
    data.widget.module = widgetObject.module;
    data.widget.htmlKey = widgetObject.htmlKey;
    // return $http.post(apiPath + '/0', data);
=======
  this.createNewWidget = function(widgetObject, formToken){
    var requestPath = apiPath + '/0';
    var data = {}; //{'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
    $log.info(data);
    return $http({
      method: 'POST',
      url:requestPath,
      data: data,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function(response){
      $log.info(response);
    });
>>>>>>> Something going on with the params the create api is receiving
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
    return $http.delete(apiPath + '/' + widgetId);
  };

  this.updateWidget = function(widgetObject) {
    $log.info(widgetObject);
    return $http.patch(apiPath + '/' + widgetObject.id).then(function(response){
      $log.info(response);
    });
  };
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.widgetAdminListRow = '/render/widgets/widgetAdminListRow';
});
