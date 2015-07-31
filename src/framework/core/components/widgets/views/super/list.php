<!--- javascript start --->

  @/components/widgets/widgets.concat.js

<!--- javascript end --->

<div class="container-fluid">
  <div class="row" ng-controller="pageTemplatesCtrl">
    <input list="pageTemplates" ng-model="selectedPageTemplate">
    <datalist id="pageTemplates">
      <option value="{{template.name}}" data-template="{{template}}" ng-repeat="template in pageTemplatesList">
    </datalist>
  </div>
  <div class="col-xs-6 row" ng-controller="pageTemplatesCtrl">
    <page-template></page-template>
  </div>
  <div ng-controller="viewWidgetsCtrl" class="col-xs-6 row">
      <widget-admin-list></widget-admin-list>
  </div>
</div>
