<div ng-controller="claimsContactsList">
    <h3><?php echo $this->getString('CLAIMS_CONTACTS_LIST'); ?></h3>
    <div class="card info-card" ng-repeat="contact in contacts">
        <p><strong>{{contact.type}}:</strong> <a href="mailto:{{contact.email}}">{{contact.firstname}} {{ contact.lastname}}</a>
            <span style="float: right"><strong>Company:</strong> {{contact.company}}</span></p>        
        <p>
            Office: {{contact.office}} 123-123-1233
            <span style="float: right"> Mobile: {{contact.Mobile}}123-123-1233</span>
        </p>

    </div>
</div>
<div class="clearfix"></div>