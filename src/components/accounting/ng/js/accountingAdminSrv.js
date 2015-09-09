module.service('costCardItemTypeSrv', function($http) {

  var apiPath = '/super/accounting/costcarditemtypes';

  var self = this;

  this.save = function(object, formToken) {
    var requestPath;
    if (!object.id) {
      requestPath = apiPath + '/0';
    } else {
      requestPath = apiPath + '/' + object.id;
    }
    var data = {};
    data.CostCardItemType = object;
    data.FORM_SECURITY_TOKEN = formToken;
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  };

  this.toggleEditing = function(object) {
    if (object.editing) {
      object.editing = false;
    } else {
      object.editing = true;
    }
  };

  this.getList = function(row, numRows) {
     
    return $http.get(apiPath + '/' + row + '/' + numRows)
      .then(function(response) {
        self.costCardItemTypesList = response.data.CostCardItemTypes;
        self.costCardItemTypesCount = response.data.CostCardItemTypesCount[0].rowCount;
        return {
          pagination: response.data.pagination
        };
      });
  };

  this.delete = function(object) {
    var requestPath = apiPath + '/remove/' + object.id;
    return $http.delete(requestPath);
  };
});

module.service('templateSrv', function() {
  this.costCardItemTypeModal = '/render/accounting/CostCardItemTypeModal';
  //this.widgetModal = '/render/accounting/CostCardItemTypeModal';
});


// Pages service

module.service('pageTemplatesSrv', function($http) {

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
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    }).then(function(response) {
      return response;
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
    return $http({
      method: 'POST',
      url: requestPath,
      data: data,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      }
    });
  };

  this.removeWidgetFromPage = function(pageTemplate, widget) {
    var requestPath = apiPath + '/widgets/remove/' + pageTemplate.ymlKey + '/' + widget.id;
    return $http.delete(requestPath);
  };

  this.deletePageTemplate = function(pageTemplate) {
    var requestPath = apiPath + '/remove/' + pageTemplate.id;
    return $http.delete(requestPath);
  };

});

// Timesheet service
module.service('timesheetSrv', function($http) {
    var apiPath = '/admin/accounting/timesheets';

    var self = this;
    
    this.getTimesheetList = function(row, numRows){
        return $http.get(apiPath + '/' + row + '/' + numRows)
        .then(function(response) {
            console.log(self);
            self.timesheetList = response.data.Timesheets;
            //self.staffCount = response.data.StaffsCount[0].rowCount;
        });
    };
});