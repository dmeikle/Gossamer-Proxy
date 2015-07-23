module.service('widgetAdminSrv', function($http, $log){

  var apiPath = '/super/widgets';

  this.createNewWidget = function(widgetObject, formToken){
    var requestPath = apiPath + '/0';
    var data = {}; //{'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
    $log.info(data);
    return $http({
      method: 'POST',
      url:requestPath,
      data: data,
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
    }).then(function(response){
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
    return $http.delete(apiPath + '/' + widgetId);
  };

  this.updateWidget = function(widgetObject) {
    $log.info(widgetObject);
    return $http.patch(apiPath + '/' + widgetObject.id).then(function(response){
      $log.info(response);
    });
  };
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.widgetAdminListRow = '/render/widgets/widgetAdminListRow';
});
