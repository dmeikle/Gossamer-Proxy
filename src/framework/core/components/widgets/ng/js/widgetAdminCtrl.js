module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
  $scope.getWidgetList = function(row) {
    widgetAdminSrv.getWidgetList(row, $scope.widgetsPerPage).then(function(response){
      $scope.numPages = widgetAdminSrv.widgetCount / $scope.widgetsPerPage;
      $scope.widgetList = widgetAdminSrv.widgetList;
      $scope.widgetCount = widgetAdminSrv.widgetCount;
    });
  };

  $scope.getInactiveWidgetsList = function(row) {
    widgetAdminSrv.getInactiveWidgetList()
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

module.controller('pageTemplatesCtrl', function($scope, $log, pageTemplatesSrv, widgetAdminSrv){

  function getPageTemplatesList() {
    pageTemplatesSrv.getPageTemplatesList().then(function(response){
      $scope.pageTemplatesList = pageTemplatesSrv.pageTemplatesList;
    });
  }

  function filterWidgetsList() {
    if (pageTemplatesSrv.pageTemplateSectionList && widgetAdminSrv.inactiveWidgetsList) {
      var widgetsToDelete = {};
      for (var section in pageTemplatesSrv.pageTemplateSectionList) {
        if (pageTemplatesSrv.pageTemplateSectionList.hasOwnProperty(section)) {
          var key = pageTemplatesSrv.pageTemplateSectionList[section];
          for (var widget in key) {
            for (var i = 0; i < widgetAdminSrv.widgetList.length; i++) {
              if (widgetAdminSrv.widgetList[i] && widgetAdminSrv.inactiveWidgetsList[i].id === key[widget].id) {
                delete widgetAdminSrv.widgetList[i];
              }
            }

          }
        }
      }
    }
    $scope.inactiveWidgetsList = widgetAdminSrv.widgetsList;
  }


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
            filterWidgetsList();
          });
      }
    }
  });

  $scope.$watch('currentPage', function() {
    filterWidgetsList();
  });

  getPageTemplatesList();
});
