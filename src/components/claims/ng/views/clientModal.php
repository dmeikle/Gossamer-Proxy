<div class="modal-header">
	<h1 ng-if="!client.id">
		<?php echo $this->getString('CLAIMS_NEW_CLIENT') ?>
	</h1>
	<div ng-if="client.id">
		<h1 class="pull-left">
			<?php echo $this->getString('EDIT') ?> 
			{{client.firstname}} {{client.lastname}}
		</h1>
		<div class="pull-right">
			<button class="btn-default">
				<?php echo $this->getString('REMOVE') ?>
			</button>
		</div>
	</div>
</div>
<div class="modal-body clearfix">
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_FIRSTNAME') ?>
		</label>
		<?php echo $contactForm['firstname'] ?>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_LASTNAME') ?>
		</label>
		<?php echo $contactForm['lastname'] ?>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_COMPANY') ?>
		</label>
		<?php echo $contactForm['Companies_id'] ?>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_TYPE') ?>
		</label>
		<?php echo $contactForm['ContactTypes_id'] ?>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_OFFICE') ?>
		</label>
		<?php echo $contactForm['office'] ?>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_EXT') ?>
		</label>
		<?php echo $contactForm['extension'] ?>
	</div>

	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_MOBILE') ?>
		</label>
		<?php echo $contactForm['mobile'] ?>
	</div>

</div>
<div class="modal-footer">
	<div class="pull-right btn-group">
		<button class="btn-default" ng-click="cancel()">
			<?php echo $this->getString('CANCEL') ?>
		</button>
		<button class="primary" ng-click="submit()">
			<?php echo $this->getString('CONFIRM') ?>
		</button>
	</div>
</div>