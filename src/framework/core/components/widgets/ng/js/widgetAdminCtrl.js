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
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    widgetAdminSrv.createNewWidget(newWidgetOb, formToken);
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
