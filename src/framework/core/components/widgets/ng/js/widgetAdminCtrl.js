module.controller('viewWidgetsCtrl', function($scope, widgetAdminSrv) {
  $scope.getWidgetList = function(row) {
    widgetAdminSrv.getWidgetList(row, $scope.widgetsPerPage).then(function(response) {
      $scope.numPages = widgetAdminSrv.widgetCount / $scope.widgetsPerPage;
      $scope.widgetList = widgetAdminSrv.widgetList;
      $scope.widgetCount = widgetAdminSrv.widgetCount;
    });
  };

  saveWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    widgetAdminSrv.createNewWidget(widgetObject, formToken).then(function(response) {
      $scope.getWidgetList((($scope.currentPage - 1) * $scope.widgetsPerPage));
      $scope.newWidget = {};
      $scope.newWidgetForm.$setPristine();
    });
  };

  updateWidget = function(widgetObject, formToken) {
    widgetAdminSrv.updateWidget(widgetObject, formToken);
  };

  $scope.addNewWidget = function(newWidgetObject) {
    saveWidget(newWidgetObject);
  };

  $scope.toggleEditingWidget = function(widgetObject) {
    widgetAdminSrv.toggleEditingWidget(widgetObject);
  };

  $scope.confirmEditedWidget = function(widgetObject) {
    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    updateWidget(widgetObject, formToken);
    widgetAdminSrv.toggleEditingWidget(widgetObject);
  };

  $scope.selectPage = function(pageNum) {
    $scope.currentPage = pageNum;
  };

  $scope.$watch('currentPage + numPerPage', function() {
    var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
    var numRows = $scope.widgetsPerPage;

    $scope.getWidgetList(row, numRows);
  });

  // Stuff to run on controller load
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;
  // $scope.getWidgetList(0, $scope.widgetsPerPage);
});



// Pages controller

module.controller('pageTemplatesCtrl', function($scope, pageTemplatesSrv) {

  function getPageTemplatesList() {
    pageTemplatesSrv.getPageTemplatesList().then(function(response) {
      $scope.pageTemplatesList = pageTemplatesSrv.pageTemplatesList;
    });
  }

  function getUnusedWidgets() {
    pageTemplatesSrv.getUnusedWidgets(row, numRows)
      .then(function(response) {
        $scope.unusedWidgetList = pageTemplatesSrv.unusedWidgetList;
        $scope.widgetCount = pageTemplatesSrv.widgetCount;
        $scope.numPages = pageTemplatesSrv.widgetCount / $scope.widgetsPerPage;
      });
  }

  $scope.manipulateWidgetSection = function(object) {
    switch (object.newSection) {
      case 'disable':
        removeWidgetFromSection(object);
        break;
      default:
        addWidgetToSection(object);
    }
  };

  addWidgetToSection = function(object) {
    pageTemplatesSrv.sectionContext(function(template, section){
      if (section === object.newSection) {
        removeWidgetFromSection(object);
        object.section = object.newSection;
        pageTemplatesSrv.pageTemplatesList[template].sections[section].push(object);
        updatePageTemplate(pageTemplatesSrv.selectedTemplateObject);
      }
    });
  };

  removeWidgetFromSection = function(object) {
    var popObject = function(element) {
      return element !== object;
    };
    pageTemplatesSrv.sectionContext(function(template, section){
      if (section === object.section) {
        $scope.pageTemplatesList[template].sections[section] = $scope.pageTemplatesList[template].sections[section]
          .filter(popObject);
        object.section = object.newSection;
        pageTemplatesSrv.pageTemplatesList[template].sections[section] = $scope.pageTemplatesList[template].sections[section];

        updatePageTemplate(pageTemplatesSrv.selectedTemplateObject);
        getUnusedWidgets();
      }
    });
  };

  updatePageTemplate = function(object) {


    var formToken = document.getElementById('FORM_SECURITY_TOKEN').value;
    pageTemplatesSrv.updatePageTemplate(object, formToken);
  };

  $scope.populateSelectedTemplate = function(templateName) {
    if (templateName !== undefined) {
      pageTemplatesSrv.selectedTemplate = templateName;
      $scope.selectedTemplate = templateName;
      pageTemplatesSrv.sectionContext(function(template, section) {
        $scope.pageTemplatesList[template].sections = pageTemplatesSrv.pageTemplatesList[template].sections;
      });

      pageTemplatesSrv.widgetContext(function(template, section, widget){
        $scope.pageTemplatesList[template].sections[section][widget].section = section;
      });

      pageTemplatesSrv.templateContext(function(template){
        pageTemplatesSrv.selectedTemplateObject = pageTemplatesSrv.pageTemplatesList[template];
        $scope.selectedTemplateObject = pageTemplatesSrv.selectedTemplateObject;
      });

      var pageTemplate = pageTemplatesSrv.selectedTemplateObject;

      getUnusedWidgets(row, numRows, pageTemplate);
    }
  };

  $scope.$watch('currentPage + numPerPage', function() {
    getUnusedWidgets(row, numRows);
  });

  getPageTemplatesList();
  $scope.widgetsPerPage = 10;
  $scope.currentPage = 1;

  var row = (($scope.currentPage - 1) * $scope.widgetsPerPage);
  var numRows = $scope.widgetsPerPage;
});
