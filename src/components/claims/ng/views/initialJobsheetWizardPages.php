
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 0">
    <?php echo $claimLocationForm['id'] ?>
    <?php echo $claimLocationForm['Claims_id'] ?>
    <div class="col-xs-6 form-group">
        <label for="jobsheet-source"><?php echo $this->getString('CLAIMS_SOURCE') ?></label>
        <label for="jobsheet-is-source">
            <input type="checkbox" name="jobsheet-is-source" id="jobsheet-is-source" ng-model="jobSheet.isSource">
            <?php echo $this->getString('CLAIMS_ISSOURCE') ?>
        </label>
        <input type="text" name="jobsheet-source" id="jobsheet-source" class="form-control"
               ng-model="jobSheet.query.ClaimLocation.source" ng-disabled="!jobSheet.isSource"
               ng-required="jobSheet.isSource">
    </div>
    <div class="col-xs-6 form-group">
        <label for="jobsheet-is-lockBox">
            <?php echo $this->getString('CLAIMS_LOCKBOX') ?>
            <input type="checkbox" id="jobsheet-is-lockBox" ng-model="ClaimLocation.lockBox">
            <?php echo $this->getString('CLAIMS_ISLOCKBOX') ?>
        </label>
        <?php echo $claimLocationForm['lockBoxNumber'] ?>
    </div>
    <div class="col-xs-6 form-group">
        <div class="input-group">
            <label for="ClaimLocation_workAuthorization">
                <?php echo $claimLocationForm['workAuthorizationReceived'] ?>
                <?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?>
            </label>
        </div>
    </div>
    <div class="col-xs-6 form-group">
        <div>
            <label for="ClaimLocation_picturesTaken">
                <?php echo $claimLocationForm['picturesTaken'] ?>
                <?php echo $this->getString('CLAIMS_ISPICTURES') ?>
            </label>
        </div>
    </div>
    <div class="col-xs-6 form-group">
        <label for="jobsheet-is-keys">
            <?php echo $this->getString('CLAIMS_KEYS') ?>
            <input type="checkbox" name="jobsheet-is-keys" id="jobsheet-is-keys" ng-model="ClaimLocation.keysReceived">
            <?php echo $this->getString('CLAIMS_ISKEYS') ?>
        </label>
        <?php echo $claimLocationForm['keysReceivedFrom'] ?>
    </div>
    <div class="clearfix"></div>
    <div class="widgetfooter clearfix">
        <div class="pull-right btn-group">
            <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
                <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
            </button>
        </div>
    </div>
</form>
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 1">
    <div class="toolbar">
        <a href="" class="btn btn-default" ng-click="addOwnerTenant()">
            <?php echo $this->getString('NEW') ?>
        </a>
    </div>
    <div ng-repeat="contact in jobSheet.query.contacts">
        <div class="col-xs-10 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_OWNERTENANT') ?>
            </label>
            <?php echo $contactForm['ContactTypes_id'] ?>
        </div>
        <div class="col-xs-2">
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
                <?php echo $this->getString('CLAIMS_HOMEPHONE') ?>
            </label>
            <?php echo $contactForm['home'] ?>
        </div>
        <div class="col-xs-6 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_MOBILEPHONE') ?>
            </label>
            <?php echo $contactForm['mobile'] ?>
        </div>
        <div class="col-xs-6 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_WORKPHONE') ?>
            </label>
            <?php echo $contactForm['office'] ?>
        </div>
        <div class="col-xs-6 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_BUZZER') ?>
            </label>
            <input type="tel" ng-model="contact.buzzer" class="form-control" name="buzzer" id="buzzer{{$index}}">
        </div>
        <div class="col-xs-6 form-group">
            <label>
                <?php echo $this->getString('CLAIMS_EMAIL') ?>
            </label>
            <?php echo $contactForm['email'] ?>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="widgetfooter clearfix">
        <div class="pull-right btn-group">
            <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
                <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
            </button>
        </div>
    </div>
</form>
<form id="wizard-form" name="wizard-form" ng-submit="nextPage()" ng-show="currentPage === 2">
    <h3><?php echo $this->getString('CLAIMS_AFFECTEDAREAS') ?></h3>
    <div class="col-xs-12 col-md-4">
        <div>
            <label for="jobsheet-entry">
                <input type="checkbox" name="jobsheet-entry" id="jobsheet-entry"
                       ng-model="jobSheet.query.affectedAreas.entry">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_ENTRY') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-closet">
                <input type="checkbox" name="jobSheet-closet" id="jobSheet-closet"
                       ng-model="jobSheet.query.affectedAreas.closet">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_CLOSET') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-hallway">
                <input type="checkbox" name="jobSheet-hallway" id="jobSheet-hallway"
                       ng-model="jobSheet.query.affectedAreas.hallway">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_HALLWAY') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-kitchen">
                <input type="checkbox" name="jobSheet-kitchen" id="jobSheet-kitchen"
                       ng-model="jobSheet.query.affectedAreas.kitchen">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_KITCHEN') ?>
            </label>
        </div>
    </div>


    <div class="col-xs-12 col-md-4">
        <div>
            <label for="jobsheet-livingroom">
                <input type="checkbox" name="jobsheet-livingroom" id="jobsheet-livingroom"
                       ng-model="jobSheet.query.affectedAreas.livingroom">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_LIVINGROOM') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-diningroom">
                <input type="checkbox" name="jobSheet-diningroom" id="jobSheet-diningroom"
                       ng-model="jobSheet.query.affectedAreas.diningroom">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_DININGROOM') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-bathroom1">
                <input type="checkbox" name="jobSheet-bathroom1" id="jobSheet-bathroom1"
                       ng-model="jobSheet.query.affectedAreas.bathroom1">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM1') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-bathroom2">
                <input type="checkbox" name="jobSheet-bathroom2" id="jobSheet-bathroom2"
                       ng-model="jobSheet.query.affectedAreas.bathroom2">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_BATHROOM2') ?>
            </label>
        </div>
    </div>


    <div class="col-xs-12 col-md-4">
        <div>
            <label for="jobsheet-masterBed">
                <input type="checkbox" name="jobsheet-masterBed" id="jobsheet-masterBed"
                       ng-model="jobSheet.query.affectedAreas.masterBed">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_MASTERBED') ?>
            </label>
        </div>
        <div>
            <label for="jobsheet-bedroom1">
                <input type="checkbox" name="jobsheet-bedroom1" id="jobsheet-bedroom1"
                       ng-model="jobSheet.query.affectedAreas.bedroom1">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_BEDROOM1') ?>
            </label>
        </div>
        <div>
            <label for="jobsheet-den">
                <input type="checkbox" name="jobsheet-den" id="jobsheet-den"
                       ng-model="jobSheet.query.affectedAreas.den">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_DEN') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-laundry">
                <input type="checkbox" name="jobSheet-laundry" id="jobSheet-laundry"
                       ng-model="jobSheet.query.affectedAreas.laundry">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_LAUNDRY') ?>
            </label>
        </div>
        <div>
            <label for="jobSheet-is-other">
                <input type="checkbox" name="jobSheet-is-other" id="jobSheet-is-other"
                       ng-model="jobSheet.isOther">
                       <?php echo $this->getString('CLAIMS_JOBSHEET_OTHER') ?>
            </label>
            <input type="text" class="form-control" ng-disabled="!jobSheet.isOther"
                   ng-required="jobSheet.isOther" ng-model="jobSheet.query.affectedAreas.other">
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="col-xs-12">
        <label for="jobsheet-is-asbestos">
            <input type="checkbox" name="jobsheet-is-asbestos" id="jobsheet-is-asbestos"
                   ng-model="jobSheet.isAsbestos">
                   <?php echo $this->getString('CLAIMS_JOBSHEET_ASBESTOS') ?>
        </label>
        <input type="text" class="form-control" ng-disabled="!jobSheet.isAsbestos"
               ng-required="jobSheet.isAsbestos" ng-model="jobSheet.query.affectedAreas.asbestosSample">
    </div>
    <div class="col-xs-12">
        <label for="jobsheet-existing">
            <input type="checkbox" name="jobsheet-isexisting" id="jobsheet-isexisting"
                   ng-model="jobSheet.isExisting">
                   <?php echo $this->getString('CLAIMS_JOBSHEET_EXISTING') ?>
        </label>
        <textarea name="jobsheet-existing" id="jobsheet-existing" class="form-control"
                  ng-disabled="!jobSheet.isExisting" ng-required="jobSheet.isExisting" rows="8" cols="40"
                  ng-model="jobSheet.query.affectedAreas.existing"></textarea>
    </div>
    <div class="clearfix"></div>
    <div class="widgetfooter clearfix">
        <div class="pull-right btn-group">
            <a href="" class="btn btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
                <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
            </a>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->getString('CLAIMS_ADDNEW_NEXT'); ?>
            </button>
        </div>
    </div>
</form>

<form id="wizard-form" ng-submit="finish()" ng-show="currentPage === 3">
    <table class="table">
        <tbody>
            <tr>
                <td>
                    <strong><?php echo $this->getString('CLAIMS_JOBSHEET_BLOWERS') ?></strong>
                </td>
                <td>
                    Bind equipment here
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php echo $this->getString('CLAIMS_JOBSHEET_DEHUMS') ?></strong>
                </td>
                <td>
                    Bind equipment here
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php echo $this->getString('CLAIMS_JOBSHEET_AIRSCRUB') ?></strong>
                </td>
                <td>
                    Bind equipment here
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php echo $this->getString('CLAIMS_JOBSHEET_INJECTIDRY') ?></strong>
                </td>
                <td>
                    Bind equipment here
                </td>
            </tr>
            <tr>
                <td>
                    <strong><?php echo $this->getString('CLAIMS_JOBSHEET_EXTEN') ?></strong>
                </td>
                <td>
                    Bind equipment here
                </td>
            </tr>
            <tr>
                <td><strong><?php echo $this->getString('CLAIMS_JOBSHEET_ELEC') ?></strong></td>
                <td>
                    Bind equipment here
                </td>
            </tr>
        </tbody>
    </table>
    <div class="clearfix"></div>
    <div class="widgetfooter clearfix">
        <div class="pull-right btn-group">
            <button class="btn-default" ng-click="prevPage()" ng-disabled="currentPage === 0">
                <?php echo $this->getString('CLAIMS_ADDNEW_PREV'); ?>
            </button>
            <button type="submit" class="btn btn-primary">
                <?php echo $this->getString('CLAIMS_ADDNEW_CONFIRM'); ?>
            </button>
        </div>
    </div>
</form>
