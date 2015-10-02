<div class="widget" ng-controller="initialJobsheetCtrl">
  <div class="widgetheader">
    <h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
  </div>
  <wizard class="clearfix" data-module="claims" data-filename="initialJobsheetWizardPages"></wizard>
  <div class="widgetfooter clearfix">
    <div class="pull-right btn-group">
      <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
        <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
      </button>
      <button type="submit" class="btn btn-primary" form="wizard-form" ng-click="nextPage()"
        ng-if="currentPage < wizardPages.length - 1">
        <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
      </button>
    </div>
</div>
