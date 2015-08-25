module.controller('costCardItemTypeCtrl', function($scope, $modal,  costCardItemTypeSrv, templateSrv) {
    
  // Stuff to run on controller load
  $scope.rowsPerPage = 20;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.rowsPerPage);
  var numRows = $scope.rowsPerPage;
  
  
  $scope.getList = function(row) {
    costCardItemTypeSrv.getList(row, $scope.itemsPerPage).then(function(response) {
      $scope.costcardItemTypesList = costCardItemTypeSrv.costCardItemTypesList;
      $scope.costcardItemTypesCount = costCardItemTypeSrv.costcardItemTypesCount;
  
    });
  };

  $scope.save = function(object) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    costCardItemTypeSrv.create(object, formToken).then(function(response) {
      $scope.getList(row, numRows);
    });
  };

  var openModal = function(object) {
    var template = templateSrv.costCardItemTypeModal;
    var modalInstance = $modal.open({
      templateUrl: template,
      controller: 'costCardItemTypeModalInstanceController',
      size: 'lg',
      resolve: {
        costcardItemType: function() {
          return object;
        }
      }
    });

    modalInstance.result.then(function(object) {
      var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
      costCardItemTypeSrv.save(object, formToken)
        .then(function() {
          $scope.getList(row, numRows);
        });
    },
    function(){});
  };

  $scope.edit = function(object) {
    openModal(object);
  };

  $scope.addNew = function() {
    openModal();
  };

  $scope.delete = function(object) {
    var confirmed = confirm('Are you sure you want to delete ' + object.name + '?');
    if (confirmed) {
      costCardItemTypeSrv.delete(object).then(function(){
        $scope.getList(row);
      });
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    row = (($scope.currentPage - 1) * $scope.rowsPerPage);
    numRows = $scope.rowsPerPage;

    $scope.getList(row, numRows);
  });
});

module.controller('costCardItemTypeModalInstanceController', function($scope, $modalInstance, object) {
  $scope.costCardItemType = object;

  $scope.confirm = function() {
    $modalInstance.close($scope.costCardItemType);
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
