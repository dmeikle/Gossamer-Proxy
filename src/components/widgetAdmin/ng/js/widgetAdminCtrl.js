module.controller('viewWidgetsCtrl', function($scope, $log, widgetAdminSrv){
  var widgetList = widgetAdminSrv.getWidgetList(0,10);

  widgetList.success(function(data, status, headers, config){

    $log.info(data);
    $scope.widgetList = data.Widgets;
    $scope.widgetCount = data.WidgetsCount;
    $scope.pagination = data.pagination;

  })
  .error(function(data, status, headers, config){

    $log.error('Getting the widget list failed! ' + status);

  });

  $scope.addNewWidget = function($scope) {

  };
});
