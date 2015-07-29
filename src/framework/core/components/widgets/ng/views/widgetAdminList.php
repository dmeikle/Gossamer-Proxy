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
          <div ng-switch-when="true">
            <input type='text' name='htmlKey' ng-model='widget.htmlKey' placeholder='Widget Name'>
          </div>
          <div ng-switch-default>
            {{ widget.htmlKey }}
          </div>
        </td>
        <td>
          <div ng-switch-when="true">
            <button type="button" name="button" ng-click='confirmEditedWidget(widget)'><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>
          </div>
          <div ng-switch-default>
            <button type='button' name='edit' ng-click='toggleEditingWidget(widget)'><?php echo $this->getString('WIDGET_EDIT'); ?></button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <pagination total-items="widgetCount" ng-model="currentPage" max-size="widgetsPerPage"
    class="pagination" boundary-links="true" rotate="false" num-pages="numPages">
  </pagination>
</div>
