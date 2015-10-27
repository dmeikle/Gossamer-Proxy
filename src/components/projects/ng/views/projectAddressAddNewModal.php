<div class="modal-header" ng-switch="project.id">
    <h1 class="modal-title"><?php echo $this->getString('PROJECTS_NEW'); ?></h1>
</div>
<div class="modal-body">
    <form class="card">

        <div class="form-group">
            <label for="project-firstname"><?php echo $this->getString('PROJECTS_BUILDINGNAME'); ?></label>
            <?php echo $form['buildingName']; ?>
        </div>
        <div class="form-group">
            <label for="project-lastname"><?php echo $this->getString('PROJECTS_ADDRESS'); ?></label>
            <?php echo $form['address1']; ?><br />
            <?php echo $form['address2']; ?>

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
            <label for="project-address1"><?php echo $this->getString('PROJECTS_STRATANUMBER'); ?></label>
            <?php echo $form['strataNumber']; ?>
        </div>


        <div class="form-group">
            <label for="project-buildingAge"><?php echo $this->getString('PROJECTS_BUILDINGAGE'); ?></label>
            <?php echo $form['buildingAge']; ?>
        </div>
    </form>

    <div class="clearfix"></div>

    <div class="clearfix"></div>
    <div class="modal-footer">
        <button class="primary" ng-click="save(project)"><?php echo $this->getString('PROJECTS_CONFIRM'); ?></button>

        <button ng-click="cancel()"><?php echo $this->getString('PROJECTS_CANCEL'); ?></button>
    </div>
</div>