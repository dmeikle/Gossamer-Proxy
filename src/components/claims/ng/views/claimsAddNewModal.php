<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_ADDNEW_WIZARD'); ?>
    </h1>
</div>
<div class="modal-body">
    <div ng-if="modalLoading"></div>
    <wizard data-module="claims" data-filename="addNewWizardPages"></wizard>
</div>
