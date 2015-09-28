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
    <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
      <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
    </button>
    <button class="primary" ng-click="nextPage()" ng-if="currentPage < wizardPages.length - 1">
      <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
    </button>
    <button class="primary" ng-click="confirm()" ng-if="currentPage === wizardPages.length - 1">
      <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
    </button>
  </div>
</div>
