<div class="button-container">
  <button type="button" name="addNewWidget" ng-click="addNewWidgetRow()" class="btn btn-primary col-xs-offset-10 col-xs-2">Add New</button>
</div>
<div class="table-container">
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
          <button type="button" name="editWidget" ng-click="editWidget(widget.id)">
            <?php echo $this->getString('WIDGET_EDIT'); ?>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
<<<<<<< HEAD
<<<<<<< HEAD
=======
  <pagination total-items="widgetCount" ng-model="currentPage" ng-change="getWidgetList((currentPage * widgetsPerPage), widgetsPerPage)" max-size="widgetsPerPage"
=======
  <pagination total-items="widgetCount" ng-model="currentPage" max-size="widgetsPerPage"
>>>>>>> Something going on with the params the create api is receiving
    class="pagination" boundary-links="true" rotate="false" num-pages="numPages">
  </pagination>
>>>>>>> Got pagination working
</div>
