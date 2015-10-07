<div class="content full-width" ng-controller="projectAddressEditCtrl" ng-cloak>
    <div class="widget">
        <h1 ng-if="!project"><?php echo $this->getString('PROJECTS_CREATE'); ?></h1>
        <h1 class="pull-left" ng-if="project"><?php echo $this->getString('PROJECTS_EDIT') ?> {{project.buildingName}} {{project.strataNumber}}</h1>
        <div class="clearfix"></div>

        <form ng-if="!loading" ng-submit="save(project)">
            <div class="cards">
                <div class="card">
                    <div class="cardheader">
                        <h1 class="pull-left"><?php echo $this->getString('PROJECTS_BUILDING_INFO'); ?></h1>
                    </div>
                    <div class="clearfix"></div>
                    <div ng-if="loading">
                        <span class="spinner-loader"></span>
                    </div>


                    <div class="form-group">
                        <label for="project-firstname"><?php echo $this->getString('PROJECTS_BUILDINGNAME'); ?></label>
                        <?php echo $form['buildingName']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-address1"><?php echo $this->getString('PROJECTS_STRATANUMBER'); ?></label>
                        <?php echo $form['strataNumber']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-lastname"><?php echo $this->getString('PROJECTS_ADDRESS'); ?></label>
                        <?php echo $form['address1']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_NEIGHBORHOOD'); ?></label>
                        <?php echo $form['neighborhood']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-personalEmail"><?php echo $this->getString('PROJECTS_CITY'); ?></label>
                        <?php echo $form['city']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-personalMobile"><?php echo $this->getString('PROJECTS_PROVINCE'); ?></label>
                        <?php echo $form['Provinces_id']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-personalTelephone"><?php echo $this->getString('PROJECTS_POSTALCODE'); ?></label>
                        <?php echo $form['postalCode']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_BUILDINGAGE'); ?></label>
                        <?php echo $form['buildingAge']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_NOTES'); ?></label>
                        <?php echo $form['notes']; ?>
                    </div>


                    </form>
                </div>

            </div>
            <div class="cards">
                <div class="card">
                    <div class="cardheader">
                        <h1 class="pull-left"><?php echo $this->getString('PROJECTS_BUILDING_DETAILS'); ?></h1>
                    </div>
                    <div class="clearfix"></div>
                    <div ng-if="loading">
                        <span class="spinner-loader"></span>
                    </div>

                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_STRATANAME'); ?></label>
                        <?php echo $form['strata']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_NUMFLOORS'); ?></label>
                        <?php echo $form['numFloors']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_NUMUNITS'); ?></label>
                        <?php echo $form['numUnits']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_PROPERTYTYPE'); ?></label>
                        <?php echo $form['propertyType']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_TELEPHONE'); ?></label>
                        <?php echo $form['telephone']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_MANAGEMENT'); ?></label>
                        <?php echo $form['management']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_MAINIMAGE'); ?></label>
                        <?php echo $form['mainImage']; ?>
                    </div>
                    <div class="form-group">
                        <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_GOOGLEMAPLINK'); ?></label>
                        <?php echo $form['googleMapLink']; ?>
                    </div>

                    <div class="clearfix"></div>
                    <div class="cardfooter">
                        <input type="submit" class="btn btn-primary pull-right" 
                               value="<?php echo $this->getString('PROJECTS_SAVE'); ?>" ng-click="save(project)">
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </form>
        <div class="cards">

            <div class="card">
                <div class="cardheader">
                    <h1><?php echo $this->getString('PROJECTS_CONTACT_INFO'); ?></h1>
                </div>
                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>
                <div ng-if="!loading">                    
                    <div class="cardleft">
                        <table class="cardtable">
                            <tbody>
                                <tr>
                                    <td><strong><?php echo $this->getString('PROJECTS_DEPARTMENT_ID'); ?></strong></td>
                                    <td get-department></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('PROJECTS_EMAIL'); ?></strong></td>
                                    <td>{{staff.email}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('PROJECTS_MOBILE'); ?></strong></td>
                                    <td>{{staff.mobile}}</td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $this->getString('PROJECTS_EXTENSION'); ?></strong></td>
                                    <td>{{staff.extension}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="cardright" ng-if="!loading && staff.imageName">
                    <img class="staff-picture pull-right" ng-src="/images/staff/{{staff.imageName}}">

                </div>
                <div class="clearfix"></div>
            </div>
            <div class="card">
                <div class="cardheader">
                    <h1 class="pull-left"><?php echo $this->getString('PROJECTS_CLAIMS_HISTORY'); ?></h1>
                </div>
                <div class="clearfix"></div>

                <div ng-if="loading">
                    <span class="spinner-loader"></span>
                </div>

                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th column-sortable data-column="jobNumber">Job Number</th>
                            <th column-sortable data-column="unassignedJobNumber">Emergency Number</th>
                            <th column-sortable data-column="callInDate">Call In Date</th>
                            <th column-sortable data-column="completionDate">Mobile</th>
                            <th column-sortable data-column="ClaimTypes_id">Title</th>
                            <th column-sortable data-column="ProjectManager_id">Extension</th>
                            <th sort-by-button class="cog-col row-controls">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-if="loading">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <span class="spinner-loader"></span>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr ng-if="!loading" ng-repeat="claim in claimsList"
                            ng-class="{'selected': claim === previouslyClickedObject, 'inactive bg-warning text-warning': claim.status == 'inactive'}">
                            <td ng-click="selectRow(claim)">{{claim.jobNumber}}</td>
                            <td ng-click="selectRow(claim)">{{claim.unassignedJobNumber}}</td>
                            <td ng-click="selectRow(claim)">{{claim.callInDate}}</td>
                            <td ng-click="selectRow(claim)">{{claim.completionDate}}</td>
                            <td ng-click="selectRow(claim)">{{claim.ClaimTypes_id}}</td>
                            <td ng-click="selectRow(claim)">{{claim.ProjectManager_id}}</td>
                            <td class="row-controls">
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                            id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                        <li><a ng-click="openStaffScheduleModal(claim)">Schedule</a></li>
                                        <li><a href="/admin/claim/edit/{{claim.id}}">Edit</a></li>
                                        <li><a href="#">Emergency Contacts</a></li>
                                        <li><a href="#">Delete</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            

        </div>
        <div class="clearfix"></div>
        <form class="hide"></form>
    </div>
</div>
