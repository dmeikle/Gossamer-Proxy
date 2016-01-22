<div>
    <div class="card" ng-controller="claimsDaysRemainingCtrl as ctrl" >
        <div class="cardheader">
            <h1>
                <?php echo $this->getString('CLAIMS_PHASE_VS_ECD') ?>
            </h1>
        </div>
        <div ng-if="ctrl.claimLoading">
            <div class="spinner-loader"></div>
        </div>
        <div ng-if="!ctrl.claimLoading && ctrl.daysRemainingInClaimPhase">
            <div class="cardleft">
                <h1>{{ctrl.phaseTitle}}</h1>

                <span ng-show="!ctrl.pastDue" class="big">
                    {{ ctrl.daysRemainingInClaimPhase}} <?php echo $this->getString('CLAIMS_DAYS_REMAINING') ?>
                </span>
                <span ng-show="ctrl.pastDue" class="big text-danger">
                    {{ ctrl.daysRemainingInClaimPhase}} <?php echo $this->getString('CLAIMS_DAYS_PASSED_DUE') ?>
                </span>
            </div>
            <div class="cardright">
                <table class="table cardtable">
                    <tbody>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $this->getString('CLAIMS_STARTDATE') ?>
                                </strong>
                            </td>
                            <td>
                                {{ctrl.startDate| date: mediumDate : '+0000'}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $this->getString('CLAIMS_ESTIMATE') ?>
                                </strong>
                            </td>
                            <td>
                                {{ctrl.scheduledEndDate| date : mediumDate : '+0000'}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-if="!ctrl.claimLoading && !ctrl.daysRemainingInClaimPhase">
            <p class="text-center text-muted">
                <?php echo $this->getString('CLAIMS_NOPHASE') ?>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="card" ng-controller="claimsContactsList">
        <div class="clearfix">
            <h3 class="pull-left"><?php echo $this->getString('CLAIMS_CONTACTS_LIST'); ?></h3>

            <div class="pull-right">
                <button class="primary h3button" ng-click="openClientModal()">
                    <?php echo $this->getString('CLAIMS_NEW_CLIENT') ?>
                </button>
            </div>
        </div>
        <div ng-if="loading">
            <div class="spinner-loader"></div>
        </div>
        <div ng-controller="messagingEditCtrl as messageCtrl">
            <div ng-if="!loading && hasContacts()" ng-repeat="contact in contacts" class="card info-card ng-scope">
                <p><strong class="ng-binding">{{contact.contactType}}:</strong> <a class="ng-binding" href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
                    <span class="ng-binding" style="float: right"><strong><?php echo $this->getString('CLAIMS_COMPANY'); ?>:</strong> {{contact.company}} </span></p>
                <p class="ng-binding">
                    <?php echo $this->getString('CLAIMS_OFFICE'); ?>: {{contact.office}}
                    <span class="ng-binding" style="float: right"> <?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{contact.mobile}}</span>
                </p>

                <div class="cardfooter clearfix">
                    <a href="" ng-click="messageCtrl.showMessagePane(contact, claim)">send message</a>
                    <div class="pull-right"><a href="/admin/contacts/{{contact.id}}"><?php echo $this->getString('CLAIMS_MORE_INFORMATION'); ?></a></div>
                </div>
            </div>

        </div>

        <div ng-if="!loading && !hasContacts()">
            <p class="text-center text-muted">
                <?php echo $this->getString('CLAIMS_NOCONTACTS') ?>
            </p>
        </div>
    </div>
</div>

<script type="text/ng-template" id="messagePaneModal">
    <div class="modal-header">
    <h1>
    <?php echo $this->getString('CLAIMS_SEND_MESSAGE') ?>
    </h1>
    <div  class="clearfix">
    <h3>
    {{ctrl.contact.firstname}} {{ctrl.contact.lastname}}
    </h1>
    </div>
    </div>
    <div class="modal-body clearfix">
    <div class="message-pane" >

    <div class="prompt">Message Type:</div>
    <div class="field">
    <?php echo $messageForm['MessageTypes_id']; ?>
    </div>
    <div class="prompt">
    Subject:
    </div>
    <div class="field">

    <?php echo $messageForm['subject']; ?>
    </div>
    <div class="prompt">
    Message:
    </div>
    <div class="field">
    <?php echo $messageForm['message']; ?>
    </div>
    <div class="field">
    <button ng-click="ctrl.cancel()" class="btn btn-primary">Cancel</button> <button ng-click="ctrl.sendMessage(ctrl.message)" class="btn btn-primary">Send</button>
    </div>

    </div>
    </div>
</script>
