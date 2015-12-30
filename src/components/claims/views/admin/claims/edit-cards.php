<div ng-controller="claimsContactsList">
    <div class="card">
        <div class="cardheader">
            <h1>
                <?php echo $this->getString('CLAIMS_PHASE_VS_ECD') ?>
            </h1>
        </div>
        <div ng-if="claimLoading">
            <div class="spinner-loader"></div>
        </div>
        <div ng-if="!claimLoading && claim.phase.title">
            <div class="cardleft">
                <h1>{{claim.phase.title}}</h1>
                <span class="big" ng-class="{'text-danger':timeRemaining.past}">
                    <span ng-if="timeRemaining.past">- </span>{{timeRemaining.days}} d, {{timeRemaining.hours}} h
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
                                {{startDate| date: mediumDate : '+0000'}}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>
                                    <?php echo $this->getString('CLAIMS_ESTIMATE') ?>
                                </strong>
                            </td>
                            <td>
                                {{endDate| date : mediumDate : '+0000'}}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div ng-if="!claimLoading && !claim.phase.title">
            <p class="text-center text-muted">
                <?php echo $this->getString('CLAIMS_NOPHASE') ?>
            </p>
        </div>
        <div class="clearfix"></div>
    </div>

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


    <div ng-if="!loading && hasContacts()" ng-repeat="contact in contacts" class="card info-card ng-scope">
        <p><strong class="ng-binding">{{contact.contactType}}:</strong> <a class="ng-binding" href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
            <span class="ng-binding" style="float: right"><strong><?php echo $this->getString('CLAIMS_COMPANY'); ?>:</strong> {{contact.company}} </span></p>
        <p class="ng-binding">
            <?php echo $this->getString('CLAIMS_OFFICE'); ?>: {{contact.office}}
            <span class="ng-binding" style="float: right"> <?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{contact.mobile}}</span>
        </p>

        <div class="cardfooter clearfix">
            <div class="pull-right"><a href="/admin/contacts/{{contact.id}}"><?php echo $this->getString('CLAIMS_MORE_INFORMATION'); ?></a></div>

        </div>
    </div>
    <div ng-if="!loading && !hasContacts()">
        <p class="text-center text-muted">
            <?php echo $this->getString('CLAIMS_NOCONTACTS') ?>
        </p>
    </div>

</div>
