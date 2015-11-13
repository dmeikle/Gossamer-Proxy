<div class="widget col-md-5" ng-controller="subcontractorsEditCtrl">
    <div class="row-controls" style="float: right">
        <div class="dropdown">
            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                <li><a href="#" ng-click="openEditModal(claim)"><?php echo $this->getString('SUBCONTRACTORS_EDIT') ?></a></li>
            </ul>
        </div>
    </div>
    <h1 ng-if="!subcontractor"><?php echo $this->getString('SUBCONTRACTORS_CREATE'); ?></h1>
    <h1 class="pull-left" ng-if="subcontractor"><?php echo $this->getString('SUBCONTRACTORS_EDIT') ?> {{subcontractor.companyName}}</h1>
    <div class="clearfix"></div>


    <form role="form" class="form-standard" method="post" id="subcontractor-form" >
        <?php echo $form['id']; ?>
        <table class="table">
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_NAME'); ?>:</td>
                <td><?php echo $form['companyName']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_TYPE'); ?>:</td>
                <td>
                    <?php echo $form['SubcontractorTypes_id']; ?>
                </td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_ADDRESS'); ?>:</td>
                <td><?php echo $form['address1']; ?>
                    <?php echo $form['address2']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_CITY'); ?>:</td>
                <td><?php echo $form['city']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_PROVINCE'); ?>:</td>
                <td><?php echo $form['Provinces_id']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_POSTAL_CODE'); ?>:</td>
                <td><?php echo $form['postalCode']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_TELEPHONE'); ?>:</td>
                <td><?php echo $form['telephone']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_FAX'); ?>:</td>
                <td><?php echo $form['fax']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_URL'); ?>:</td>
                <td><?php echo $form['url']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_EMAIL'); ?>:</td>
                <td><?php echo $form['email']; ?></td>
            </tr>
            <tr>
                <td><?php echo $this->getString('SUBCONTRACTORS_RATING'); ?>:</td>
                <td><?php echo $form['rating']; ?></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <button class="primary" ng-click="save(subcontractor)" ng-disabled="!subcontractor">
                        <?php echo $this->getString('SUBCONTRACTORS_CONFIRM'); ?>
                    </button>
                    <button ng-click="cancel()"><?php echo $this->getString('SUBCONTRACTORS_CANCEL'); ?></button>
                </td>
            </tr>
        </table>
    </form>

</div>
<div class="widget col-md-offset-1 col-md-5" ng-controller="subcontractorsClaimsListCtrl">

    <table class="table table-over table-striped">
        <thead>
            <tr>
                <th class="col-md-2">Job Number</th>
                <th class="col-md-3">Unit Number</th>
                <th class="col-md-2">Start</th>
                <th class="col-md-2">End</th>
                <th class="col-md-1"></th>
            </tr>
        </thead>
        <tr ng-repeat="claim in claimsList">
            <td>{{ claim.jobNumber}} </td>
            <td>{{ claim.unitNumber}} </td>
            <td>{{ claim.startDate}} </td>
            <td>{{ claim.actualCompletionDate}} </td>
            <td><a href="/admin/claims/edit/{{ claim.jobNumber}}">view</a></td>
        </tr>
    </table>

    <pagination total-items="totalItems" ng-model="currentPage" max-size="itemsPerPage"
                class="pagination" boundary-links="true" rotate="false">
    </pagination>

    <div class="clearfix"></div>
</div>