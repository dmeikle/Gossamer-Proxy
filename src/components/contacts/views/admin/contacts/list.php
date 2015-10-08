<div class="widget" ng-controller="contactsListCtrl">
  <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left">Contact List</h1>
    <div class="toolbar form-inline">
      <button class="btn-link" ng-click="openContactAdvancedSearch()">
        <?php echo $this->getString('CONTACTS_ADVANCED_SEARCH') ?>
      </button>
      <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

      <form ng-submit="search(basicSearch.query)" class="input-group">
        <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
          ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
        <div class="resultspane" ng-show="noResults">
          <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('CONTACTS_NORESULTS') ?>
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
       <button ng-click="openAddNewContactModal()" class="btn-primary"><?php echo $this->getString('CONTACTS_NEW');?></button>
    </div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="firstname"><?php echo $this->getString('CONTACTS_FIRSTNAME'); ?></th>
                <th column-sortable data-column="lastname"><?php echo $this->getString('CONTACTS_LASTNAME'); ?></th>
                <th column-sortable data-column="title"><?php echo $this->getString('CONTACTS_TITLE'); ?></th>
                <th column-sortable data-column="telephone"><?php echo $this->getString('CONTACTS_OFFICE'); ?></th>
                <th column-sortable data-column="mobile"><?php echo $this->getString('CONTACTS_MOBILE'); ?></th>
                <th column-sortable data-column="status"><?php echo $this->getString('CONTACTS_STATUS'); ?></th>
                <th column-sortable data-column="numActive"><?php echo $this->getString('CONTACTS_ACTIVE_CLAIMS'); ?></th>
                <th column-sortable data-column="numComplete"><?php echo $this->getString('CONTACTS_COMPLETED_CLAIMS'); ?></th>
                <th column-sortable data-column="lastLogin"><?php echo $this->getString('CONTACTS_LAST_LOGIN'); ?></th>
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
          <tr ng-if="!loading" ng-repeat="contacts in contactsList"
            ng-class="{'selected': contacts === previouslyClickedObject, 'inactive bg-warning text-warning': contacts.status=='inactive'}">
              <td ng-click="selectRow(contacts)">{{contacts.firstname}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.lastname}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.title}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.telephone}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.mobile}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.status}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.numActive}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.numComplete}}</td>
              <td ng-click="selectRow(contacts)">{{contacts.lastLogin}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="/admin/contacts/claims/(contacts.id)"><?php echo $this->getString('CONTACTS_VIEW_CLAIMS'); ?></a></li>
                    <li><a href="/admin/contacts/edit/{{contacts.id}}"><?php echo $this->getString('CONTACTS_EDIT'); ?></a></li>
                    <li><a href="#">Delete</a></li>
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
      <h1><?php echo $this->getString('CONTACTS_ADVANCED_SEARCH');?></h1>
      <contacts-advanced-search-filters>

      </contacts-advanced-search-filters>
      <div class="cardfooter">
        <div class="btn-group pull-right">
          <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('CONTACTS_SUBMIT')?>">
          <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('CONTACTS_RESET')?></button>
        </div>
      </div>
    </form>

    <div ng-if="!sidePanelLoading && !searching">
      <h1><a href="/admin/contacts/edit/{{selectedContact.id}}">{{selectedContact.firstname}} {{selectedContact.lastname}}</a></h1>
      <p>{{selectedContact.title}}</p>
      <p>{{selectedContact.telephone}}</p>
      <p>{{selectedContact.mobile}}</p>
      <p><a href="mailto:{{selectedContact.email}}">{{selectedContact.email}}</a></p>
      <h3><?php echo $this->getString('CONTACTS_ADDRESS')?></h3>
      <p>{{selectedContact.city}}</p>
      <p>{{selectedContact.postalCode}}</p>
      <h4><?php echo $this->getString('CONTACTS_NOTES')?></h3>
      <p>{{selectedContact.notes}}</p>
      <h4><?php echo $this->getString('CONTACTS_COMPANY_INFO')?></h3>
      <p>{{selectedCompany.name}}</p>
      <p>{{selectedCompany.address1}}</p>
      <p>{{selectedCompany.city}}</p>
      <p>{{selectedCompany.telephone}}</p>
      <p>{{selectedCompany.fax}}</p>
      <p>{{selectedCompany.url}}</p>
    </div>
  </div>
  <div class="clearfix"></div>
  <form class="hidden"></form>
</div>
