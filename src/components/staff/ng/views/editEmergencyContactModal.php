<div class="modal-header">
    <h1 ng-if="!contact.id"><?php echo $this->getString('STAFF_EMERGENCY_ADDNEW') ?></h1>
    <h1 ng-if="contact.id"><?php echo $this->getString('STAFF_EDIT') ?> {{contact.firstname}} {{contact.lastname}}</h1>
</div>
<div class="modal-body clearfix">
    <div class="col-xs-12 col-md-6">
        <div class="form-group clearfix">
            <div class="splitcolumn left">
                <label for="contact-firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></label>
                <input class="form-control" type="text" name="firstname"
                       id="contact-firstname" ng-model="ctrl.contact.firstname">
            </div>
            <div class="splitcolumn right">
                <label for="contact-lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></label>
                <input class="form-control" type="text" name="lastname"
                       id="contact-lastname" ng-model="ctrl.contact.lastname">
            </div>
        </div>
        <div class="form-group">
            <label for="contact-relation"><?php echo $this->getString('STAFF_RELATIONSHIP'); ?></label>
            <input class="form-control" type="text" name="relation"
                   id="contact-relation" ng-model="ctrl.contact.relation">
        </div>
        <div class="form-group">
            <label for="contact-email"><?php echo $this->getString('STAFF_EMAIL'); ?></label>
            <input class="form-control" type="text" name="email"
                   id="contact-email" ng-model="ctrl.contact.email">
        </div>
    </div>
    <div class="col-xs-12 col-md-6">
        <div class="form-group">
            <label for="contact-mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></label>
            <input class="form-control" type="text" name="mobile"
                   id="contact-mobile" ng-model="ctrl.contact.mobile">
        </div>
        <div class="form-group">
            <label for="contact-telephone"><?php echo $this->getString('STAFF_TELEPHONE'); ?></label>
            <input class="form-control" type="text" name="telephone"
                   id="contact-telephone" ng-model="ctrl.contact.telephone">
        </div>
        <div class="form-group">
            <label for="contact-workTelephone"><?php echo $this->getString('STAFF_WORK_TELEPHONE'); ?></label>
            <input class="form-control" type="text" name="workTelephone"
                   id="contact-workTelephone" ng-model="ctrl.contact.workTelephone">
        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="pull-right">
        <button class="primary" ng-click="ctrl.save(ctrl.contact)">
            <?php echo $this->getString('STAFF_SAVE'); ?>
        </button>
        <button ng-click="ctrl.close()">
            <?php echo $this->getString('STAFF_CANCEL'); ?>
        </button>
    </div>
</div>
