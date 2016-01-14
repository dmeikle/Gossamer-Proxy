<div class="modal-header">
    <h1>
        <?php echo $this->getString('CLAIMS_ADD_LOCATION_CUSTOMER') ?>
    </h1>
</div>
<div class="modal-body">
    <form>
        <uib-tabset>
            <uib-tab heading="<?php echo $this->getString('CLAIMS_SEARCH_EXISTING_CUSTOMERS') ?>" select="modal.createNew = false">
                <div class="padding">
                    <label><?php echo $this->getString('CLAIMS_CONTACT_NAME') ?></label>
                    <?php echo $form['customersAutocomplete']; ?>
                    <div class="padding-vertical">
                        <div ng-if="modal.customer.firstname || modal.customer.lastname"><strong><?php echo $this->getString('CLAIMS_NAME') ?>:</strong> {{modal.customer.firstname}} {{modal.customer.lastname}}</div>
                        <div ng-if="modal.customer.contactType"><strong><?php echo $this->getString('CLAIMS_CONTACT_TYPE') ?>:</strong> {{modal.customer.contactType}}</div>
                        <div ng-if="modal.customer.daytimePhone"><strong><?php echo $this->getString('CLAIMS_LOCATIONS_DAYTIMEPHONE') ?>:</strong> {{modal.customer.daytimePhone}}</div>
                        <div ng-if="modal.customer.office"><strong><?php echo $this->getString('CLAIMS_OFFICE') ?>:</strong> {{modal.customer.office}} <span ng-if="modal.customer.extension">({{modal.item.extension}})</span></div>
                        <div ng-if="modal.customer.mobile"><strong><?php echo $this->getString('CLAIMS_MOBILE') ?>:</strong> {{modal.customer.mobile}}</div>
                        <div ng-if="modal.customer.email"><strong><?php echo $this->getString('CLAIMS_EMAIL') ?>:</strong> {{modal.customer.email}}</div>
                    </div>
                </div>
            </uib-tab>
            <uib-tab heading="<?php echo $this->getString('CLAIMS_CREATE_NEW_CUSTOMER') ?>" select="modal.createNew = true">
                <div class="padding-vertical new-contact-form">
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_FIRSTNAME') ?></label>
                        <?php echo $form['firstname']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_LASTNAME') ?></label>
                        <?php echo $form['lastname']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_PHONE') ?></label>
                        <?php echo $form['daytimePhone']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_MOBILE') ?></label>
                        <?php echo $form['mobile']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_EMAIL') ?></label>
                        <?php echo $form['email']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_BUZZER') ?></label>
                        <?php echo $form['buzzer']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_CONTACT_TYPE') ?></label>
                        <?php echo $form['CustomerType']; ?>
                    </div>
                    <div class="col-md-6 form-group">
                        <label><?php echo $this->getString('CLAIMS_VIP_TYPE') ?></label>
                        <?php echo $form['VIPType']; ?>
                    </div>
                    <div class="col-md-12 form-group">
                        <label><?php echo $this->getString('CLAIMS_NOTES') ?></label>
                        <?php echo $form['notes']; ?>
                    </div>
                </div>
                <div class="clearfix"></div>
            </uib-tab>
        </uib-tabset>
    </form>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <div class="btn-group" role="group">
            <button class="primary" ng-click="modal.save()" ng-if="!modal.createNew">
                <?php echo $this->getString('SAVE') ?>
            </button>
            <button class="primary" ng-click="modal.saveNewCustomer()" ng-if="modal.createNew">
                <?php echo $this->getString('SAVE') ?> New
            </button>
            <button class="default" ng-click="modal.close()">
                <?php echo $this->getString('CLOSE') ?>
            </button>
        </div>
    </div>
</div>
<form></form>