module.directive('widgetAdminList', function(templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template.widgetAdminList
  };
});

module.directive('widgetList', function(templateSrv){
  var template = templateSrv.widgetList;
  return {
    restrict: 'E',
    templateUrl: template
  };
});

module.directive('pageTemplateWidgets', function(templateSrv) {
  var template = templateSrv.pageTemplateWidgets;
  return {
    restrict: 'E',
    templateUrl: template
  };
});
