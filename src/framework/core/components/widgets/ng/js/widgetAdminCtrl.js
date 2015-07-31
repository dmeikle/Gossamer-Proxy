module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
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
  $scope.getWidgetList(0, $scope.widgetsPerPage);
});



// Pages controller

module.controller('pageTemplatesCtrl', function($scope, $log, pageTemplatesSrv){

  function getPageTemplatesList() {
    pageTemplatesSrv.getPageTemplatesList().then(function(response){
      $scope.pageTemplatesList = response.pageTemplatesList;
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
            $scope.pageTemplateSectionList = response.pageTemplateSectionList;
          });
      }
    }
  });

  getPageTemplatesList();
});
