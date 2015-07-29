module.directive('widgetAdminList', function(templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    templateUrl: template.widgetAdminList
  };
});
