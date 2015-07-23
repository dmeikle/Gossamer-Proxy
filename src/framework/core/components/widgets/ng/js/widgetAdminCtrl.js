module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
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
  };
  $scope.selectPage = function(pageNo) {
    $scope.currentPage = pageNo;
  };
});
