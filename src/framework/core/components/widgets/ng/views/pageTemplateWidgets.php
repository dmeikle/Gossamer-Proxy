<div class="col-xs-12 col-md-6">
  <form></form>
  <ul ng-repeat="(section, widgets) in pageTemplateSectionList">
    <li ng-repeat="widget in widgets">
      <div class="widget-info">
        <h1>{{widget.name}}</h1>
        <p>{{widget.description}}</p>
      </div>
      <div class="widget-controls">
        <label for="{{widget.id}}_section">Active In:</label>
        <select name="{{widget.id}}_section" id="{{widget.id}}_section">
          <option value="disable">disable</option>
          <option ng-repeat="(sectionName, widgets) in pageTemplateSectionList"
            ng-selected="sectionName === section"
            value="{{sectionName}}">{{sectionName}}</option>
        </select>
      </div>
    </li>
  </ul>
</div>
