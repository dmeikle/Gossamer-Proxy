<!--- javascript start --->

@/components/widgets/widgets.concat.js

<!--- javascript end --->

<!--- css start --->

@/assets/css/widgets.min.css

<!--- css end --->

<div ng-controller="pageTemplatesCtrl">
  <div class="button-container">
    <div class="centered-4-cols">
      <input list="pageTemplates" ng-model="selectedPageTemplate">
      <datalist id="pageTemplates">
        <option ng-repeat="template in pageTemplatesList" value="{{template.name}}">
      </datalist>
      <button>New Page</button>
    </div>
  </div>
  <div class="table-container" ng-cloak>
    <page-template-widgets></page-template-widgets>
    <div class="col-xs-12 col-md-6" ng-controller="viewWidgetsCtrl">
      <widget-list></widget-list>
    </div>

  </div>
</div>
