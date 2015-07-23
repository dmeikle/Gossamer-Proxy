module.service('widgetAdminSrv', function($http, $log){

  var apiPath = '/super/widgets';

  this.createNewWidget = function(widgetObject, formToken){
    var data = {'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.widget = widgetObject;

    return $http.post(apiPath + '/0', data).then(function(response){
      $log.info(response);
    });
  };

  this.getWidgetList = function(row, numRows){
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response){
        return {
          widgetList: response.data.Widgets,
          widgetCount: response.data.WidgetsCount[0].rowCount,
          pagination: response.data.pagination
        };
      });
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
