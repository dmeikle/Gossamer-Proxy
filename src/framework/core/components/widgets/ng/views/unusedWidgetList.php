

<div>
  <table class="table" id="widgetList">
    <thead>
      <th>
        <?php echo $this->getString('WIDGET_NAME'); ?>
      </th>
      <th>
        <?php echo $this->getString('WIDGET_DESCRIPTION'); ?>
      </th>
      <th>
        <?php echo $this->getString('WIDGET_SECTION'); ?>
      </th>
    </thead>
    <tbody>
      <tr ng-repeat="widget in unusedWidgetList" id="{{widget.id}}">
        <td>
          {{ widget.name }}
        </td>
        <td>
          {{ widget.description }}
        </td>
        <td>
          <select name="{{widget.id}}_section" id="{{widget.id}}_section"
            ng-model="widget.newSection" ng-change="manipulateWidgetSection(widget)">
            <option value="disable">disable</option>
            <option ng-repeat="(sectionName, widgets) in selectedTemplateObject.sections"
              ng-selected="sectionName === widget.section"
              value="{{sectionName}}">{{sectionName}}</option>
          </select>
        </td>
      </tr>
    </tbody>
  </table>
  <pagination total-items="widgetCount" ng-model="currentPage" max-size="widgetsPerPage"
    class="pagination" boundary-links="true" rotate="false" num-pages="numPages">
  </pagination>
</div>
