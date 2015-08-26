<div class="modal-header" ng-switch="costcardItemType.id">
  <h1 ng-switch-when="undefined" class="modal-title">Add New Cost Card Item Type</h1>
  <h1 class="modal-title" ng-switch-default>Edit Cost Card Item Type</h1>
  <div class="clearfix"></div>
</div>
<div class="modal-body">
  <div class="form-group">
    <label for="name"><?php echo $this->getString('WIDGET_NAME'); ?></label>
    <input class="form-control" type="text" name="name"
      id="costcardItemType-type" ng-model="costcardItemType.type">
  </div>
  <form></form>
</div>
<div class="modal-footer">
  <button class="primary" ng-click="confirm(costcardItemType)"><?php echo $this->getString('WIDGET_CONFIRM'); ?></button>

  <button ng-click="cancel()"><?php echo $this->getString('WIDGET_CANCEL'); ?></button>
</div>
