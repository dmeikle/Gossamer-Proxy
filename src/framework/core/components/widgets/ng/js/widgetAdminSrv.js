module.service('widgetAdminSrv', function($http, $log){

  // var apiPath = ???

  this.createNewWidget = function(widgetObject){
    var widgetName = widgetObject.name;
    var widgetComponent = widgetObject.component;
    return $http.put(apiPath + '/new');
  };

  this.getWidgetList = function(startRow, bound){
    var apiPath = '/super/widgets';
    return $http.get(apiPath + '/' + startRow + '/' + bound);
  };


  this.deleteWidget = function(widgetId) {
    return $http.delete(apiPath + widgetId);
  };

  this.updateWidget = function(widgetId, widgetObject) {
    return $http.patch(apiPath + '/' + widgetId + '/update');
  };
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.widgetAdminListRow = '/render/widgets/widgetAdminListRow';
});
