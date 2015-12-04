

<div class="widget" ng-controller="initialJobsheetCtrl">
    <?php echo $claimLocationForm['ClaimsLocations_id'] ?>
    <?php echo $claimLocationForm['Claims_id'] ?>
    <form></form>
    <div id="editPage"></div>
	<div class="widgetheader">
		<h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
	</div>

	<!-- PAGE ONE FIELDS -->
	<div ng-if="loading">
		<span class="spinner-loader"></span>
	</div>
	<div ng-if="!loading">
		<div class="col-xs-6 form-group">
	        <label for="jobsheet-source"><?php echo $this->getString('CLAIMS_SOURCE') ?></label>
	        <label for="jobsheet-is-source">
	            <input type="checkbox" disabled name="jobsheet-is-source" id="jobsheet-is-source" ng-model="jobSheet.isSource">
	            <?php echo $this->getString('CLAIMS_ISSOURCE') ?>
	        </label>
            <p class="form-control-static">
            	{{jobSheet.query.ClaimLocation.source}}
            </p>
	    </div>
	    <div class="col-xs-6 form-group">
	        <label for="jobsheet-is-lockBox">
	            <?php echo $this->getString('CLAIMS_LOCKBOX') ?>
	            <input type="checkbox" disabled id="jobsheet-is-lockBox" ng-model="ClaimLocation.lockBox">
	            <?php echo $this->getString('CLAIMS_ISLOCKBOX') ?>
	        </label>
	        <p class="form-control-static">
	        	{{item.lockBoxNumber}}
	        </p>
	    </div>
	    <div class="col-xs-6 form-group">
	        <div class="input-group">
	            <label for="ClaimLocation_workAuthorizationReceived">
	                <input type="checkbox" disabled name="ClaimLocation[workAuthorizationReceived]" 
	                ng-model="item.workAuthorizationReceived" required ng-true-value="'1'"
	                id="ClaimLocation_workAuthorizationReceived">
	                <?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>
	            </label>
	        </div>
	    </div>
	    <div class="col-xs-6 form-group">
	        <div>
	            <label for="ClaimLocation_picturesTaken">
	                <input type="checkbox" disabled name="ClaimLocation[picturesTaken]" 
	                ng-model="item.picturesTaken" id="ClaimLocation_picturesTaken"
	                ng-true-value="'1'">
	                <?php echo $this->getString('CLAIMS_ISPICTURES') ?>
	            </label>
	        </div>
	    </div>
	    <div class="col-xs-6 form-group">
	        <label for="jobsheet-is-keys">
	            <?php echo $this->getString('CLAIMS_KEYS') ?>
	            <input type="checkbox" disabled name="jobsheet-is-keys" id="jobsheet-is-keys" ng-model="ClaimLocation.keysReceived">
	            <?php echo $this->getString('CLAIMS_ISKEYS') ?>
	        </label>
	        <p class="form-control-static">
	        	{{item.keysReceivedFrom}}
	        </p>
	    </div>
		<div class="clearfix"></div>
	    <!-- PAGE TWO FIELDS -->

	    <div ng-repeat="contact in jobSheet.query.contacts">
            <div ng-show="contact.isActive !== '0'">
                <div class="col-xs-12 form-group">
                    <hr />
                </div>
                <div class="col-xs-12 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_OWNERTENANT') ?>
                		<input type="checkbox" id="Contact_isPrimary" ng-model="contact.isPrimary" disabled>
                		<?php echo $this->getString('CLAIMS_PRIMARY_CONTACT') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.type}}
                    </p>
                </div>
                <div class="col-xs-3 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_FIRSTNAME') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.firstname}}
                    </p>
                </div>
                <div class="col-xs-3 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_LASTNAME') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.lastname}}
                    </p>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_VIP') ?>
                    </label>
					<p class="form-control-static">
						{{contact.vipType}}
					</p>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_DAYPHONE') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.daytimePhone}}
                    </p>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_MOBILEPHONE') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.mobile}}
                    </p>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_BUZZER') ?>
                    </label>
                    <p class="form-control-static">
                    	{{contact.buzzer}}
                    </p>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_EMAIL') ?>
                    </label>
                    <p class="form-control-static">
                    	<a href="mailto:{{contact.email}}">{{contact.email}}</a>
                    </p>
                </div>
            </div>
	    </div>
		<div class="clearfix"></div>
	    <!-- PAGE THREE FIELDS -->

	    <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>
	    <div class="col-xs-12 col-md-4">
	        <div>
	            <label for="jobsheet-entry">
	                <input type="checkbox" disabled name="jobsheet-entry" id="jobsheet-entry"
	                       ng-model="jobSheet.query.affectedAreas.entry">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_ENTRY') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-closet">
	                <input type="checkbox" disabled name="jobSheet-closet" id="jobSheet-closet"
	                       ng-model="jobSheet.query.affectedAreas.closet">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_CLOSET') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-hallway">
	                <input type="checkbox" disabled name="jobSheet-hallway" id="jobSheet-hallway"
	                       ng-model="jobSheet.query.affectedAreas.hallway">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_HALLWAY') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-kitchen">
	                <input type="checkbox" disabled name="jobSheet-kitchen" id="jobSheet-kitchen"
	                       ng-model="jobSheet.query.affectedAreas.kitchen">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_KITCHEN') ?>
	            </label>
	        </div>
	    </div>


	    <div class="col-xs-12 col-md-4">
	        <div>
	            <label for="jobsheet-livingroom">
	                <input type="checkbox" disabled name="jobsheet-livingroom" id="jobsheet-livingroom"
	                       ng-model="jobSheet.query.affectedAreas.livingroom">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_LIVINGROOM') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-diningroom">
	                <input type="checkbox" disabled name="jobSheet-diningroom" id="jobSheet-diningroom"
	                       ng-model="jobSheet.query.affectedAreas.diningroom">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_DININGROOM') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-bathroom1">
	                <input type="checkbox" disabled name="jobSheet-bathroom1" id="jobSheet-bathroom1"
	                       ng-model="jobSheet.query.affectedAreas.bathroom1">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM1') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-bathroom2">
	                <input type="checkbox" disabled name="jobSheet-bathroom2" id="jobSheet-bathroom2"
	                       ng-model="jobSheet.query.affectedAreas.bathroom2">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM2') ?>
	            </label>
	        </div>
	    </div>


	    <div class="col-xs-12 col-md-4">
	        <div>
	            <label for="jobsheet-masterBed">
	                <input type="checkbox" disabled name="jobsheet-masterBed" id="jobsheet-masterBed"
	                       ng-model="jobSheet.query.affectedAreas.masterBed">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_MASTERBED') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobsheet-bedroom1">
	                <input type="checkbox" disabled name="jobsheet-bedroom1" id="jobsheet-bedroom1"
	                       ng-model="jobSheet.query.affectedAreas.bedroom1">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_BEDROOM1') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobsheet-den">
	                <input type="checkbox" disabled name="jobsheet-den" id="jobsheet-den"
	                       ng-model="jobSheet.query.affectedAreas.den">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_DEN') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-laundry">
	                <input type="checkbox" disabled name="jobSheet-laundry" id="jobSheet-laundry"
	                       ng-model="jobSheet.query.affectedAreas.laundry">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_LAUNDRY') ?>
	            </label>
	        </div>
	        <div>
	            <label for="jobSheet-is-other">
	                <input type="checkbox" disabled name="jobSheet-is-other" id="jobSheet-is-other"
	                       ng-model="jobSheet.query.affectedAreas.isOther">
	                       <?php echo $this->getString('CLAIMS_JOBSHEET_OTHER') ?>
	            </label>
	            <input type="text" class="form-control" ng-disabled="!jobSheet.isOther"
	                   ng-required="jobSheet.isOther" ng-model="jobSheet.query.affectedAreas.other">
	        </div>
	    </div>
	    <div class="clearfix"></div>
	    <div class="col-xs-12">
	        <label for="jobsheet-is-asbestos">
	            <input type="checkbox" disabled name="jobsheet-is-asbestos" id="jobsheet-is-asbestos"
	                   ng-model="jobSheet.isAsbestos">
	                   <?php echo $this->getString('CLAIMS_JOBSHEET_ASBESTOS') ?>
	        </label>
	        <input type="text" class="form-control" ng-disabled="!jobSheet.isAsbestos"
	               ng-required="jobSheet.isAsbestos" ng-model="jobSheet.query.affectedAreas.asbestosSample">
	    </div>
	    <div class="col-xs-12">
	        <label for="jobsheet-existing">
	            <input type="checkbox" disabled name="jobsheet-isexisting" id="jobsheet-isexisting"
	                   ng-model="jobSheet.isExisting">
	                   <?php echo $this->getString('CLAIMS_JOBSHEET_EXISTING') ?>
	        </label>
        	<textarea name="jobsheet-existing" id="jobsheet-existing" class="form-control"
            	ng-disabled="!jobSheet.isExisting" ng-required="jobSheet.isExisting" rows="8" cols="40"
            	ng-model="jobSheet.query.affectedAreas.existing"></textarea>
	    </div>
		<div class="clearfix"></div>
	    <!-- EQUIPMENT PAGE -->
	    <table class="table">
	        <tbody>
	            <?php
	            $equipment = $this->getValue('InventoryEquipment');
	            foreach ($equipment as $eq) {
	                ?>
	                <tr>
	                    <td>
	                        <strong><?php echo $eq['inventoryType']; ?></strong>
	                    </td>
	                    <td>
	                        <?php echo $eq['numItems']; ?>
	                    </td>
	                </tr>
	            <?php } ?>
	        </tbody>
	    </table>
	</div>
	
    <div class="clearfix"></div>
</div>