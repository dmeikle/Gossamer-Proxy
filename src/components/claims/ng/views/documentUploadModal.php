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
                <?php echo $documentForm['DocumentTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="DocumentType_ClaimLocations_id">
                    <?php echo $this->getString('CLAIMS_DOCUMENTS_SELECT_UNIT') ?>
                </label>
                <?php echo $documentForm['ClaimsLocations_id']; ?>
            </div>
        </div>
        <div class="col-xs-6">
            <label>
                <?php echo $this->getString('CLAIMS_UPLOAD_TO') ?>
                <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
                <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
            </label>

            <div ng-if="!upload.DocumentTypes_id">
                <p class="text-center text-muted">
                    <?php echo $this->getString('CLAIMS_DOCUMENTS_PLEASE_SELECT_TYPE') ?>
                </p>
            </div>
            <div ng-if="upload.DocumentTypes_id">
                <div dropzone="dropzoneConfig" class="dropzone">
                    <p class="text-center">
                        <?php echo $this->getString('CLAIMS_UPLOAD_TO'); ?>
                        <span ng-if="model.jobNumber">{{model.jobNumber}}</span>
                        <span ng-if="!model.jobNumber">{{model.unassignedJobNumber}}</span>
                    </p>
                    <p class="text-center text-muted">
                        <small>
                            <span ng-if="documentCount && !documentUploading">{{documentCount}} <?php echo $this->getString('CLAIMS_DOCUMENTS') ?></span>
                            <span ng-if="documentUploading">
                                <span class="spinner-loader align-middle padding-right"></span> <?php echo $this->getString('CLAIMS_UPLOADING') ?>
                            </span>

                        </small>
                    </p>
                </div>
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