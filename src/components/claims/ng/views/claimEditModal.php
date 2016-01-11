<div class="modal-header" ng-switch="claim.jobNumber">

    <h1>
        <?php echo $this->getString('CLAIMS_DETAILS'); ?>
        <span ng-switch-when="undefined" class="modal-title">{{claim.unassignedJobNumber}}</span>
        <span class="modal-title" ng-switch-default>{{claim.jobNumber}}</span>
    </h1>
    <div class="clearfix"></div>
</div>
<div class="modal-body">
    <div class="col-md-4">
        <div>
            <div class="form-group">
                <label for="Claim_parentClaims_id"><?php echo $this->getString('CLAIMS_PARENT'); ?></label>
                <?php echo $form['parentClaims_id']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_sourceUnitClaimsLocations_id"><?php echo $this->getString('CLAIMS_SOURCE'); ?></label>
                {{claim.unitNumber}}
            </div>
            <div class="form-group">
                <label for="Claim_sourceOther"><?php echo $this->getString('CLAIMS_SOURCEOTHER') ?></label>
                <?php echo $form['sourceOther']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_reason"><?php echo $this->getString('CLAIMS_REASON'); ?></label>
                <?php echo $form['reason']; ?>
            </div>
            <div class="form-group">
                <label ng-show="claim.contentsNeeded == '1'" for="Claim_contentsNeeded"><?php echo $this->getString('CLAIMS_CONTENTS_ON_SITE'); ?></label>

            </div>
            <div class="form-group">
                <label ng-show="claim.asbestosTestRequired" for="Claim_asbestosTestRequired"><?php echo $this->getString('CLAIMS_ASBESTOS_TEST'); ?></label>

            </div>

        </div>
    </div>
    <div class="col-md-4">
        <div>
            <div class="form-group">
                <label for="Claim_calledInBy"><?php echo $this->getString('CLAIMS_CALLED_IN_BY'); ?></label>
                <?php echo $form['calledInBy']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_calledInPhone"><?php echo $this->getString('CLAIMS_CALLED_IN_PHONE'); ?></label>
                <?php echo $form['calledInPhone']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_contactName"><?php echo $this->getString('CLAIMS_CONTACT_NAME'); ?></label>
                <?php echo $form['contactName']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_contactTelephone"><?php echo $this->getString('CLAIMS_CONTACT_TELEPHONE'); ?></label>
                <?php echo $form['contactTelephone']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_policyNumber"><?php echo $this->getString('CLAIMS_POLICY_NUMBER'); ?></label>
                <?php echo $form['policyNumber']; ?>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div>
            <div class="form-group">
                <label for="Claim_currentClaimsStatusTypes_id"><?php echo $this->getString('CLAIMS_STATUS'); ?></label>
                <?php echo $form['currentClaimsStatusTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_currentClaimPhases_id"><?php echo $this->getString('CLAIMS_PHASE'); ?></label>
                <?php echo $form['currentClaimPhases_id']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_ClaimTypes_id"><?php echo $this->getString('CLAIMS_CLAIM_TYPE'); ?></label>
                <?php echo $form['ClaimTypes_id']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_ClaimTypes_other"><?php echo $this->getString('CLAIMS_OTHER'); ?></label>
                <?php echo $form['ClaimTypes_other']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_InsuranceCategories_id"><?php echo $this->getString('CLAIMS_INSURANCE_CATEGORY'); ?></label>
                <?php echo $form['InsuranceCategories_id']; ?>
            </div>
            <div class="form-group">
                <label for="Claim_completionDate"><?php echo $this->getString('CLAIMS_COMPLETION_DATE'); ?></label>
                <div class="input-group">
                    <?php echo $form['completionDate']; ?>
                    <span class="input-group-btn" data-datepickername="completionDate">
                        <button class="btn-default" ng-click="openDatepicker($event)" data-datepickername="completionDate">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </button>
                    </span>

                </div>
            </div>
        </div>

    </div> <div class="clearfix"></div>
    <div class="modal-footer">
        <div class="btn-group">
            <button class="primary" ng-click="submit(claim)"><?php echo $this->getString('SAVE'); ?></button>

            <button ng-click="cancel()"><?php echo $this->getString('CLAIMS_CANCEL'); ?></button>
        </div>
    </div>
