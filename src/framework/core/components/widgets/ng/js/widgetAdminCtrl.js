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
