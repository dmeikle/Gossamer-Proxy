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
    widgetsSrv.deleteWidget(widget).then(function(){
      getWidgetList(row);
    });
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
    pageTemplatesSrv.deletePageTemplate(pageTemplate);
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
        getWidgetsOnPageTemplate($scope.pageTemplate);
        getUnusedWidgets();
      });
  };

  $scope.removeWidgetFromPage = function(widget) {
    pageTemplatesSrv.removeWidgetFromPage($scope.pageTemplate, widget)
      .then(function(response) {
        getWidgetsOnPageTemplate($scope.pageTemplate);
        getUnusedWidgets();
      });
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
