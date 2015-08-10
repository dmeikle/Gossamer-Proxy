<div class="col-xs-12 col-md-6">
  <form></form>
  <div ng-repeat="(key,template) in pageTemplatesList"
    ng-if="template.name === selectedTemplate">
    <ul ng-repeat="(section, widgets) in pageTemplatesList[key].sections track by $index">
      <li ng-repeat="widget in widgets">
        <div class="widget-info">
          <h1>{{widget.name}}</h1>
          <p>{{widget.description}}</p>
        </div>
        <div class="widget-controls">
          <label for="{{widget.id}}_section">Active In:</label>
          <select name="{{widget.id}}_section" id="{{widget.id}}_section"
            ng-model="widget.newSection" ng-change="manipulateWidgetSection(widget)">
            <option value="disable">disable</option>
            <option ng-repeat="(sectionName, widgets) in pageTemplatesList[key].sections"
              ng-selected="sectionName === section"
              value="{{sectionName}}">{{sectionName}}</option>
          </select>
        </div>
      </li>
    </ul>
  </div>

</div>
