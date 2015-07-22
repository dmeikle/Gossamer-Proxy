module.directive('widgetAdminList', function($compile, templateSrv){
  var template = templateSrv;
  return {
    restrict: 'E',
    templateUrl: template.widgetAdminList,
    link: function(scope, element) {
      scope.addNewWidgetRow = function(){
        element.getElementsByTagName('td')[0].before($compile('<widget-admin-list-row></widget-admin-list-row>')(scope));
        // element.after($compile('<widget-admin-list-row></widget-admin-list-row>')(scope));
      };
    }
  };
});

module.directive('widgetAdminListRow', function(templateSrv){
  var template = templateSrv;
  return {
    restrict:'E',
    templateUrl: template.widgetAdminListRow,
    scope: {
      newWidget: '=ngModel'
    }
  };
});
