module.service('widgetAdminSrv', function($http, $log) {

  var apiPath = '/super/widgets';

  var self = this;

  this.createNewWidget = function(widgetObject, formToken) {
    var requestPath = apiPath + '/0';
    var data = {};
    data.Widget = widgetObject;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
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

  this.getWidgetList = function(row, numRows) {
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {
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
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      $log.info(response);
    });
  };
});

module.service('templateSrv', function() {
  this.widgetAdminList = '/render/widgets/widgetAdminList';
  this.pageTemplateWidgets = '/render/widgets/pageTemplateWidgets';
  this.unusedWidgetList = '/render/widgets/unusedWidgetList';
});


// Pages service

module.service('pageTemplatesSrv', function($http, $log) {

  var apiPath = '/super/widgets/pages';

  var self = this;

  this.templateContext = function(callback) {
    for (var template in self.pageTemplatesList) {
      if (self.pageTemplatesList.hasOwnProperty(template)) {
        if (self.pageTemplatesList[template].name === self.selectedTemplate) {
          if (angular.isFunction(callback)) {
            callback(template);
          } else {
            throw 'templateContext requires input to be a callback that takes in template and section';
          }
        }
      }
    }
  };

  this.sectionContext = function(callback) {
    for (var template in self.pageTemplatesList) {
      if (self.pageTemplatesList.hasOwnProperty(template)) {
        if (self.pageTemplatesList[template].name === self.selectedTemplate) {
          for (var section in self.pageTemplatesList[template].sections) {
            if (self.pageTemplatesList[template].sections.hasOwnProperty(section)) {
              if (angular.isFunction(callback)) {
                callback(template, section);
              } else {
                throw 'sectionContext requires input to be a callback that takes in template and section';
              }
            }
          }
        }
      }
    }
  };

  this.widgetContext = function(callback) {
    for (var template in self.pageTemplatesList) {
      if (self.pageTemplatesList.hasOwnProperty(template)) {
        if (self.pageTemplatesList[template].name === self.selectedTemplate) {
          for (var section in self.pageTemplatesList[template].sections) {
            if (self.pageTemplatesList[template].sections.hasOwnProperty(section)) {
              for (var widget in self.pageTemplatesList[template].sections[section]) {
                if (self.pageTemplatesList[template].sections[section].hasOwnProperty(widget)) {
                  if (angular.isFunction(callback)) {
                    callback(template, section, widget);
                  } else {
                    throw 'widgetContext requires input to be a callback that takes in template, section, widget';
                  }
                }
              }
            }
          }
        }
      }
    }
  };

  this.createNewPageTemplate = function(pageTemplateObject, formToken) {
    var requestPath = apiPath + '/0';
    var data = {};
    data.Template = pageTemplateObject;
    data.FORM_SECURITY_TOKEN = formToken;
    $log.info(data);
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      $log.info(response);
    });
  };

  this.getPageTemplatesList = function() {
    return $http.get(apiPath + '/list')
      .then(function(response) {
        self.pageTemplatesList = response.data;
      });
  };

  this.getUnusedWidgets = function(row, numRows) {
    if (self.selectedTemplateObject !== undefined) {
      return $http.get('/super/widgets/unassigned/' + self.selectedTemplateObject.id + '/' + row + '/' + numRows)
        .then(function(response) {
          var unusedWidgets = [];
          for (var widget in response.data.Widgets) {
            unusedWidgets.push(response.data.Widgets[widget]);
            if (unusedWidgets.hasOwnProperty(widget)) {
              unusedWidgets[widget].section = 'disable';
            }
          }
          self.unusedWidgetList = unusedWidgets;
        });
    }
    return $http.get('/super/widgets/' + row + '/' + numRows)
      .then(function(response) {
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
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      $log.info(response);
    });
  };
});
