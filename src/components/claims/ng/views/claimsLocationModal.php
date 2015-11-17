<div class="modal-header">
	<h1><?php echo $this->getString('CLAIMS_LOCATIONS_ADDNEW') ?></h1>
</div>
<div class="modal-body clearfix">
<?php echo $form['Claims_id'] ?>
	
	<div class="form-group col-xs-12 col-md-6">
		<label for="ClaimLocation_unitNumber">
			<?php echo $this->getString('CLAIMS_LOCATIONS_UNITNUMBER') ?>
		</label>
		<?php echo $form['unitNumber'] ?>
	</div>
	<div class="form-group col-xs-12 col-md-6">
		<label for="ClaimLocation_buzzer">
			<?php echo $this->getString('CLAIMS_LOCATIONS_BUZZER') ?>
		</label>
		<?php echo $form['buzzer'] ?>
	</div>
	<div class="form-group col-xs-12 col-md-6">
		<label for="ClaimLocation_phase">
			<?php echo $this->getString('CLAIMS_LOCATIONS_PHASE') ?>
		</label>
		<?php echo $form['ClaimPhases_id'] ?>
	</div>
	<div class="form-group col-xs-12 col-md-6">
		<label for="ClaimLocation_status">
			<?php echo $this->getString('CLAIMS_LOCATIONS_STATUS') ?>
		</label>
		<?php echo $form['ClaimStatus_id'] ?>
	</div>
</div>
<div class="modal-footer">
	<div class="pull-right btn-group">
		<button class="btn-default" ng-click="cancel()">
			<?php echo $this->getString('CANCEL') ?>
		</button>
		<button class="primary" ng-click="confirm()">
			<?php echo $this->getString('CONFIRM') ?>
		</button>
	</div>
</div>