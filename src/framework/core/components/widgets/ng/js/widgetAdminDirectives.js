module.directive('widgetAdminList', function(templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template.widgetAdminList
  };
});

module.directive('unusedWidgetList', function(templateSrv){
  var template = templateSrv.unusedWidgetList;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template
  };
});

module.directive('pageTemplateWidgets', function(templateSrv) {
  var template = templateSrv.pageTemplateWidgets;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template
  };
});
