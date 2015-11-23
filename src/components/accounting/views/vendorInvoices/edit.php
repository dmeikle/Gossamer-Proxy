
<div ng-controller="vendorInvoicesEditCtrl">
    <div class="widget" >
        <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
            <h1 ng-if="!editing"><?php echo $this->getString('ACCOUNTING_NEW_VENDOR_INVOICE') ?></h1>
            <h1 ng-if="editing"><?php echo $this->getString('ACCOUNTING_EDIT_VENDOR_INVOICE') ?></h1>
            <div ng-if="loading" class="col-md-12 form-headings"><span class="spinner-loader"></span></div>
            <div ng-if="!loading" class="col-md-4 form-headings">
                <div class="form-group">
                    <label for="purchaseOrdersAutocomplete" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_PURCHASE_ORDER'); ?></label>
                    <?php echo $form['purchaseOrdersAutocomplete']; ?>
                </div>

                <div class="form-group">
                    <label for="invoiceNumber" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_INVOICE_NUMBER'); ?></label>
                    <?php echo $form['invoiceNumber']; ?>
                </div>

                <div class="form-group">
                    <label for="jobNumber" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_JOB_NUMBER'); ?></label>
                    <?php echo $form['jobNumber']; ?>
                    <!--                    <div class="resultspane claim-number form-builder col-md-5" ng-show="noResultsClaim">
                                            <i class="glyphicon glyphicon-remove"></i> <?php // echo $this->getString('ACCOUNTING_NO_RESULTS')                                   ?>
                                        </div>-->
                </div>

                <div class="form-group">
                    <label for="ClaimPhases_id" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_PHASE'); ?></label>
                    <?php echo $form['ClaimPhases_id']; ?>
                </div>

                <div class="form-group">
                    <label for="Departments_id" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_DEPARTMENT'); ?></label>
                    <?php echo $form['Departments_id']; ?>
                </div>

            </div>

            <div ng-if="!loading" class="col-md-4 form-headings">
                <div class="input-group form-group">
                    <label for="creationDate" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_DATE'); ?></label>
                    <div class="col-md-7 no-padding">

                        <input type="date" name="date" ng-model="item.entryDate" ng-model-options="{timezone: '+0000'}"
                               class="form-control datepicker" datepicker-popup is-open="isOpen.datepicker"
                               datepicker-options="dateOptions" close-text="<?php echo $this->getString('ACCOUNTING_CLOSE'); ?>"/>
                        <span class="input-group-btn" data-datepickername="date">
                            <button type="button" class="btn-default" data-datepickername="date" ng-click="openDatepicker($event)">
                                <i class="glyphicon glyphicon-calendar"></i>
                            </button>
                        </span>
                    </div>

                    <div class="clearfix"></div>
                </div>

                <div class="form-group">
                    <label for="vendorsAutocomplete" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_VENDOR'); ?></label>
                    <?php echo $form['vendorsAutocomplete']; ?>
                </div>

                <div class="form-group">
                    <label for="subcontractorsAutocomplete" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_SUBCONTRACTOR'); ?></label>
                    <?php echo $form['subcontractorsAutocomplete']; ?>
                </div>

                <div class="form-group">
                    <label for="AccountingPaymentMethods_id" class="heading-label col-md-5"><?php echo $this->getString('ACCOUNTING_PAYMENT_METHOD'); ?></label>
                    <?php echo $form['AccountingPaymentMethods_id']; ?>
                </div>

                <div class="form-group description">
                    <label for="description" class="col-md-5"><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></label>
                    <?php echo $form['description']; ?>
                </div>
            </div>

            <div ng-if="!loading" class="col-md-4 form-headings">

                <div dropzone="dropzoneConfig" class="dropzone">
                    <p class="text-center">
                        <?php echo $this->getString('ACCOUNTING_UPLOAD_INVOICE'); ?>
                    </p>
                </div>
                <p>
                    <?php echo $this->getString('ACCOUNTING_ATTACHED_INVOICE'); ?>: {{item.filename}}
                </p>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
    <div class="widget" >
        <div class="widget-content">
            <div class="form-items">
                <button class="btn-info" ng-click="addRow()"><?php echo $this->getString('ACCOUNTING_NEW_ROW'); ?></button>
                <button class="btn-info" ng-click="insertRows()" ng-disabled="!rowSelected"><?php echo $this->getString('ACCOUNTING_INSERT_ROWS'); ?></button>
                <button class="btn-warning" ng-click="removeRows();
                            updateSubtotal()" ng-disabled="!rowSelected"><?php echo $this->getString('ACCOUNTING_DELETE_ROWS'); ?></button>
                <!--<p><?php // echo $this->getString('ACCOUNTING_UNASSOCIATE_ITEMS');   ?><input class="checkbox" type="checkbox" ng-model="unassociated"></p>-->
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="select-col" ng-click="selectAllToggle(selectAll)"><input class="select-all checkbox" type="checkbox" ng-model="selectAll"></th>
                            <!--<th><?php // echo $this->getString('ACCOUNTING_STAFF_NAME');   ?></th>-->
                            <th><?php echo $this->getString('ACCOUNTING_PRODUCT_CODE'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_PRODUCT_NAME'); ?></th>
                            <th><?php echo $this->getString('ACCOUNTING_DESCRIPTION'); ?></th>
                            <th class="number-col"><?php echo $this->getString('ACCOUNTING_QUANTITY'); ?></th>
                            <th class="number-col"><?php echo $this->getString('ACCOUNTING_PRICE'); ?></th>
                            <th class="number-col"><?php echo $this->getString('ACCOUNTING_TAX_PERCENT'); ?></th>
                            <th class="number-col"><?php echo $this->getString('ACCOUNTING_AMOUNT'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-if="loading">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="spinner-loader"></span>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="row in lineItems track by $index">
                            <td class="select-col"><input class="checkbox" type="checkbox" ng-model="row.isSelected" ng-click="checkSelected(row.selected)"></td>
                            <!--<td><?php // echo $form['staffName'];  ?></td>-->
                            <td><?php echo $form['productCode']; ?></td>
                            <td><?php echo $form['productName']; ?></td>
                            <td><?php echo $form['productDescription']; ?></td>
                            <td><?php echo $form['quantity']; ?></td>
                            <td><?php echo $form['unitPrice']; ?></td>
                            <td><?php echo $form['taxType']; ?></td>
                            <td class="total">{{row.amount| currency}}</td>
                        </tr>
<!--                        <tr ng-if="unassociated">
                            <td colspan="9" class="alert-warning"><?php // echo $this->getString('ACCOUNTING_UNASSOCIATED_WARNING');   ?></td>
                        </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div ng-if="loading" class="col-md-2 form-totals col-md-offset-10">
        <div class="widget">
            <div class="widget-content">
                <span class="spinner-loader"></span>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <div ng-if="!loading" class="col-md-2 form-totals col-md-offset-10">

        <div class="widget">
            <div class="widget-content">
                <div class="form-group">
                    <label for="subtotal" class="col-md-6"><?php echo $this->getString('ACCOUNTING_SUBTOTAL'); ?></label>
                    <p class="col-md-6">{{item.subtotal| currency}}</p>
                </div>

                <div class="form-group" ng-repeat="tax in item.taxTypes">
                    <label for="tax" class="col-md-6">{{tax.type}}</label>
                    <p class="col-md-6">{{tax.total| currency}}</p>
                </div>

                <div class="form-group">
                    <label for="total" class="col-md-6"><?php echo $this->getString('ACCOUNTING_TOTAL'); ?></label>
                    <p class="col-md-6">{{item.total| currency}}</p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
        <button class="btn-primary save-purchase-order" ng-click="save()"><?php echo $this->getString('ACCOUNTING_SAVE'); ?></button>

    </div>
</div>
<form></form>