<div class="modal-header" ng-switch="pageTemplate.id">
  <h1 ng-switch-when="undefined" class="modal-title">Add New Page</h1>
  <h1 class="modal-title" ng-switch-default>Edit Page</h1>
  <div class="clearfix"></div>
</div>
<div class="modal-body">
  <div class="form-group">
    <label for="name"><?php echo $this->getString('WIDGET_PAGE_NAME'); ?></label>
    <input class="form-control" type="text" name="name" id="page-template-name" ng-model="pageTemplate.name">
  </div>
  <div class="form-group">
    <label for="name"><?php echo $this->getString('WIDGET_PAGE_YAML_KEY'); ?></label>
    <input class="form-control" type="text" name="yaml-key" id="page-template-yaml-key" ng-model="pageTemplate.ymlKey">
  </div>
  <div class="form-group">
    <label for="name"><?php echo $this->getString('WIDGET_PAGE_DESCRIPTION'); ?></label>
    <input class="form-control" type="text" name="description" id="page-template-description" ng-model="pageTemplate.description">
  </div>

  <input class="hidden" type="text" name="system" id="page-template-system" ng-model="pageTemplate.isSystemWidget" value="'1'">

  <div ng-if="pageTemplate.id">
    <h3><?php echo $this->getString('WIDGET_PAGE_WIDGETS') ?></h3>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th><?php echo $this->getString('WIDGET_NAME'); ?></th>
          <th><?php echo $this->getString('WIDGET_DESCRIPTION'); ?></th>
          <th><?php echo $this->getString('WIDGET_SECTION'); ?></th>
          <th><?php echo $this->getString('WIDGET_PRIORITY'); ?></th>
          <th>&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <tr ng-repeat="widget in widgetsOnPage" ng-switch="editing">
          <td>{{widget.name}}</td>
          <td>{{widget.description}}</td>
          <td>{{widget.sectionName}}</td>
          <td>
            <div ng-switch-when="true">
              <input type='text' name='name' ng-model='widget.priority' placeholder='Widget Priority'>
            </div>
            <div ng-switch-default>
              {{ widget.priority }}
            </div>
          </td>
          <td>
            <button ng-click="removeWidgetFromPage(widget)">Remove</button>
          </td>
        </tr>
      </tbody>
    </table>
    <form class="hidden"></form>
    <h3><?php echo $this->getString('WIDGET_PAGE_ADD_WIDGET') ?></h3>
    <input list="unusedWidgets" ng-model="widgetToAdd" ng-change="getWidgetByName(widgetToAdd)">
    <datalist id="unusedWidgets">
      <option ng-repeat="widget in unusedWidgetList" value="{{widget.name}}">
    </datalist>
    <select id="section-select" ng-model="sectionName">
      <option value="section3">Section 3</option>
      <option value="section4">Section 4</option>
      <option value="topwidgets" selected>Top Widgets</option>
    </select>
    <button ng-click="addWidgetToPage(pageTemplate, widgetObjectToAdd, sectionName, pageTemplate.ymlKey)">
      <?php echo $this->getString('WIDGET_PAGE_ADD') ?>
    </button>
  </div>

</div>
<div class="modal-footer">
  <button ng-if="!pageTemplate.id" ng-click="saveAndContinue(pageTemplate)">Manage Widgets</button>
  <button class="primary" ng-click="confirm(pageTemplate)"><?php echo $this->getString('WIDGET_PAGE_CONFIRM'); ?></button>

  <button ng-click="cancel()"><?php echo $this->getString('WIDGET_PAGE_CANCEL'); ?></button>
</div>
