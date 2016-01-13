<div class="modal-header">
    <h1 ng-if="!contact.id">
        <?php echo $this->getString('CLAIMS_NEW_CLIENT') ?>
    </h1>
    <div ng-if="contact.id" class="clearfix">
        <h1 class="pull-left">
            <?php echo $this->getString('EDIT') ?>
            {{contact.firstname}} {{contact.lastname}}
        </h1>
        <div class="pull-right">
            <button class="btn-default" ng-click="remove(contact)">
                <?php echo $this->getString('REMOVE') ?>
            </button>
        </div>
    </div>
</div>
<div class="modal-body clearfix">
    <div class="form-group col-xs-6 typeahead-multiline">
        <label for="">
            <?php echo $this->getString('CLAIMS_CONTACT_FIRSTNAME') ?>
        </label>
        <input type="text" ng-model="contactInput" ng-bind-html-unsafe="contactInput"
               uib-typeahead="contact as contact.firstname + ' ' + contact.lastname + contact.company for contact in firstnameAutocomplete($viewValue)"
               typeahead-loading="loadingFirstname" typeahead-no-results="noFirstnameResults" class="form-control"
               typeahead-min-length="3" typeahead-on-select="selectContact()"
               typeahead-template-url="customTemplate.html">
        <div class="resultspane" ng-show="noFirstnameResults">
            <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIMS_NO_RESULTS') ?>
        </div>

    </div>
    <div class="clearfix"></div>

    <div ng-if="contact.firstname" class="col-xs-6">
        <strong>{{contact.company}}</strong><br/>
        {{contact.contactType}}<br/>
        {{contact.firstname}} {{contact.lastname}}<br />
        office: {{contact.office}} {{contact.extension}}<br />
        mobile: {{contact.mobile}}
    </div>
    <form></form>
</div>
<div class="modal-footer">
    <div class="pull-right btn-group">
        <button class="btn-default" ng-click="cancel()">
            <?php echo $this->getString('CANCEL') ?>
        </button>
        <button class="primary" ng-click="submit()">
            <?php echo $this->getString('CONFIRM') ?>
        </button>
    </div>
</div>

<script type="text/ng-template" id="customTemplate.html">
<a>
<span bind-html-unsafe="match.label | typeaheadHighlight:query"></span>
<div><strong>{{match.model.firstname}} {{match.model.lastname}}<span ng-if="match.model.contactType"> - {{match.model.contactType}}</span></strong></div>
<small>{{match.model.company}}</small>
<div><?php echo $this->getString('CLAIMS_CITY') ?>: {{match.model.city}}</div>
<div><?php echo $this->getString('CLAIMS_PHONE') ?>: {{match.model.telephone}}</div>
<div><?php echo $this->getString('CLAIMS_EMAIL') ?>: {{match.model.email}}</div>
</a>
</script>