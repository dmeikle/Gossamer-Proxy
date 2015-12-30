

<div class="widget" ng-controller="initialJobsheetCtrl">
    <?php echo $claimLocationForm['ClaimsLocations_id'] ?>
    <?php echo $claimLocationForm['Claims_id'] ?>
    <form></form>
    <div id="editPage"></div>
    <div class="widgetheader">
        <h1><?php echo $this->getString('CLAIMS_JOBSHEET') ?></h1>
    </div>
    <div ng-if="loading">
        <span class="spinner-loader"></span>
    </div>
    <!-- PAGE ONE FIELDS -->
    <div ng-if="!loading">
        <div ng-show="jobsheet.isSource"><?php echo $this->getString('CLAIMS_ISSOURCE') ?></div>
        <div><?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>: {{location.workAuthorizationReceived}}</div>
        <div><?php echo $this->getString('CLAIMS_ISPICTURES') ?>: {{location.picturesTaken}}</div>
        <div ng-show="location.lockBoxNumber"><?php echo $this->getString('CLAIMS_LOCKBOX') ?> {{location.lockBoxNumber}}</div>
        <p><?php echo $this->getString('CLAIMS_ISKEYS') ?>: {{location.keysReceivedFrom}}</p>

        <div ng-repeat="contact in contacts">

            <div ng-show="contact.isActive !== '0'">
                <div class="col-xs-12 form-group">
                    <hr />
                </div>
                <div class="col-xs-6 form-group">
                    <a href="mailto:{{contact.email}}">{{contact.firstname}} {{contact.lastname}}</a><br />
                    <?php echo $this->getString('CLAIMS_DAYTIME_PHONE') ?>: {{contact.daytimePhone}}<br />
                    <?php echo $this->getString('CLAIMS_MOBILE_PHONE') ?>: {{contact.mobile}}
                </div>
                <div class="col-xs-6 form-group">
                    <div ng-show="contact.vipType"><?php echo $this->getString('CLAIMS_VIP') ?>: {{contact.vipType}}</div>
                    {{contact.type}}
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>
        <div ng-repeat="area in areaList">
            {{area.areaType}}<br>
        </div>
        <div ng-show="location.existingDamage">
            <h3><?php echo $this->getString('CLAIMS_JOBSHEET_EXISTING') ?>:</h3>

            {{location.existingDamage}}
        </div>
    </div>

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