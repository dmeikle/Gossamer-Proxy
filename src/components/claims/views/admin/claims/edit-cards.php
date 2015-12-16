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
    <div ng-if="!loading && contacts[0].type" class="card" ng-repeat="contact in contacts">
        <div class="cardheader">
            <h1 ng-if="contact.type" class="pull-left">
                {{contact.type}}
            </h1>
            <h2 class="pull-right">
                <a href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
            </h2>
        </div>
        <table class="table cardtable">
            <tbody>
                <tr>
                    <td>
                        <strong><?php echo $this->getString('CLAIMS_COMPANY'); ?></strong>
                    </td>
                    <td>{{contact.company}}</td>
                </tr>
                <tr>
                    <td>
                        <strong><?php echo $this->getString('CLAIMS_OFFICE'); ?></strong>
                    </td>
                    <td>{{contact.office}}</td>
                </tr>
                <tr>
                    <td>
                        <strong><?php echo $this->getString('CLAIMS_MOBILE'); ?></strong>
                    </td>
                    <td>{{contact.mobile}}</td>
                </tr>
            </tbody>
        </table>
        <div class="cardfooter clearfix">
            <div class="pull-right">
                <a href="" ng-click="openClientModal(contact)">
                    <small><?php echo $this->getString('EDIT') ?></small>
                </a>
            </div>
        </div>
    </div>
    <div ng-if="!loading && !contacts[0].type">
        <p class="text-center text-muted">
            <?php echo $this->getString('CLAIMS_NOCONTACTS') ?>
        </p>
    </div>
</div>
