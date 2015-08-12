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

  this.getPageTemplatesList = function(row, numRows) {
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {
        self.pageTemplatesList = response.data.WidgetPages;
        self.pageTemplatesCount = response.data.WidgetPagesCount[0];
      });
  };

  this.getWidgetsOnPageTemplate = function(pageTemplate) {
    if (pageTemplate) {
      $http.get(apiPath + '/widgets/' + pageTemplate.id)
        .then(function(response){
          self.widgetsOnPage = response.data.Widgets;
          return self.widgetsOnPage;
        });
    }
  };

  this.getUnusedWidgets = function(pageTemplate) {
    return $http.get('/super/widgets/unassigned/' + pageTemplate.id + '/all')
      .then(function(response) {
        self.unusedWidgetList = response.data.Widgets;
      });
  };

  this.addWidgetToPage = function(pageTemplate, object, sectionName, ymlKey, formToken) {
    var requestPath = apiPath + '/widgets/' + object.Widgets_id;
    var data = {};
    data.Widget = object;
    data.ymlKey = ymlKey;
    data.sectionName = sectionName;
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
