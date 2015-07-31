<div class="page-template">
  <div class="section {{ templateSection }}" ng-repeat="(templateSection, templateSectionWidgets) in pageTemplateSectionList">
    <div class="widget" ng-repeat="widget in templateSectionWidgets">
      <h1>{{ widget.name }}</h1>
      <p>{{ widget.description }}</p>
    </div>
  </div>
  {{pageTemplateSectionList}}
</div>
