<!--- javascript start --->

@/components/widgets/widgets.concat.js

<!--- javascript end --->

<!--- css start --->

@/assets/css/widgets.min.css

<!--- css end --->

<div class="container-fluid" ng-controller="pageTemplatesCtrl">
  <div class="button-container">
    <div class="col-xs-12 col-md-4">
      <div class="col-xs-12 col-md-6">
        <input list="pageTemplates" ng-model="selectedPageTemplate" class="form-control">
        <datalist id="pageTemplates">
          <option ng-repeat="template in pageTemplatesList" value="{{template.name}}">
        </datalist>
      </div>
      <div class="col-xs-12 col-md-4">
        <button class="pull-right">New Page</button>
      </div>
    </div>
    <div class="offset-four">
      <button ng-click="updatePageTemplate(pageTemplateSectionList)" class="primary pull-right">Apply</button>
    </div>
  </div>
  <div class="table-container" ng-cloak>
    <div class="col-xs-12 col-md-6">
      <page-template-widgets></page-template-widgets>
    </div>
    <div class="col-xs-12 col-md-6">
      <unused-widget-list></unused-widget-list>
    </div>

  </div>
</div>
