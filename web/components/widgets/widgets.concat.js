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
  $scope.getWidgetList = function(row) {
    widgetAdminSrv.getWidgetList(row, $scope.widgetsPerPage).then(function(response){
      $scope.numPages = widgetAdminSrv.widgetCount / $scope.widgetsPerPage;
      $scope.widgetList = widgetAdminSrv.widgetList;
      $scope.widgetCount = widgetAdminSrv.widgetCount;
    });
  };

  saveWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    widgetAdminSrv.createNewWidget(widgetObject, formToken).then(function(response) {
      $scope.getWidgetList((($scope.currentPage - 1) * $scope.widgetsPerPage));
      $scope.newWidget = {};
      $scope.newWidgetForm.$setPristine();
    });
  };

  updateWidget = function(widgetObject, formToken) {
    widgetAdminSrv.updateWidget(widgetObject, formToken).then(function(response) {
      $log.info(response);
    });
  };

  $scope.addNewWidget = function(newWidgetObject) {
    saveWidget(newWidgetObject);
  };

  $scope.toggleEditingWidget = function(widgetObject) {
    widgetAdminSrv.toggleEditingWidget(widgetObject);
  };

  $scope.confirmEditedWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    updateWidget(widgetObject, formToken);
    widgetAdminSrv.toggleEditingWidget(widgetObject);
  };

  $scope.selectPage = function(pageNum) {
    $scope.currentPage = pageNum;
  };

  $scope.$watch('currentPage + numPerPage', function() {
    var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
    var numRows = $scope.widgetsPerPage;

    $scope.getWidgetList(row, numRows);
  });

  // Stuff to run on controller load
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
  // $scope.getWidgetList(0, $scope.widgetsPerPage);
});



// Pages controller

module.controller('pageTemplatesCtrl', function($scope, $log, pageTemplatesSrv){

  function getPageTemplatesList() {
    pageTemplatesSrv.getPageTemplatesList().then(function(response){
      $scope.pageTemplatesList = pageTemplatesSrv.pageTemplatesList;
    });
  }

  function getUnusedWidgets(row) {
    pageTemplatesSrv.getUnusedWidgets(row, $scope.widgetsPerPage)
      .then(function(response){
        $scope.unusedWidgetList = pageTemplatesSrv.unusedWidgetList;
        $scope.widgetCount = pageTemplatesSrv.widgetCount;
        $scope.numPages = pageTemplatesSrv.widgetCount / $scope.widgetsPerPage;
      });
  }

  $scope.updatePageTemplate = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    pageTemplatesSrv.updatePageTemplate(object, formToken).then(function(response) {
      $log.info(response);
    });
  };


  // TODO This needs to be cleaned up
  $scope.$watch('selectedPageTemplate', function(){
    if (!$scope.selectedPageTemplate) {
      return;
    } else {
      var pageTemplateObject = $.grep($scope.pageTemplatesList, function(e){
        if(e.name === $scope.selectedPageTemplate) {
          return e;
        }
      });
      if (pageTemplateObject.length === 1) {
        pageTemplatesSrv.getPageTemplateWidgetList(pageTemplateObject[0])
          .then(function(response){
            $scope.pageTemplateSectionList = pageTemplatesSrv.pageTemplateSectionList;

            getUnusedWidgets((($scope.currentPage - 1) * $scope.widgetsPerPage));
          });
      }
    }
  });

  $scope.$watch('currentPage + numPerPage', function() {
    var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
    var numRows = $scope.widgetsPerPage;

    getUnusedWidgets(row, numRows);
  });

  getPageTemplatesList();
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
});

module.directive('widgetAdminList', function(templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template.widgetAdminList
  };
});

module.directive('unusedWidgetList', function(templateSrv){
  var template = templateSrv.unusedWidgetList;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template
  };
});

module.directive('pageTemplateWidgets', function(templateSrv) {
  var template = templateSrv.pageTemplateWidgets;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template
  };
});

module.service('widgetAdminSrv', function($http, $log){

  var apiPath = '/super/widgets';

  var self = this;

  this.createNewWidget = function(widgetObject, formToken){
    var requestPath = apiPath + '/0';
    var data = {}; //{'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url:requestPath,
      data: data,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function(response){
      $log.info(response);
    });
  };

  this.toggleEditingWidget = function(widgetObject) {
    if (widgetObject.editing) {
      widgetObject.editing = false;
    } else {
      widgetObject.editing = true;
    }
  };

  this.getWidgetList = function(row, numRows){
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response){
        self.widgetList = response.data.Widgets;
        self.widgetCount = response.data.WidgetsCount[0].rowCount;
        return {
          pagination: response.data.pagination
        };
      });
  };

  this.updateWidget = function(widgetObject, formToken) {
    var requestPath = apiPath + '/' + widgetObject.id;
    var data = {};
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
  };
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.pageTemplateWidgets = '/render/widgets/pageTemplateWidgets';
  this.unusedWidgetList = '/render/widgets/unusedWidgetList';
});


// Pages service

module.service('pageTemplatesSrv', function($http, $log, templateSrv){

  var apiPath = '/super/widgets/pages';

  var self = this;

  this.createNewPageTemplate = function(pageTemplateObject, formToken) {
    var requestPath = apiPath + '/0';
    var data = {}; //{'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.Template = pageTemplateObject;
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
  };

  this.getPageTemplatesList = function() {
    return $http.get(apiPath + '/0/50')
      .then(function(response) {
        self.pageTemplatesList = response.data.WidgetPages;
    });
  };

  this.getPageTemplateWidgetList = function(pageTemplateObject) {
    return $http.get(apiPath + '/widgets/' + pageTemplateObject.id)
      .then(function(response){
        delete response.data['widgets/super_widgetpages_widgets_list'];
        delete response.data.modules;
        self.pageTemplateSectionList = response.data;
      });
  };

  this.getUnusedWidgets = function(row, numRows){
    var usedWidgets = [];
    for (var section in self.pageTemplateSectionList) {
      if (self.pageTemplateSectionList.hasOwnProperty(section)) {
        for (var key in self.pageTemplateSectionList[section]) {
          if (self.pageTemplateSectionList[section].hasOwnProperty(key)) {
            usedWidgets.push(self.pageTemplateSectionList[section][key].id);
          }
        }
      }
    }
    if (usedWidgets.length > 0) {
      return $http.get('/super/widgets/unassigned/' + usedWidgets.join() + '/' + row + '/' + numRows)
        .then(function(response) {
          self.unusedWidgetList = response.data.Widgets;
          self.widgetCount = response.data.WidgetsCount[0].rowCount;
        });
    }
    return $http.get('/super/widgets/' + row + '/' + numRows)
      .then(function(response){
        self.unusedWidgetList = response.data.Widgets;
        self.widgetCount = response.data.WidgetsCount[0].rowCount;
        return {
          pagination: response.data.pagination
        };
      });
  };

  this.updatePageTemplate = function(object, formToken) {
    var requestPath = apiPath + '/' + object.id;
    var data = {};
    data.Template = object;
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
  };

  this.toggleEditingPageTemplate = function(pageTemplateObject) {
    if (pageTemplateObject.editing) {
      pageTemplateObject.editing = false;
    } else {
      pageTemplateObject.editing = true;
    }
  };
});
