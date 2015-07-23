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
<<<<<<< HEAD
      <tr ng-repeat="widget in widgetList">
=======
      <form name="newWidgetForm" action="index.html" method="post">
        <tr>
          <td>
            <input type='text' name='name' ng-model='newWidget.name' placeholder='Widget Name'>
          </td>
          <td>
            <input type='text' name='component' ng-model='newWidget.component' placeholder='Widget Component'>
          </td>
          <td>
            <input type='text' name='description' ng-model='newWidget.description' placeholder='Widget Description'>
          </td>
          <td>
            <input type='text' name='module' ng-model='newWidget.module' placeholder='Widget Module'>
          </td>
          <td>
            <input type='text' name='key' ng-model='newWidget.htmlKey' placeholder='Widget HTML Key'>
          </td>
          <td>
            <button type='button' name='Confirm' ng-click='addNewWidget(newWidget)'><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>
          </td>
        </tr>
      </form>

      <tr ng-repeat="widget in widgetList" id="{{widget.id}}">
>>>>>>> removed reference to sanitize, widget post works
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
