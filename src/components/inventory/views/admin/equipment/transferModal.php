<div class="modal-header">
    <h1><?php echo $this->getString('TRANSFER') ?></h1>
</div>
<div ng-if="loading || wizardLoading">
    <div class="spinner-loader"></div>
</div>
<div ng-if="!loading && !wizardLoading">
    <wizard class="modal-body" data-module="inventory" data-filename="inventoryTransferWizardPages"></wizard>
</div>
