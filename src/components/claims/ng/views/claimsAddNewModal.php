<div class="modal-header">
  <h1>
    <?php echo $this->getString('CLAIMS_ADDNEW_WIZARD');?>
  </h1>
</div>
<div class="modal-body">
  <div ng-if="modalLoading"></div>
  <wizard data-module="claims" data-filename="addNewWizardPages"></wizard>
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
    <button type="submit" ng-click="saveAndNext()" class="btn btn-primary" form="wizard-form"
      ng-if=" currentPage < wizardPages.length - 2 && !addNewClient">
      <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
    </button>
    <button type="submit" ng-click="nextPage()" class="btn btn-primary" form="wizard-form"
      ng-if="currentPage === wizardPages.length - 2">
      <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
    </button>
    <button type="submit" ng-click="saveProjectAddress(project)" class="btn btn-primary" form="wizard-form"
      ng-if="currentPage < wizardPages.length - 2 && addNewClient">
      <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
    </button>
    <button type="submit" ng-click="confirm()" class="btn btn-primary" form="wizard-form"
      ng-if="currentPage === wizardPages.length - 1 && !addNewClient">
      <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
    </button>
  </div>
</div>
