<div class="modal-header">
  <h1>
    <?php echo $this->getString('CLAIMS_ADDNEW_WIZARD');?>
  </h1>
</div>
<div class="modal-body">
  <div ng-if="modalLoading"></div>
  <add-new-wizard data-module="claims"></add-new-wizard>
</div>
<div class="modal-footer">
  <div class="pull-left">
    <button class="btn-default" ng-click="cancel()">
      <?php echo $this->getString('CLAIMS_CANCEL'); ?>
    </button>
  </div>
  <div class="pull-right btn-group">
    <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0" ng-if="!addNewClient">
      <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
    </button>
    <button class="btn-default" ng-click="toggleAdding()" ng-if="addNewClient">
      <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
    </button>
    <input type="submit" class="btn btn-primary" form="wizard-form" ng-if="currentPage < wizardPages.length - 1 && !addNewClient"
      value="<?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>">
    <input type="submit" class="btn btn-primary" form="wizard-form" ng-if="currentPage === wizardPages.length - 1"
      value="<?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>">
    <input type="submit" class="btn btn-primary" form="wizard-form" ng-if="currentPage < wizardPages.length - 1 && addNewClient"
      value="<?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>">
  </div>
</div>
