<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_ADD_AFFECTED_AREA') ?>
    </h1>
</div>
<div class="modal-body">
    <form>
        <div class="col-xs-12">
            <div class="form-group">
                <label for="DocumentType_documentType">
                    <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_TYPE') ?>
                </label>
                <?php echo $form['AreaTypes']; ?>
            </div>
        </div>
        <div class="col-xs-3">
            <label><?php echo $this->getString('CLAIMS_WIDTH') ?></label>
            <?php echo $form['width']; ?>
        </div>
        <div class="col-xs-3">
            <label><?php echo $this->getString('CLAIMS_HEIGHT') ?></label>
            <?php echo $form['height']; ?>
        </div>
        <div class="col-xs-3">
            <label><?php echo $this->getString('CLAIMS_LENGTH') ?></label>
            <?php echo $form['length']; ?>
        </div>
        <div class="col-xs-3">
            <label><?php echo $this->getString('CLAIMS_ENTRY_IS_NORTH') ?></label>
            <div><input type="checkbox" ng-model="modal.item.entryIsNorth" ng-true-value="1" ng-false-value="0"></div>
        </div>
    </form>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <div class="btn-group" role="group">
            <button class="primary" ng-click="modal.save()">
                <?php echo $this->getString('SAVE') ?>
            </button>
            <button class="default" ng-click="modal.close()">
                <?php echo $this->getString('CLOSE') ?>
            </button>
        </div>
    </div>
</div>
<form></form>