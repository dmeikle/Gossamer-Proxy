<div class="modal-header">
	<h1>
		<?php echo $this->getString('CLAIMS_UPLOAD_PHOTOS_FOR') ?> 
		<span ng-if="claim.jobNumber">{{claim.jobNumber}}</span>
		<span ng-if="!claim.jobNumber">{{claim.unassignedJobNumber}}</span>
	</h1>
</div>
<div class="modal-body">
	<div class="col-xs-4" ng-repeat="claimLocation in claimLocations">
		<div dropzone="dropzoneConfig{{$index}}" class="dropzone">
            <p class="text-center">
                <?php echo $this->getString('CLAIMS_UPLOAD_TO'); ?> 
                {{claimLocation.unitNumber}}
            </p>
        </div>
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