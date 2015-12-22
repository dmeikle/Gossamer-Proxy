<div class="modal-header">
    <h1><?php echo $this->getString('INVENTORY_EQUIPMENT_TRANSFER') ?></h1>
</div>
<!--<div ng-if="loading || wizardLoading">
    <div class="spinner-loader"></div>
</div>-->

<div ng-if="!wizardLoading">
    <div ng-if="wizardLoading === true">
        <div class="spinner-loader"></div>
    </div>
    <wizard class="modal-body" data-module="inventory" data-filename="inventoryTransferWizardPages"></wizard>
</div>
