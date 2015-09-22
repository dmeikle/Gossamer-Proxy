

<div class="modal-header" ng-switch="company.id">
  <h1 class="modal-title"><?php echo $this->getString('COMPANY_ADD_NEW'); ?></h1>
</div>
<div class="modal-body">
  <div class="cards col-md-12">
    <div class="card">
      <div class="cardheader">
        <h1 class="pull-left"><?php echo $this->getString('COMPANY_INFO'); ?></h1>
      </div>
      <div class="clearfix"></div>

      
        <div class="form-group">
          <label for="company-name"><?php echo $this->getString('COMPANY_NAME'); ?></label>
          <input class="form-control" type="text" name="name"
            id="company-name" ng-model="company.name">
        </div>
        <div class="form-group">
          <label for="company-type"><?php echo $this->getString('COMPANY_TYPE'); ?></label>
          <select class="form-control" id="company-Provinces_id" ng-model='company.CompanyTypes_id'>
              <?php foreach($CompanyTypes as $type) {?>
              <option value="<?php echo $type['id'];?>"><?php echo $type['type'];?></option>              
              <?php } ?>
          </select>
        </div>
        <div class="form-group">
          <label for="company-telephone"><?php echo $this->getString('COMPANY_TELEPHONE'); ?></label>
          <input class="form-control" type="text" name="telephone"
            id="company-telephone" ng-model="company.telephone">
        </div>
        <div class="form-group">
          <label for="company-address1"><?php echo $this->getString('COMPANY_ADDRESS'); ?></label>
          <input class="form-control" type="text" name="address1"
            id="company-address1" ng-model="company.address1">
          <input class="form-control" type="text" name="address2"
            id="company-address2" ng-model="company.address2">
        </div>
        <div class="form-group">
          <label for="company-city"><?php echo $this->getString('COMPANY_CITY'); ?></label>
          <input class="form-control" type="city" name="city"
            id="company-city" ng-model="company.city">
        </div>
        <div class="form-group">
          <label for="company-Provinces_id"><?php echo $this->getString('COMPANY_PROVINCE'); ?></label>
          <select class="form-control" id="company-Provinces_id" ng-model='company.Provinces_id'>
              <?php foreach($Provinces as $province) {?>
              <option value="<?php echo $province['id'];?>"><?php echo $province['province'];?></option>              
              <?php } ?>
          </select>          
        </div>
        <div class="form-group">
          <label for="company-Countries_id"><?php echo $this->getString('COMPANY_COUNTRY'); ?></label>
          <select class="form-control" id="company-Countries_id" ng-model='company.Countries_id'>
              <?php foreach($Countrys as $country) {?>
              <option value="<?php echo $country['id'];?>"><?php echo $country['country'];?></option>              
              <?php } ?>
          </select>  
        </div>
      
        <div class="form-group">
          <label for="company-postalCode"><?php echo $this->getString('COMPANY_POSTALCODE'); ?></label>
          <input class="form-control" type="text" name="postalCode"
            id="company-postalCode" ng-model="company.postalCode">
        </div>
        <div class="form-group">
          <label for="company-fax"><?php echo $this->getString('COMPANY_FAX'); ?></label>
          <input class="form-control" type="text" name="fax"
            id="company-fax" ng-model="company.fax" >
        </div>
        <div class="form-group">
          <label for="company-url"><?php echo $this->getString('COMPANY_URL'); ?></label>
          <input class="form-control" type="text" name="url"
            id="company-url" ng-model="company.url">
        </div>
      </div>
      <div class="clearfix"></div>
    </div>
  </div>


  <div class="clearfix"></div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
  <button class="primary" ng-click="confirm(widget)"><?php echo $this->getString('COMPANY_CONFIRM'); ?></button>

  <button ng-click="cancel()"><?php echo $this->getString('COMPANY_CANCEL'); ?></button>
</div>
