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

  this.toggleEditingWidget = function(widgetObject) {
    if (widgetObject.editing) {
      widgetObject.editing = false;
    } else {
      widgetObject.editing = true;
    }
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

  this.updateWidget = function(widgetObject, formToken) {
    var requestPath = apiPath + '/' + widgetObject.id;
    var data = {};
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
});

module.service('templateSrv', function(){
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.pageTemplateWidgets = '/render/widgets/pageTemplateWidgets';
  this.widgetList = '/render/widgets/widgetList';
});


// Pages service

module.service('pageTemplatesSrv', function($http, templateSrv){

  var apiPath = '/super/widgets/pages';

  this.createNewPageTemplate = function(pageTemplateObject) {
    var requestPath = apiPath + '/0';
    var data = {}; //{'Widget':{}, 'FORM_SECURITY_TOKEN': formToken};
    data.Template = pageTemplateObject;
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

  this.getPageTemplatesList = function() {
    return $http.get(apiPath + '/0/50')
      .then(function(response) {
        return {
          pageTemplatesList: response.data.WidgetPages
        };
    });
  };

  this.getPageTemplateWidgetList = function(pageTemplateObject) {
    return $http.get(apiPath + '/widgets/' + pageTemplateObject.id)
      .then(function(response){
        delete response.data['widgets/super_widgetpages_widgets_list'];
        delete response.data.modules;
        return {
          pageTemplateSectionList: response.data
        };
      });
  };

  this.updatePageTemplate = function(pageTemplateObject, formToken) {
    var requestPath = apiPath + '/' + widgetObject.id;
    var data = {};
    data.Template = pageTemplateObject;
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

  this.toggleEditingPageTemplate = function(pageTemplateObject) {
    if (pageTemplateObject.editing) {
      pageTemplateObject.editing = false;
    } else {
      pageTemplateObject.editing = true;
    }
  };
});
