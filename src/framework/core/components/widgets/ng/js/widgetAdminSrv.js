module.service('widgetAdminSrv', function($http, $log){

  var apiPath = '/super/widgets';

  var self = this;

  this.createNewWidget = function(widgetObject, formToken){
    var requestPath = apiPath + '/0';
    var data = {};
    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
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
        self.widgetList = response.data.Widgets;
        self.widgetCount = response.data.WidgetsCount[0].rowCount;
        return {
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
  this.unusedWidgetList = '/render/widgets/unusedWidgetList';
});


// Pages service

module.service('pageTemplatesSrv', function($http, $log){

  var apiPath = '/super/widgets/pages';

  var self = this;

  this.createNewPageTemplate = function(pageTemplateObject, formToken) {
    var requestPath = apiPath + '/0';
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

  this.getPageTemplatesList = function() {
    return $http.get(apiPath + '/0/50')
      .then(function(response) {
        self.pageTemplatesList = response.data.WidgetPages;
    });
  };

  this.getPageTemplateWidgetList = function(pageTemplateObject) {
    return $http.get(apiPath + '/widgets/' + pageTemplateObject.id)
      .then(function(response){
        delete response.data['widgets/super_widgetpages_widgets_list'];
        delete response.data.modules;
        self.pageTemplateSectionList = response.data;
      });
  };

  this.getUnusedWidgets = function(row, numRows){
    var usedWidgets = [];
    for (var section in self.pageTemplateSectionList) {
      if (self.pageTemplateSectionList.hasOwnProperty(section)) {
        for (var key in self.pageTemplateSectionList[section]) {
          if (self.pageTemplateSectionList[section].hasOwnProperty(key)) {
            usedWidgets.push(self.pageTemplateSectionList[section][key].id);
          }
        }
      }
    }
    if (usedWidgets.length > 0) {
      return $http.get('/super/widgets/unassigned/' + usedWidgets.join() + '/' + row + '/' + numRows)
        .then(function(response) {
          self.unusedWidgetList = response.data.Widgets;
          self.widgetCount = response.data.WidgetsCount[0].rowCount;
        });
    }
    return $http.get('/super/widgets/' + row + '/' + numRows)
      .then(function(response){
        self.unusedWidgetList = response.data.Widgets;
        self.widgetCount = response.data.WidgetsCount[0].rowCount;
        return {
          pagination: response.data.pagination
        };
      });
  };

  this.updatePageTemplate = function(object, formToken) {
    var requestPath = apiPath + '/' + object.id;
    var data = {};
    data.Template = object;
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
