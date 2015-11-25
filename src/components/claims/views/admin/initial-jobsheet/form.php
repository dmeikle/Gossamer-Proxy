<div class="widget" ng-controller="initialJobsheetCtrl">
    <div class="widgetheader">
        <h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
    </div>

    <div ng-if="loading || wizardLoading">
        <span class="spinner-loader"></span>
    </div>
    <wizard ng-show="!loading && !wizardLoading" class="clearfix" data-module="claims" data-filename="initialJobsheetWizardPages"></wizard>
</div>
