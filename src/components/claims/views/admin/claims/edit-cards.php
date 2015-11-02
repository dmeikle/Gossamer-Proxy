<div ng-controller="claimsContactsList">
    <h3><?php echo $this->getString('CLAIMS_CONTACTS_LIST'); ?></h3>
    <div class="card info-card" ng-repeat="contact in contacts">
        <p><strong>{{contact.type}}:</strong> <a href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
            <span style="float: right"><strong><?php echo $this->getString('CLAIMS_COMPANY'); ?>:</strong> {{contact.company}}</span></p>        
        <p>
            Office: {{contact.office}}
            <span style="float: right"> <?php echo $this->getString('CLAIMS_MOBILE'); ?>: {{contact.mobile}}</span>
        </p>

    </div>
</div>
<div class="clearfix"></div>