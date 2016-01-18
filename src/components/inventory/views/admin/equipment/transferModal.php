<div class="modal-header">
    <h1><?php echo $this->getString('INVENTORY_EQUIPMENT_TRANSFER') ?></h1>
</div>
<!--<div ng-if="loading || wizardLoading">
    <div class="spinner-loader"></div>
</div>-->

<div ng-if="!wizardLoading" ng-controller="rootAppWizardCtrl">
    <div ng-if="wizardLoading === true">
        <div class="spinner-loader"></div>
    </div>
    <!--<wizard class="modal-body" data-module="inventory" data-filename="inventoryTransferWizardPages"></wizard>-->
    <!--<script type="text/ng-template" id="inventoryTransferWizardPages">-->
        <?php include(__SITE_PATH . '/src/components/inventory/ng/views/inventoryTransferWizardPages.php'); ?>
    <!--</script>-->
</div>
