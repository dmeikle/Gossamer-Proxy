<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_UPLOAD_PHOTOS_FOR') ?>
        <span ng-if="claim.jobNumber">{{claim.jobNumber}}</span>
        <span ng-if="!claim.jobNumber">{{claim.unassignedJobNumber}}</span>
    </h1>
</div>
<div class="modal-body">
    <div class="col-xs-4" >
        <?php
        $folderList = $this->httpRequest->getAttribute('folderList');
        foreach ($folderList['list'] as $locationId => $folder) {
            ?>
            <div dropzone="dropzoneConfig<?php echo $locationId; ?>" class="dropzone">
                <p class="text-center">
                    <?php echo $this->getString('CLAIMS_UPLOAD_TO'); ?>
                    <?php echo $folder['unitNumber']; ?>
                </p>
                <p class="text-center text-muted">
                    <small><?php echo $folder['count']; ?> <?php echo $this->getString('CLAIMS_PHOTOS') ?></small>
                </p>
            </div>
        <?php } ?>
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <button ng-click="close()">
            <?php echo $this->getString('CLOSE') ?>
        </button>
    </div>
</div>