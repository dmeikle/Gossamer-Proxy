<div class="modal-header" ng-switch="widget.id">
    <h1 ng-switch-when="undefined" class="modal-title">Add New Widget</h1>
    <h1 class="modal-title" ng-switch-default>Edit Widget</h1>
    <div class="clearfix"></div>
</div>
<div class="modal-body">
    <div class="form-group">
        <label for="name"><?php echo $this->getString('WIDGET_NAME'); ?></label>
        <input class="form-control" type="text" name="name"
               id="widget-name" ng-model="widget.name">
    </div>
    <div class="form-group">
        <label for="name"><?php echo $this->getString('WIDGET_DESCRIPTION'); ?></label>
        <input class="form-control" type="text" name="description" id="widget-description" ng-model="widget.description">
    </div>
    <div class="form-group">
        <label for="name"><?php echo $this->getString('WIDGET_HTMLKEY'); ?></label>
        <input class="form-control" type="text" name="yaml-key"
               id="widget-html-key" ng-model="widget.htmlKey">
    </div>
    <div class="form-group">
        <label for="name"><?php echo $this->getString('WIDGET_COMPONENT'); ?></label>
        <input class="form-control" type="text" name="component"
               id="widget-component" ng-model="widget.component">
    </div>
    <div class="form-group">
        <label for="name"><?php echo $this->getString('WIDGET_MODULE'); ?></label>
        <input class="form-control" type="text" name="module"
               id="widget-module" ng-model="widget.module">
    </div>
    <form></form>
</div>
<div class="modal-footer">
    <button class="primary" ng-click="confirm(widget)"><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>

    <button ng-click="cancel()"><?php echo $this->getString('WIDGET_CANCEL'); ?></button>
</div>
