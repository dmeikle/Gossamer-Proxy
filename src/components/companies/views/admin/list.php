<!-- placed here until properly styled -->
<style>
    .sidePanelRow .name {
        font-weight: 600;
        float: left;
    }
    .sidePanelRow .dateReceived {
        float: right;
    }
    
    .sidePanelRow .claimType {
        clear: both;
    }
    
    
</style>


<div class="widget" ng-controller="companyListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left">Company List</h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openCompanyAdvancedSearch()">
        <?php echo $this->getString('COMPANY_ADVANCED_SEARCH') ?>
      </button>
      <div class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
          ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
        <span class="input-group-addon" ng-if="!searchSubmitted">
          <span class="glyphicon glyphicon-search"></span>
        </span>
        <span ng-if="searchSubmitted" class="input-group-btn">
          <button class="btn-default" ng-click="resetSearch()">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </span>
        <datalist id="autocomplete-list">
          <option ng-if="!autocomplete" value="" disabled><?php echo $this->getString('COMPANY_LOADING'); ?></option>
          <option ng-repeat="value in autocomplete" value="{{value.firstname}} {{value.lastname}}"></option>
        </datalist>
      </div>
      <button ng-click="openAddNewCompanyModal()" class="btn-primary"><?php echo $this->getString('COMPANY_NEW');?></button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->getString('COMPANY_NAME'); ?></th>
                <th><?php echo $this->getString('COMPANY_TYPE'); ?></th>
                <th><?php echo $this->getString('COMPANY_ADDRESS'); ?></th>
                <th><?php echo $this->getString('COMPANY_CITY'); ?></th>
                <th><?php echo $this->getString('COMPANY_POSTALCODE'); ?></th>
                <th><?php echo $this->getString('COMPANY_TELEPHONE'); ?></th>
                <th><?php echo $this->getString('COMPANY_FAX'); ?></th>
                <th><?php echo $this->getString('COMPANY_URL'); ?></th>
                <th class="cog-col">&nbsp;</th>
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
          <tr ng-if="!loading" ng-repeat="company in companyList track by $index"
            ng-class="{'selected': company === previouslyClickedObject, 'inactive bg-warning text-warning': company.status=='inactive'}">
              <td ng-click="selectRow(company)">{{company.name}}</a></td>
              <td ng-click="selectRow(company)">{{company.type}}</a></td>
              <td ng-click="selectRow(company)">{{company.address1}}</td>
              <td ng-click="selectRow(company)">{{company.city}}</td>
              <td ng-click="selectRow(company)">{{company.postalCode}}</td>
              <td ng-click="selectRow(company)">{{company.telephone}}</td>
              <td ng-click="selectRow(company)">{{company.fax}}</td>
              <td ng-click="selectRow(company)">{{company.url}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a href="/admin/companies/edit/{{company.Companies_id}}">Edit</a></li>
                    <li><a href="#">Delete</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <pagination total-items="totalItems" ng-model="currentPage" max-size="itemsPerPage"
      class="pagination" boundary-links="true" rotate="false">
    </pagination>
  </div>

  <div class="widget-side-panel">
    <div class="pull-right">
      <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
    <div ng-if="sidePanelLoading">
      <span class="spinner-loader"></span>
    </div>

    <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
      <h1><?php echo $this->getString('COMPANY_ADVANCED_SEARCH');?></h1>
      <company-advanced-search-filters>

      </company-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching">
      <h1><a href="/admin/company/edit/{{selectedCompany.id}}">{{selectedCompany.firstname}} {{selectedCompany.lastname}}</a></h1>
      <h4><?php echo $this->getString('COMPANY_NAME')?></h3>
      <p><a href="/admin/companies/edit/{{selectedCompany.Companies_id}}">{{selectedCompany.name}}</a></p>
      <div ng-repeat="claim in claimsList" class="sidePanelRow">
          <div class="name">{{ claim.jobNumber }}</div>
          <div class="dateReceived"><?php echo $this->getString('CLAIMS_DATE_RECEIVED')?> {{ claim.dateReceived }}</div>
          <div class="claimType">{{ claim.icon }}  {{ claim.typeOfClaim }} {{ claim.ClaimTypes_other }}</div> 
          <div class="deductable"><?php echo $this->getString('CLAIMS_DEDUCTABLE')?> {{ claim.deductable }}</div>
          <div class="reason"><?php echo $this->getString('CLAIMS_REASON')?> <br />{{ claim.reason }}</div>
          <div class="unassignedJobNumber">{{ claim.unassignedJobNumber }}</div>
          <div class="projectManager">{{ claim.firstname }} {{ claim.lastname }}</div>    
          <div class="claimStatus">{{ claim.status }}</div>          
      </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>