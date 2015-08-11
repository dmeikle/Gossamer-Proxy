<div class="modal-header">
  <h1 class="modal-title">Add New Template</h1>
  <div class="clearfix"></div>
</div>
<div class="modal-body">
  <div class="form-group">
    <label for="name"><?php echo $this->getString('PAGE_NAME'); ?></label>
    <input class="form-control" type="text" name="name" id="new-page-template-name" ng-model="newPageTemplate.name">
  </div>
  <div class="form-group">
    <label for="name"><?php echo $this->getString('PAGE_YAML_KEY'); ?></label>
    <input class="form-control" type="text" name="yaml-key" id="new-page-template-yaml-key" ng-model="newPageTemplate.ymlKey">
  </div>
  <div class="form-group">
    <label for="name"><?php echo $this->getString('PAGE_description'); ?></label>
    <input class="form-control" type="text" name="description" id="new-page-template-description" ng-model="newPageTemplate.description">
  </div>

  <input class="hidden" type="text" name="system" id="new-page-template-system" ng-model="newPageTemplate.isSystemWidget" value='1'>

  <h3>Which sections do you want to have active on this page?</h3>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="topwidgets" id="new-page-template-topwidgets" ng-model="newPageTemplate.sections.topwidgets">
      Top Widgets
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="section3" id="new-page-template-section3" ng-model="newPageTemplate.sections.section3">
      Section 3
    </label>
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox" name="section4" id="new-page-template-section4" ng-model="newPageTemplate.sections.section4">
      Section 4
    </label>
  </div>
</div>
<div class="modal-footer">
  <button class="primary" ng-click="confirm(newPageTemplate)"><?php echo $this->getString('PAGE_CONFIRM'); ?></button>

  <button ng-click="cancel()"><?php echo $this->getString('PAGE_CANCEL'); ?></button>
</div>
