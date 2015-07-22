<div class="button-container">
  <button type="button" name="addNewWidget" ng-click="addNewWidgetRow()" class="btn btn-primary col-xs-offset-10 col-xs-2">Add New</button>
</div>
<table class="table" id="widgetAdminList">
  <thead>
    <th>
      <?php echo $this->getString('WIDGET_NAME'); ?>
    </th>
    <th>
      <?php echo $this->getString('WIDGET_COMPONENT'); ?>
    </th>
    <th>
      <?php echo $this->getString('WIDGET_MODULE'); ?>
    </th>
    <th>
      <?php echo $this->getString('WIDGET_DESCRIPTION'); ?>
    </th>
    <th>
      <?php echo $this->getString('WIDGET_HTMLKEY'); ?>
    </th>
    <th>
      &nbsp;
    </th>
  </thead>
  <tbody>
    <tr ng-repeat="widget in widgetList">
      <td>
        {{ widget.name }}
      </td>
      <td>
        {{ widget.component }}
      </td>
      <td>
        {{ widget.module }}
      </td>
      <td>
        {{ widget.description }}
      </td>
      <td>
        {{ widget.key }}
      </td>
      <td>
        <button type="button" name="editWidget" ng-click="editWidget(widget.id)">Edit</button>
      </td>
    </tr>
  </tbody>
</table>
