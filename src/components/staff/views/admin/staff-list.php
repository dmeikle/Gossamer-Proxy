<div class="widget" ng-controller="staffListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
        <h1 class="pull-left">Staff List</h1>
        <div ng-hide="grouped" class="toolbar form-inline">
            <button class="btn-link" ng-click="openStaffAdvancedSearch()">
                <?php echo $this->getString('STAFF_ADVANCED_SEARCH') ?>
            </button>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input type="text" ng-model="basicSearch.query.name" ng-model-options="{debounce:500}"
                    ng-change="search(basicSearch.query)" class="form-control">
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
            <a href="/admin/staff/edit/0" class="btn btn-primary"><?php echo $this->getString('STAFF_NEW'); ?></a>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'firstname'" column-sortable data-column="firstname"><?php echo $this->getString('STAFF_FIRSTNAME'); ?></th>
                    <th ng-hide="groupedBy === 'lastname'" column-sortable data-column="lastname"><?php echo $this->getString('STAFF_LASTNAME'); ?></th>
                    <th ng-hide="groupedBy === 'title'" column-sortable data-column="title"><?php echo $this->getString('STAFF_TITLE'); ?></th>
                    <th ng-hide="groupedBy === 'telephone'" column-sortable data-column="telephone"><?php echo $this->getString('STAFF_EXTENSION'); ?></th>
                    <th ng-hide="groupedBy === 'mobile'" column-sortable data-column="mobile"><?php echo $this->getString('STAFF_MOBILE'); ?></th>
                    <th ng-hide="groupedBy === 'status'" column-sortable data-column="status"><?php echo $this->getString('STAFF_STATUS'); ?></th>
                    <th ng-hide="groupedBy === 'lastLogin'" column-sortable data-column="lastLogin"><?php echo $this->getString('STAFF_LAST_LOGIN'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody ng-if="loading">
                <tr>
                    <td ng-hide="groupedBy === 'firstname'"></td>
                    <td ng-hide="groupedBy === 'lastname'"></td>
                    <td ng-hide="groupedBy === 'title'"></td>
                    <td ng-hide="groupedBy === 'telephone'">
                        <span class="spinner-loader"></span>
                    </td>
                    <td ng-hide="groupedBy === 'mobile'"></td>
                    <td ng-hide="groupedBy === 'status'"></td>
                    <td ng-hide="groupedBy === 'lastLogin'"></td>
                    <td>&nbsp;</td>
                </tr>
            </tbody>
            <tbody>
                <tr ng-if="!loading && grouped && staff[groupedBy] !== staffList[$index - 1][groupedBy]" ng-repeat-start="staff in staffList">
                    <th colspan="7">
                        <span ng-if="groupedBy === 'firstname'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_FIRSTNAME'); ?>
                        </span>
                        <span ng-if="groupedBy === 'lastname'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_LASTNAME'); ?>
                        </span>
                        <span ng-if="groupedBy === 'title'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_TITLE'); ?>
                        </span>
                        <span ng-if="groupedBy === 'extension'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_EXTENSION'); ?>
                        </span>
                        <span ng-if="groupedBy === 'mobile'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_MOBILE'); ?>
                        </span>
                        <span ng-if="groupedBy === 'status'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_STATUS'); ?>
                        </span>
                        <span ng-if="groupedBy === 'lastLogin'">
                            <?php echo $this->getString('STAFF_GROUPEDBY_LASTLOGIN'); ?>
                        </span>
                        {{staff[groupedBy]}}
                    </th>
                </tr>
                <tr ng-if="!loading" ng-repeat-end
                    ng-class="{'selected': staff === previouslyClickedObject, 'inactive bg-warning text-warning': staff.status == 'inactive'}">
                    <td ng-hide="groupedBy === 'firstname'" ng-click="selectRow(staff)">{{staff.firstname}}</td>
                    <td ng-hide="groupedBy === 'lastname'" ng-click="selectRow(staff)">{{staff.lastname}}</td>
                    <td ng-hide="groupedBy === 'title'" ng-click="selectRow(staff)">{{staff.title}}</td>
                    <td ng-hide="groupedBy === 'telephone'" ng-click="selectRow(staff)">{{staff.telephone}}</td>
                    <td ng-hide="groupedBy === 'mobile'" ng-click="selectRow(staff)">{{staff.mobile}}</td>
                    <td ng-hide="groupedBy === 'status'" ng-click="selectRow(staff)">{{staff.status}}</td>
                    <td ng-hide="groupedBy === 'lastLogin'" ng-click="selectRow(staff)">{{staff.lastLogin}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a href="/admin/staff/edit/{{staff.id}}"><?php echo $this->getString('EDIT') ?></a></li>
                                <li><a href="#" ng-click="removeStaff(staff)"><?php echo $this->getString('REMOVE') ?></a></li>
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

        <div ng-if="searching">
            <h1><?php echo $this->getString('STAFF_ADVANCED_SEARCH'); ?></h1>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>
        <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
            <advanced-search-filters data-service="staffListSrv">

            </advanced-search-filters>
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('STAFF_SUBMIT') ?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('STAFF_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <h1><a href="/admin/staff/edit/{{selectedStaff.id}}">{{selectedStaff.firstname}} {{selectedStaff.lastname}}</a></h1>
            <h3><?php echo $this->getString('STAFF_TELEPHONE') ?></h3>
            <p>{{selectedStaff.telephone}}</p>
            <h3><?php echo $this->getString('STAFF_MOBILE') ?></h3>
            <p>{{selectedStaff.mobile}}</p>
            <h3><?php echo $this->getString('STAFF_EMAIL') ?></h3>
            <p>{{selectedStaff.email}}</p>
            <h3><?php echo $this->getString('STAFF_CITY') ?></h3>
            <p>{{selectedStaff.city}}</p>
            <h3><?php echo $this->getString('STAFF_POSTALCODE') ?></h3>
            <p>{{selectedStaff.postalCode}}</p>
            <h3><?php echo $this->getString('STAFF_TITLE') ?></h3>
            <p>{{selectedStaff.title}}</p>
            <h3><?php echo $this->getString('STAFF_EMPLOYEENUM') ?></h3>
            <p>{{selectedStaff.employeeNumber}}</p>
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
