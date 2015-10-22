


<div class="modal-header" ng-switch="claim.jobNumber">
    <h1 ng-switch-when="undefined" class="modal-title">{{claim.unassignedJobNumber}}</h1>
    <h1 class="modal-title" ng-switch-default>{{claim.jobNumber}}</h1>
    <div class="clearfix"></div>
</div>
<div class="modal-body">
    <div class="cards cards col-md-4">
        <div class="card">
            <h1><?php echo $this->getString('CLAIMS_DETAILS'); ?></h1>
            <div class="form-group">
                <label for="firstname"><?php echo $this->getString('CLAIMS_ADDRESS'); ?></label>
                <?php echo $form['ProjectAddresses_id']; ?>
            </div>
            <div class="form-group">
                <label for="lastname"><?php echo $this->getString('CLAIMS_PARENT'); ?></label>
                <?php echo $form['parentClaims_id']; ?>
            </div>
            <div class="form-group">
                <label for="dob"><?php echo $this->getString('CLAIMS_SOURCE'); ?></label>        
                <?php echo $form['sourceUnitClaimsLocations_id']; ?>
                <?php echo $form['sourceOther']; ?>
            </div>
            <div class="form-group">
                <label for="gender"><?php echo $this->getString('CLAIMS_REASON'); ?></label>        
                <?php echo $form['reason']; ?>
            </div>
            <div class="form-group">
                <label for="gender"><?php echo $this->getString('CLAIMS_CONTENTS_ON_SITE'); ?></label>        
                <?php echo $form['contentsNeeded']; ?>
            </div>
            <div class="form-group">
                <label for="gender"><?php echo $this->getString('CLAIMS_ASBESTOS_TEST'); ?></label>        
                <?php echo $form['asbestosTestRequired']; ?>
            </div>

        </div>
    </div>
    <div class="cards cards col-md-4">
        <div class="card">
            <h1></h1>
            <div class="form-group">
                <label for="personalEmail"><?php echo $this->getString('CLAIMS_CALLED_IN_BY'); ?></label>
                <?php echo $form['calledInBy']; ?>
            </div>
            <div class="form-group">
                <label for="personalMobile"><?php echo $this->getString('CLAIMS_CALLED_IN_PHONE'); ?></label>
                <?php echo $form['calledInPhone']; ?>
            </div>
            <div class="form-group">
                <label for="personalTelephone"><?php echo $this->getString('CLAIMS_CALL_IN_DATE'); ?></label>
                <?php echo $form['callInDate']; ?>
            </div>
            <div class="form-group">
                <label for="telephone"><?php echo $this->getString('CLAIMS_TIME_CALLED_IN'); ?></label>
                <?php echo $form['timeCalledIn']; ?>
            </div>
            <div class="form-group">
                <label for="mobile"><?php echo $this->getString('CLAIMS_DATE_RECEIVED'); ?></label>
                <?php echo $form['dateReceived']; ?>
            </div>
            <div class="form-group">
                <label for="address1"><?php echo $this->getString('CLAIMS_CONTACT_NAME'); ?></label>
                <?php echo $form['contactName']; ?>
            </div>
            <div class="form-group">
                <label for="address2"><?php echo $this->getString('CLAIMS_CONTACT_TELEPHONE'); ?></label>
                <?php echo $form['contactTelephone']; ?>
            </div>
            <div class="form-group">
                <label for="city"><?php echo $this->getString('CLAIMS_POLICY_NUMBER'); ?></label>
                <?php echo $form['policyNumber']; ?>

            </div>
        </div>
    </div>
    <div class="cards cards col-md-4">
        <div class="card">
            <h1></h1>
            <div class="form-group">
                <label for="personalEmail"><?php echo $this->getString('CLAIMS_STATUS'); ?></label>
                <?php echo $form['currentClaimsStatusTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="personalMobile"><?php echo $this->getString('CLAIMS_PHASE'); ?></label>
                <?php echo $form['currentClaimPhases_id']; ?>
            </div>
            <div class="form-group">
                <label for="personalTelephone"><?php echo $this->getString('CLAIMS_CLAIM_TYPE'); ?></label>
                <?php echo $form['ClaimTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="telephone"><?php echo $this->getString('CLAIMS_OTHER'); ?></label>
                <?php echo $form['ClaimTypes_other']; ?>
            </div>
            <div class="form-group">
                <label for="mobile"><?php echo $this->getString('CLAIMS_INSURANCE_CATEGORY'); ?></label>
                <?php echo $form['InsuranceCategories_id']; ?>
            </div>
            <div class="form-group">
                <label for="address1"><?php echo $this->getString('CLAIMS_COMPLETION_DATE'); ?></label>
                <?php echo $form['completionDate']; ?>
            </div>
        </div>

    </div> <div class="clearfix"></div>
    <div class="modal-footer">
        <button class="primary" ng-click="submit(claim)"><?php echo $this->getString('CLAIMS_CONFIRM'); ?></button>

        <button ng-click="close()"><?php echo $this->getString('CLAIMS_CANCEL'); ?></button>
    </div>
