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
