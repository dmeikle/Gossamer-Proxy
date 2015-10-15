<div class="widget" ng-controller="claimsListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left">Claim List</h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openClaimAdvancedSearch()">
        <?php echo $this->getString('CLAIMS_ADVANCED_SEARCH') ?>
      </button>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

      <form ng-submit="search(basicSearch.query)" class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
          ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
        <div class="resultspane" ng-show="noResults">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CLAIMS_NORESULTS') ?>
        </div>
        <span class="input-group-btn" ng-if="!searchSubmitted">
          <button type="submit" class="btn-default">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
        <span ng-if="searchSubmitted" class="input-group-btn">
          <button type="reset" class="btn-default" ng-click="resetSearch()">
            <span class="glyphicon glyphicon-remove"></span>
          </button>
        </span>
      </form>
      <a ng-click="openAddNewWizard()" class="btn btn-primary"><?php echo $this->getString('CLAIMS_NEW');?></a>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="jobNumber"><?php echo $this->getString('CLAIMS_JOBNUMBER'); ?></th>
                <th column-sortable data-column="phase"><?php echo $this->getString('CLAIMS_PHASE'); ?></th>
                <th column-sortable data-column="buildingName"><?php echo $this->getString('CLAIMS_BUILDING_NAME'); ?></th>
                <th column-sortable data-column="lossType"><?php echo $this->getString('CLAIMS_LOSS_TYPE'); ?></th>
                <th column-sortable data-column="lossDate"><?php echo $this->getString('CLAIMS_LOSS_DATE'); ?></th>
                <th column-sortable data-column="status"><?php echo $this->getString('CLAIMS_STATUS'); ?></th>
                <th column-sortable data-column="projectManager"><?php echo $this->getString('CLAIMS_PROJECT_MANAGER'); ?></th>
                <th column-sortable data-column="parentClaim"><?php echo $this->getString('CLAIMS_PARENT_CLAIM'); ?></th>
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
            ng-class="{'selected': claim === previouslyClickedObject, 'inactive bg-warning text-warning': claim.status=='inactive'}">
              <td ng-click="selectRow(claim)">{{claim.jobNumber}}</td>
              <td ng-click="selectRow(claim)">{{claim.phase}}</td>
              <td ng-click="selectRow(claim)">{{claim.buildingName}}</td>
              <td ng-click="selectRow(claim)">{{claim.losstype}}</td>
              <td ng-click="selectRow(claim)">{{claim.lossDate}}</td>
              <td ng-click="selectRow(claim)">{{claim.status}}</td>
              <td ng-click="selectRow(claim)">{{claim.projectManager}}</td>
              <td ng-click="selectRow(claim)">{{claim.parentJobNumber}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a href="/admin/claims/edit/{{claim.jobNumber}}">Edit</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <pagination class="pull-left" total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage"
      class="pagination" boundary-links="true" rotate="false">
    </pagination>

    <div class="pull-right">
      <p class="pull-left"><?php echo $this->getString('ITEMS_PER_PAGE'); ?></p>
      <ul class="btn-group pull-right">
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 10}" ng-click="setItemsPerPage(10)">10</button>
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 20}" ng-click="setItemsPerPage(20)">20</button>
        <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 50}" ng-click="setItemsPerPage(50)">50</button>
      </ul>
    </div>
  </div>

  <div class="widget-side-panel">
    <div class="pull-right">
      <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
    </div>
    <div ng-if="sidePanelLoading">
      <span class="spinner-loader"></span>
    </div>

    <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
      <h1><?php echo $this->getString('CLAIMS_ADVANCED_SEARCH');?></h1>
      <claim-advanced-search-filters>

      </claim-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('CLAIMS_SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('CLAIMS_RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching">
      <h1><a href="/admin/claims/edit/{{selectedClaim.id}}">{{selectedClaim.jobNumber}}</a></h1>
      <h4><?php echo $this->getString('CLAIMS_ADDRESS')?></h4>
      <div>{{selectedClaim.address1}}</div>
      <div>{{selectedClaim.address2}}</div>
      <div>{{selectedClaim.city}}</div>
      <h4><?php echo $this->getString('CLAIMS_CONTACTS')?></h4>
      <div class="card info-card" ng-repeat="contact in selectedClaim.contacts">
        <div class="cardheader">
          <h1>{{contact.firstname}} {{contact.lastname}}</h1>
        </div>
        <table class="table table-hover cardtable">
          <tr ng-if="contact.type">
            <td>
              <strong><?php echo $this->getString('CLAIMS_CONTACT_TYPE') ?></strong>
            </td>
            <td>
              {{contact.type}}
            </td>
          </tr>
          <tr ng-if="contact.office">
            <td>
              <strong><?php echo $this->getString('CLAIMS_CONTACT_OFFICE') ?></strong>
            </td>
            <td>
              {{contact.office}}
            </td>
          </tr>
          <tr>
            <td>
              <strong><?php echo $this->getString('CLAIMS_CONTACT_EXT') ?></strong>
            </td>
            <td>
              {{contact.ext}}
            </td>
          </tr>
          <tr ng-if="contact.mobile">
            <td>
              <strong><?php echo $this->getString('CLAIMS_CONTACT_MOBILE') ?></strong>
            </td>
            <td>
              {{contact.mobile}}
            </td>
          </tr>
        </table>
        <div class="cardfooter clearfix">
          <div class="pull-right"><a href="/admin/contacts/{{contact.id}}"><?php echo $this->getString('MORE_INFO')?></a></div>
        </div>
      </div>
      <h4><?php echo $this->getString('CLAIMS_LOCATIONS') ?></h4>
      <div class="card info-card" ng-repeat="location in selectedClaim.locations">
        <div class="cardheader">
          <h1>{{location.unitNumber}}</h1>
        </div>
        <table class="table table-hover cardtable">
          <tbody>
            <tr>
              <td>
                <strong><?php echo $this->getString('CLAIMS_ISWORKAUTHORIZATION') ?></strong>
              </td>
              <td value="{{location.workAuthorizationReceived}}" bool-to-string>
              </td>
            </tr>
            <tr>
              <td>
                <strong><?php echo $this->getString('CLAIMS_ISPICTURES') ?></strong>
              </td>
              <td value="{{location.picturesTaken}}" bool-to-string>

              </td>
            </tr>
            <tr>
              <td>
                <strong><?php echo $this->getString('CLAIMS_ISKEYS') ?></strong>
              </td>
              <td>
                {{location.keysReceivedFrom}}
              </td>
            </tr>
          </tbody>
        </table>
        <div class="cardfooter clearfix">
          <div class="pull-right">
            <a href="/admin/claimlocations/{{selectedClaim.id}}/{{location.id}}"><?php echo $this->getString("MORE_INFO")?></a>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
