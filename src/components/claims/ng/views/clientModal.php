<div class="modal-header">
	<h1 ng-if="!contact.id">
		<?php echo $this->getString('CLAIMS_NEW_CLIENT') ?>
	</h1>
	<div ng-if="contact.id" class="clearfix">
		<h1 class="pull-left">
			<?php echo $this->getString('EDIT') ?> 
			{{contact.firstname}} {{contact.lastname}}
		</h1>
		<div class="pull-right">
			<button class="btn-default" ng-click="remove(contact)">
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
		<input type="text" ng-model="contact" 
		uib-typeahead="contact as contact.firstname for contact in firstnameAutocomplete($viewValue)"
		typeahead-loading="loadingFirstname" typeahead-no-results="noFirstnameResults"class="form-control"
		typeahead-min-length="3">
		<div ng-show="noFirstnameResults">
	      <i class="glyphicon glyphicon-remove"></i>
	    </div>
	</div>
	<div class="form-group col-xs-6">
		<label for="">
			<?php echo $this->getString('CLAIMS_CONTACT_LASTNAME') ?>
		</label>
		<input type="text" ng-model="contact" 
		uib-typeahead="contact as contact.lastname for contact in lastnameAutocomplete($viewValue)"
		typeahead-loading="loadingLastname" typeahead-no-results="noLastnameResults"class="form-control"
		typeahead-min-length="3">
		<div ng-show="noLastnameResults">
	      <i class="glyphicon glyphicon-remove"></i>
	    </div>
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
	<form></form>
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