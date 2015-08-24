var module = angular.module('widgetAdmin', ['ui.bootstrap']);


module.config(function ($httpProvider) {
    $httpProvider.defaults.transformRequest = function(data){
        if (data === undefined) {
            return data;
        }
        return $.param(data);
    };
});

module.controller('widgetsCtrl', function($scope, $modal,  widgetsSrv, templateSrv) {
  $scope.getWidgetList = function(row) {
    widgetsSrv.getWidgetList(row, $scope.widgetsPerPage).then(function(response) {
      $scope.widgetList = widgetsSrv.widgetList;
      $scope.widgetCount = widgetsSrv.widgetCount;
    });
  };

  $scope.saveWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    widgetsSrv.createNewWidget(widgetObject, formToken).then(function(response) {
      $scope.getWidgetList(row, numRows);
    });

  };
  var openWidgetModal = function(widget) {
    var template = templateSrv.widgetModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'widgetModalInstanceController',
      size: 'lg',
      resolve: {
        widget: function() {
          return widget;
        }
      }
    });

    modalInstance.result.then(function(widget) {
      var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
      widgetsSrv.saveWidget(widget, formToken)
        .then(function() {
          $scope.getWidgetList(row, numRows);
        });
    },
    function(){});
  };

  $scope.editWidget = function(widget) {
    openWidgetModal(widget);
  };

  $scope.addNewWidget = function() {
    openWidgetModal();
  };

  $scope.deleteWidget = function(widget) {
    var confirmed = confirm('Are you sure you want to delete ' + widget.name + '?');
    if (confirmed) {
      widgetsSrv.deleteWidget(widget).then(function(){
        $scope.getWidgetList(row);
      });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
    numRows = $scope.widgetsPerPage;

    $scope.getWidgetList(row, numRows);
  });

  // Stuff to run on controller load
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
  var numRows = $scope.widgetsPerPage;
});

module.controller('widgetModalInstanceController', function($scope, $modalInstance, widget) {
  $scope.widget = widget;

  $scope.confirm = function() {
    $modalInstance.close($scope.widget);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };

});



// Pages controller

module.controller('pageTemplatesCtrl', function($scope, $modal, pageTemplatesSrv, templateSrv) {

  function getPageTemplatesList(row, numRows) {
    pageTemplatesSrv.getPageTemplatesList(row, numRows).then(function(response) {
      $scope.pageTemplatesList = pageTemplatesSrv.pageTemplatesList;
      $scope.totalItems = pageTemplatesSrv.pageTemplatesCount.rowCount;
    });
  }

  var openPageTemplateModal = function(pageTemplate) {
    var template = templateSrv.pageTemplateModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'pageTemplateModalInstanceController',
      size: 'lg',
      resolve: {
        pageTemplate: function() {
          return pageTemplate;
        }
      }
    });

    modalInstance.result.then(function(pageTemplate) {
      var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
      pageTemplatesSrv.savePageTemplate(pageTemplate, formToken)
        .then(function() {
          getPageTemplatesList(row, numRows);
        });
    },
    function(){});
  };

  $scope.addNewPageTemplate = function() {
    openPageTemplateModal();
  };

  $scope.editPageTemplate = function(pageTemplate) {
    openPageTemplateModal(pageTemplate);
  };

  $scope.deletePageTemplate = function(pageTemplate) {
    var confirmed  = confirm('Are you sure you want to delete ' + pageTemplate.name + '?' );
    if (confirmed) {
      pageTemplatesSrv.deletePageTemplate(pageTemplate)
        .then(function() {
          getPageTemplatesList(row, numRows);
        });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    row = (($scope.currentPage - 1) * $scope.itemsPerPage);
    numRows = $scope.itemsPerPage;

    getPageTemplatesList(row, numRows);
  });

  $scope.itemsPerPage = 10;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;
});

module.controller('pageTemplateModalInstanceController', function($scope, $modalInstance, pageTemplate, pageTemplatesSrv) {
  $scope.pageTemplate = pageTemplate;

  var getUnusedWidgets = function(pageTemplate) {
    pageTemplatesSrv.getUnusedWidgets(pageTemplate)
      .then(function(response) {
        $scope.unusedWidgetList = pageTemplatesSrv.unusedWidgetList;
      });
  };

  var getWidgetsOnPageTemplate = function(pageTemplate) {
    if (pageTemplate) {
      pageTemplatesSrv.getWidgetsOnPageTemplate(pageTemplate)
        .then(function() {
          $scope.widgetsOnPage = pageTemplatesSrv.widgetsOnPage;
        });
    }
  };

  $scope.getWidgetByName = function(widgetName) {
    for (var widget in $scope.unusedWidgetList) {
      if ($scope.unusedWidgetList.hasOwnProperty(widget)) {
        if ($scope.unusedWidgetList[widget].name === widgetName) {
          $scope.widgetObjectToAdd = $scope.unusedWidgetList[widget];
        }
      }
    }
  };

  $scope.addWidgetToPage = function(pageTemplate, object, sectionName, ymlKey) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    pageTemplatesSrv.addWidgetToPage(pageTemplate, object, sectionName, ymlKey, formToken)
      .then(function(response){
        $scope.widgetToAdd = undefined;
        document.getElementById('widgetToAdd').value = '';
        getWidgetsOnPageTemplate($scope.pageTemplate);
        getUnusedWidgets();
      });
  };

  $scope.removeWidgetFromPage = function(widget) {
    var confirmed = confirm('Do you want to remove ' + widget.name + '?');
    if (confirmed) {
      pageTemplatesSrv.removeWidgetFromPage($scope.pageTemplate, widget)
        .then(function(response) {
          getWidgetsOnPageTemplate($scope.pageTemplate);
          getUnusedWidgets();
        });
    }
  };

  $scope.saveAndContinue = function(pageTemplate) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    pageTemplatesSrv.savePageTemplate(pageTemplate, formToken).then(function(response) {
      $scope.pageTemplate = response.data.WidgetPage[0];
    });
  };

  $scope.confirm = function() {
    $modalInstance.close($scope.pageTemplate);
  };

  $scope.cancel = function() {
    $modalInstance.dismiss('cancel');
  };

  var row = (($scope.currentPage - 1) * $scope.itemsPerPage);
  var numRows = $scope.itemsPerPage;

  getWidgetsOnPageTemplate(pageTemplate);
  getUnusedWidgets(pageTemplate);
});

module.service('widgetsSrv', function($http) {


  var apiPath = '/super/widgets';

  var self = this;

  this.saveWidget = function(widgetObject, formToken) {
    var requestPath;
    if (!widgetObject.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + widgetObject.id;
    }
    var data = {};

    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',

      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }

    });
  };

  this.toggleEditingWidget = function(widgetObject) {
    if (widgetObject.editing) {
      widgetObject.editing = false;
    } else {
      widgetObject.editing = true;
    }
  };


  this.getWidgetList = function(row, numRows) {
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {

        self.widgetList = response.data.Widgets;
        self.widgetCount = response.data.WidgetsCount[0].rowCount;
        return {
          pagination: response.data.pagination
        };
      });
  };


  this.deleteWidget = function(widget) {
    var requestPath = apiPath + '/remove/' + widget.id;
    return $http.delete(requestPath);
  };
});

module.service('templateSrv', function() {
  this.pageTemplateModal = '/render/widgets/pageTemplateModal';
  this.widgetModal = '/render/widgets/widgetModal';

});


// Pages service


module.service('pageTemplatesSrv', function($http) {

  var apiPath = '/super/widgets/pages';

  var self = this;

  this.savePageTemplate = function(object, formToken) {
    var requestPath;
    if (!object.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + object.id;
    }
    var data = {};
    object.isSystemPage = 1;
    data.WidgetPage = object;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      return response;
    });
  };

  this.getPageTemplatesList = function(row, numRows) {
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {
        self.pageTemplatesList = response.data.WidgetPages;
        self.pageTemplatesCount = response.data.WidgetPagesCount[0];
      });
  };

  this.getWidgetsOnPageTemplate = function(pageTemplate) {
    return $http.get(apiPath + '/widgets/' + pageTemplate.id)
      .then(function(response){
        var widgets = [];
        for (var section in response.data) {
          if (response.data.hasOwnProperty(section)) {
            if (section !== "widgets/super_widgetpages_widgets_list" &&
                section !== "modules") {
              for (var widget in response.data[section]) {
                if (response.data[section].hasOwnProperty(widget)) {
                  response.data[section][widget].sectionName = section;
                  widgets.push(response.data[section][widget]);
                }
              }
            }
          }
        }
        self.widgetsOnPage = widgets;
      });
  };

  this.getUnusedWidgets = function(pageTemplate) {
    if (!pageTemplate) {
      return $http.get('/super/widgets/unassigned/all/0')
        .then(function(response){
          self.unusedWidgetList = response.data.Widgets;
        });
    }
    return $http.get('/super/widgets/unassigned/all/' + pageTemplate.id )
      .then(function(response) {
        self.unusedWidgetList = response.data.Widgets;
      });
  };

  this.addWidgetToPage = function(pageTemplate, object, sectionName, ymlKey, formToken) {
    var requestPath = apiPath + '/widgets/' + pageTemplate.id;
    var data = {};
    data.WidgetPageWidget = {};
    data.WidgetPageWidget.Widgets_id = object.Widgets_id;
    data.WidgetPageWidget.ymlKey = ymlKey;
    data.WidgetPageWidget.sectionName = sectionName;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  };

  this.removeWidgetFromPage = function(pageTemplate, widget) {
    var requestPath = apiPath + '/widgets/remove/' + pageTemplate.ymlKey + '/' + widget.id;
    return $http.delete(requestPath);
  };

  this.deletePageTemplate = function(pageTemplate) {
    var requestPath = apiPath + '/remove/' + pageTemplate.id;
    return $http.delete(requestPath);
  };

});
