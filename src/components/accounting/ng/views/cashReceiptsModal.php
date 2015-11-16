<!-- Cash Receipts Modal -->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close" ng-click="cancel()"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">
        <span ng-if="newItem"><?php echo $this->getString('ACCOUNTING_NEW'); ?></span>
        <span ng-if="!newItem"><?php echo $this->getString('ACCOUNTING_EDIT'); ?></span>
        <?php echo $this->getString('ACCOUNTING_CASH_RECEIPT'); ?></h4>
</div>
<div class="modal-body">
    <div class="cards col-md-12">
        <div>
            <div class="form-group col-md-12">
                <label for="companiesAutocomplete"><?php echo $this->getString('ACCOUNTING_PAYER'); ?></label>
                <?php echo $form['companiesAutocomplete']; ?>
            </div>

            <div class="form-group col-md-6">
                <label for="chequeNumber"><?php echo $this->getString('ACCOUNTING_CHEQUE_REFERNCE_NUMBER'); ?></label>
                <?php echo $form['chequeNumber']; ?>
            </div>

            <div class="form-group col-md-6">
                <div class="input-group">
                    <label><?php echo $this->getString('ACCOUNTING_DATE'); ?></label>
                    <input type="date" name="date" ng-model="item.dateReceived" ng-model-options="{timezone: '+0000'}"
                           class="form-control datepicker" uib-datepicker-popup is-open="isOpen.datepicker"
                           datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>" />
                    <span class="input-group-btn" data-datepickername="date">
                        <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event, $index)">
                            <i class="glyphicon glyphicon-calendar"></i>
                        </button>
                    </span>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label for="invoicesAutocomplete"><?php echo $this->getString('ACCOUNTING_INVOICE'); ?></label>
                <?php echo $form['invoicesAutocomplete']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="receiptType"><?php echo $this->getString('ACCOUNTING_RECEIPT_TYPE'); ?></label>
                <?php echo $form['receiptType']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="jobNumber"><?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?></label>
                <?php echo $form['jobNumber']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="ClaimPhases_id"><?php echo $this->getString('ACCOUNTING_PHASE'); ?></label>
                <?php echo $form['ClaimPhases_id']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="DebitAccounts_id"><?php echo $this->getString('ACCOUNTING_DEBIT_ACCOUNTS'); ?></label>
                <?php echo $form['DebitAccounts_id']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="CreditAccounts_id"><?php echo $this->getString('ACCOUNTING_CREDIT_ACCOUNTS'); ?></label>
                <?php echo $form['CreditAccounts_id']; ?>
            </div>
            <div class="form-group col-md-12">
                <label for="AccountingPaymentMethods_id"><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?></label>
                <?php echo $form['AccountingPaymentMethods_id']; ?>
            </div>
            <div class="col-md-12 divider"></div>
            <div class="form-group col-md-6">
                <label for="amount"><?php echo $this->getString('ACCOUNTING_AMOUNT'); ?></label>
                <?php echo $form['amount']; ?>
            </div>
            <div class="form-group col-md-6">
                <label for="outstandingAmount"><?php echo $this->getString('ACCOUNTING_OUTSTANDING_AMOUNT'); ?></label>
                <?php echo $form['outstandingAmount']; ?>
            </div>
            <div class="form-group col-md-12">
                <label for="description"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></label>
                <?php echo $form['description']; ?>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal-footer">
    <button ng-click="cancel()"><?php echo $this->getString('ACCOUNTING_CANCEL'); ?></button>
    <button class="primary" ng-click="save(item);
        clear()"><?php echo $this->getString('ACCOUNTING_SAVE_AND_NEW'); ?></button>
    <button class="primary" ng-click="save(item);
        confirm()"><?php echo $this->getString('ACCOUNTING_SAVE_AND_CLOSE'); ?></button>
</div>