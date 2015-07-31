module.directive('widgetAdminList', function(templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    transclude: true,
    templateUrl: template.widgetAdminList
  };
});

module.directive('pageTemplate', function(templateSrv) {
  var template = templateSrv.pageTemplate;
  return {
    restrict: 'E',
    templateUrl: template
  };
});
