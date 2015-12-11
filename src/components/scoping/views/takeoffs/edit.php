<div class="widget" ng-controller="takeoffsEditCtrl">
    <div class="widgetheader">
        <h1><?php echo $this->getString('SCOPING_MATERIAL_TAKE_OFF') ?></h1>
    </div>
    <?php echo $form['Claims_id'] ?>
    <div ng-if="loading">
        <div class="text-center"><span class="spinner-loader"></span></div>
    </div>
    <div ng-if="!loading">
        <uib-tabset ng-repeat="location in claimLocations">
            <uib-tab heading="location.unitNumber">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>
                                <?php echo $this->getString('SCOPING_UNIT') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_INSULATION') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_VAPOUR_BARRIER') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_DRYWALL') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_CORNER_BEAD') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_J_BEAD') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_BASE_BOARD') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_COVE') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_CASING') ?>
                            </th>
                            <th>
                                <?php echo $this->getString('SCOPING_OTHER') ?>
                            </th>
                            <th class="cog-col">
                                
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="item in affectedAreas">
                            <td class="table-title-column">
                                <div class="form-group">
                                    {{item.name}}
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['insulation'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['vapourBarrier'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['drywall'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['cornerBead'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['jBead'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['baseboard'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['cove'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['casing'] ?>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <?php echo $form['other'] ?>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </uib-tab>
        </uib-tabset>
    </div>
    <div class="clearfix"></div>
</div>