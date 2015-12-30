

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
        <div class="col-xs-4 form-group">
            <div class="input-group">
                <label for="ClaimLocation_workAuthorizationReceived">
                    <input type="checkbox" name="ClaimLocation[workAuthorizationReceived]"
                           ng-model="location.workAuthorizationReceived" required ng-true-value="'1'"
                           id="ClaimLocation_workAuthorizationReceived">
                           <?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>
                </label>
            </div>
        </div>
        <div class="col-xs-4 form-group">
            <label for="jobSheet-is-source">
                <input type="checkbox" name="jobSheet-is-source" id="jobSheet-is-source" ng-value="location.id" ng-model="claim.sourceUnitClaimsLocations_id"> <?php echo $this->getString('CLAIMS_ISSOURCE') ?>
            </label>

        </div>
        <div class="col-xs-4 form-group">
            <div>
                <label for="ClaimLocation_picturesTaken">
                    <input type="checkbox" name="ClaimLocation[picturesTaken]"
                           ng-model="location.picturesTaken" id="ClaimLocation_picturesTaken"
                           ng-true-value="'1'">
                           <?php echo $this->getString('CLAIMS_ISPICTURES') ?>
                </label>
            </div>
        </div><div class="col-xs-6 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_BUZZER') ?>
            </label>
            <?php echo $claimLocationForm['buzzerCode'] ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-6 form-group">

            <div>
                <?php echo $this->getString('CLAIMS_ISLOCKBOX') ?>
                <?php echo $claimLocationForm['lockBoxNumber'] ?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-6 form-group">
            <div>
                <?php echo $this->getString('CLAIMS_ISKEYS') ?>
                <?php echo $claimLocationForm['keysReceivedFrom'] ?>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- PAGE TWO FIELDS -->
        <div class="toolbar">
            <a href="" class="btn btn-default" ng-click="addOwnerTenant()">
                <?php echo $this->getString('NEW') ?>
            </a>
        </div>

        <div ng-repeat="contact in contacts">
            <div ng-show="contact.isActive !== '0'">
                <div class="col-xs-12 form-group">
                    <hr />
                </div>
                <div class="col-xs-11 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_OWNERTENANT') ?>
                    </label>
                    <div style="float:right">
                        <input type="checkbox" id="Contact_isPrimary" ng-checked="contact.isPrimary == '1'" ng-model="contact.isPrimary" ng-true-value="1"
                               ng-false-value="0">
                               <?php echo $this->getString('CLAIMS_PRIMARY_CONTACT') ?>
                    </div>
                    <?php echo $contactForm['CustomerTypes_id'] ?>
                </div>
                <div class="col-xs-1">
                    <div class="pull-right">
                        <button ng-click="removeOwnerTenant($event, $index)" class="btn-link">
                            <span class="glyphicon glyphicon-remove"></span>
                        </button>
                    </div>
                </div>
                <div class="col-xs-3 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_FIRSTNAME') ?>
                    </label>
                    <?php echo $contactForm['firstname'] ?>
                </div>
                <div class="col-xs-3 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_LASTNAME') ?>
                    </label>
                    <?php echo $contactForm['lastname'] ?>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_VIP') ?>
                    </label>
                    <?php echo $contactForm['ContactVIPTypes_id'] ?>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_DAYTIME_PHONE') ?>
                    </label>
                    <?php echo $contactForm['daytimePhone'] ?>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_MOBILE_PHONE') ?>
                    </label>
                    <?php echo $contactForm['mobile'] ?>
                </div>
                <div class="col-xs-6 form-group">
                    <label>
                        <?php echo $this->getString('CLAIMS_EMAIL') ?>
                    </label>
                    <?php echo $contactForm['email'] ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <!-- PAGE THREE FIELDS -->

        <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>
        <div class="col-xs-12 col-md-4">
            <div>
                <label for="jobSheet-entry">
                    <input type="checkbox" name="jobSheet-entry" id="jobSheet-entry"
                           ng-model="jobSheet.affectedAreas[1]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_ENTRY') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-closet">
                    <input type="checkbox" name="jobSheet-closet" id="jobSheet-closet"
                           ng-model="jobSheet.affectedAreas[2]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_CLOSET') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-hallway">
                    <input type="checkbox" name="jobSheet-hallway" id="jobSheet-hallway"
                           ng-model="jobSheet.affectedAreas[3]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_HALLWAY') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-kitchen">
                    <input type="checkbox" name="jobSheet-kitchen" id="jobSheet-kitchen"
                           ng-model="jobSheet.affectedAreas[4]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_KITCHEN') ?>
                </label>
            </div>
        </div>


        <div class="col-xs-12 col-md-4">
            <div>
                <label for="jobSheet-livingroom">
                    <input type="checkbox" name="jobSheet-livingroom" id="jobSheet-livingroom"
                           ng-model="jobSheet.affectedAreas[5]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_LIVINGROOM') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-diningroom">
                    <input type="checkbox" name="jobSheet-diningroom" id="jobSheet-diningroom"
                           ng-model="jobSheet.affectedAreas[6]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_DININGROOM') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-bathroom1">
                    <input type="checkbox" name="jobSheet-bathroom1" id="jobSheet-bathroom1"
                           ng-model="jobSheet.affectedAreas[7]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM1') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-bathroom2">
                    <input type="checkbox" name="jobSheet-bathroom2" id="jobSheet-bathroom2"
                           ng-model="jobSheet.affectedAreas[8]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM2') ?>
                </label>
            </div>
        </div>


        <div class="col-xs-12 col-md-4">
            <div>
                <label for="jobSheet-masterBed">
                    <input type="checkbox" name="jobSheet-masterBed" id="jobSheet-masterBed"
                           ng-model="jobSheet.affectedAreas[9]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_MASTERBED') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-bedroom1">
                    <input type="checkbox" name="jobSheet-bedroom1" id="jobSheet-bedroom1"
                           ng-model="jobSheet.affectedAreas[10]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_BEDROOM1') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-den">
                    <input type="checkbox" name="jobSheet-den" id="jobSheet-den"
                           ng-model="jobSheet.affectedAreas[11]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_DEN') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-laundry">
                    <input type="checkbox" name="jobSheet-laundry" id="jobSheet-laundry"
                           ng-model="jobSheet.affectedAreas[12]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_LAUNDRY') ?>
                </label>
            </div>
            <div>
                <label for="jobSheet-is-other">
                    <input type="checkbox" name="jobSheet-is-other" id="jobSheet-is-other"
                           ng-model="jobSheet.affectedAreas[13]">
                           <?php echo $this->getString('CLAIMS_JOBSHEET_OTHER') ?>
                </label>
                <input type="text" class="form-control"
                       ng-model="jobSheet.affectedAreas.other">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12" ng-show="claim.asbestosTestRequired">
            <label for="jobSheet-is-asbestos">
                <input type="checkbox" name="jobSheet-is-asbestos" id="jobSheet-is-asbestos"
                       ng-model="jobSheet.isAsbestos">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_ASBESTOS') ?>
            </label>

        </div>
        <div class="col-xs-12">
            <label for="jobSheet-existing">
                <?php echo $this->getString('CLAIMS_JOBSHEET_EXISTING') ?>
            </label>
            <?php echo $claimLocationForm['existingDamage'] ?>

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
    <div class="widgetfooter">
        <div class="btn-group pull-right">
            <button class="btn-default" ng-click="reset()">
                <?php echo $this->getString('RESET') ?>
            </button>
            <button class="primary" ng-click="finish()">
                <?php echo $this->getString('SAVE') ?>
            </button>
        </div>
        <div class="clearfix"></div>
    </div>
</div>