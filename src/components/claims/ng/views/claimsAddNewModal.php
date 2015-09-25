<div class="modal-header">
  <h1>
    <?php echo $this->getString('CLAIMS_ADDNEW_WIZARD');?>
  </h1>
</div>
<div class="modal-content">
  <add-new-wizard data-module="claims">

  </add-new-wizard>
</div>
<div class="modal-footer">
  <div class="pull-right btn-group">
    <button class="btn-default" ng-click="nextPage()" ng-disabled="currentPage === 0">
      <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
    </button>
    <button class="primary" ng-click="nextPage()" ng-if="currentPage < wizardPages.length">
      <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
    </button>
  </div>
</div>
