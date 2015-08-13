module.service('widgetsSrv', function($http, $log) {

  var apiPath = '/super/widgets';

  var self = this;

  this.saveWidget = function(widgetObject, formToken) {
    var requestPath;
    if (!widgetObject.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + widgetObject.id;
    }
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

  this.deleteWidget = function(widget) {
    var requestPath = apiPath + '/remove/' + widget.id;
    return $http.delete(requestPath).then(function(response) {
      $log.info(response);
    });
  };
});

module.service('templateSrv', function() {
  this.pageTemplateModal = '/render/widgets/pageTemplateModal';
  this.widgetModal = '/render/widgets/widgetModal';
});


// Pages service

module.service('pageTemplatesSrv', function($http, $log) {

  var apiPath = '/super/widgets/pages';

  var self = this;

  this.savePageTemplate = function(object, formToken) {
    var requestPath;
    if (!object.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + object.id;
    }
    var data = {};
    object.isSystemPage = 1;
    data.WidgetPage = object;
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

  this.getPageTemplatesList = function(row, numRows) {
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {
        self.pageTemplatesList = response.data.WidgetPages;
        self.pageTemplatesCount = response.data.WidgetPagesCount[0];
      });
  };

  this.getWidgetsOnPageTemplate = function(pageTemplate) {
    return $http.get(apiPath + '/widgets/' + pageTemplate.id)
      .then(function(response){
        var widgets = [];
        for (var section in response.data) {
          if (response.data.hasOwnProperty(section)) {
            if (section !== "widgets/super_widgetpages_widgets_list" &&
                section !== "modules") {
              for (var widget in response.data[section]) {
                if (response.data[section].hasOwnProperty(widget)) {
                  response.data[section][widget].sectionName = section;
                  widgets.push(response.data[section][widget]);
                }
              }
            }
          }
        }
        self.widgetsOnPage = widgets;
      });
  };

  this.getUnusedWidgets = function(pageTemplate) {
    if (!pageTemplate) {
      return $http.get('/super/widgets/unassigned/all/0')
        .then(function(response){
          self.unusedWidgetList = response.data.Widgets;
        });
    }
    return $http.get('/super/widgets/unassigned/all/' + pageTemplate.id )
      .then(function(response) {
        self.unusedWidgetList = response.data.Widgets;
      });
  };

  this.addWidgetToPage = function(pageTemplate, object, sectionName, ymlKey, formToken) {
    var requestPath = apiPath + '/widgets/' + pageTemplate.id;
    var data = {};
    data.WidgetPageWidget = {};
    data.WidgetPageWidget.Widgets_id = object.Widgets_id;
    data.WidgetPageWidget.ymlKey = ymlKey;
    data.WidgetPageWidget.sectionName = sectionName;
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

  this.removeWidgetFromPage = function(pageTemplate, widget) {
    var requestPath = apiPath + '/widgets/remove/' + pageTemplate.ymlKey + '/' + widget.id;
    return $http.delete(requestPath).then(function(response) {
      $log.info(response);
    });
  };

  this.deletePageTemplate = function(pageTemplate) {
    var requestPath = apiPath + '/remove/' + pageTemplate.id;
    return $http.delete(requestPath).then(function(response) {
      $log.info(response);
    });
  };

});
