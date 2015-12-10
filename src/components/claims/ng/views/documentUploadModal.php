<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_UPLOAD_DOCUMENTS_TO') ?>
        <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
        <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
    </h1>
</div>
<div class="modal-body">
    <form name="documentUploadForm">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="DocumentType_documentType">
                    <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_TYPE') ?>
                </label>
                <?php echo $documentForm['documentType']; ?>
            </div>
            <div class="form-group">
                <label for="DocumentType_ClaimLocations_id">
                    <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_UNIT') ?>
                </label>
                <?php echo $documentForm['ClaimLocations_id']; ?>
            </div>
        </div>
        <div class="col-xs-6">
            <label>
                <?php echo $this->getString('CLAIMS_UPLOAD_TO') ?> 
                <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
                <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
            </label>
            <div dropzone="dropzoneConfig" class="dropzone">
                <p class="text-center">
                    <?php echo $this->getString('CLAIMS_UPLOAD_TO'); ?>
                    <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
                    <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
                </p>
                <p class="text-center text-muted">
                    <small>
                        <span ng-if="documentCount">{{documentCount}}</span>
                        <span ng-if="!documentCount" class="spinner-loader"></span> 
                        <?php echo $this->getString('CLAIMS_DOCUMENTS') ?>
                    </small>
                </p>
            </div>
        </div>
    </form>
    <div class="clearfix"></div>
</div><div class="modal-footer">
    <div class="pull-right">
        <button class="primary" ng-click="close()">
            <?php echo $this->getString('CLOSE') ?>
        </button>
    </div>
</div>