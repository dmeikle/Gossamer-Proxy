<div class="widget" ng-controller="bugsListCtrl as ctrl">
    <div class="widget-content" ng-class="{'panel-open': ctrl.sidePanelOpen}">
        <h1 class="pull-left"><?php echo $this->getString('BUGS_LIST'); ?>
            <span ng-if="ctrl.loading">
                <loading-spinner class="action-spinner blue"></loading-spinner>
            </span>
        </h1>
        <div ng-hide="grouped" class="toolbar form-inline">
            <button class="btn-link" ng-click="ctrl.openAdvancedSearch()">
                <?php echo $this->getString('BUGS_ADVANCED_SEARCH') ?>
            </button>

            <div  class="input-group">
                <input type="text" ng-model="basicSearch.name" ng-model-options="{debounce:500}"
                       ng-change="ctrl.search(basicSearch)" class="form-control">
                <span class="input-group-btn" ng-if="!ctrl.searchSubmitted">
                    <button type="submit" class="btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
                <span ng-if="ctrl.searchSubmitted" class="input-group-btn">
                    <button type="reset" class="btn-default" ng-click="ctrl.resetSearch()">
                        <span class="glyphicon glyphicon-remove"></span>
                    </button>
                </span>
            </div>

        </div>


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th ng-hide="groupedBy === 'ticketId'" column-sortable data-column="ticketId"><?php echo $this->getString('BUGS_TICKET_ID'); ?></th>
                    <th ng-hide="groupedBy === 'subject'" column-sortable data-column="firstname"><?php echo $this->getString('BUGS_SUBJECT'); ?></th>
                    <th ng-hide="groupedBy === 'comments'" column-sortable data-column="lastname"><?php echo $this->getString('BUGS_COMMENTS'); ?></th>
                    <th ng-hide="groupedBy === 'staff'" column-sortable data-column="title"><?php echo $this->getString('BUGS_STAFF'); ?></th>
                    <th ng-hide="groupedBy === 'lastModified'" column-sortable data-column="telephone"><?php echo $this->getString('BUGS_DATE'); ?></th>
                    <th ng-hide="groupedBy === 'status'" column-sortable data-column="status"><?php echo $this->getString('BUGS_STATUS'); ?></th>
                    <th group-by-button class="cog-col row-controls"></th>
                </tr>
            </thead>
            <tbody ng-if="loading">
                <tr>
                    <td colspan="6" align="center">
                        <span>                             <loading-spinner class="table-spinner blue"></loading-spinner>                         </span>
                    </td>
                </tr>
            </tbody>
            <tbody>
                <tr ng-if="!loading && grouped && bug[groupedBy] !== ctrl.bugList[$index - 1][groupedBy]" ng-repeat-start="bug in ctrl.bugList">
                    <th colspan="8">
                        <span ng-if="groupedBy === 'ticketId'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_TICKET_ID'); ?>
                        </span>
                        <span ng-if="groupedBy === 'subject'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_FIRSTNAME'); ?>
                        </span>
                        <span ng-if="groupedBy === 'comments'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_LASTNAME'); ?>
                        </span>
                        <span ng-if="groupedBy === 'staff'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_TITLE'); ?>
                        </span>
                        <span ng-if="groupedBy === 'lastModified'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_EXTENSION'); ?>
                        </span>
                        <span ng-if="groupedBy === 'status'">
                            <?php echo $this->getString('BUGS_GROUPEDBY_MOBILE'); ?>
                        </span>
                        {{bug[groupedBy]}}
                    </th>
                </tr>
                <tr ng-if="!loading" ng-repeat-end
                    ng-class="{'selected': bug === previouslyClickedObject, 'inactive bg-warning text-warning': bug.status == 'inactive'}">
                    <td ng-hide="groupedBy === 'ticketId'" ng-click="ctrl.selectRow(bug)">{{bug.ticketId}}</td>
                    <td ng-hide="groupedBy === 'subject'" ng-click="ctrl.selectRow(bug)">{{bug.subject}}</td>
                    <td ng-hide="groupedBy === 'comments'" ng-click="ctrl.selectRow(bug)">{{bug.comments}}</td>
                    <td ng-hide="groupedBy === 'staff'" ng-click="ctrl.selectRow(bug)">{{bug.staff}}</td>
                    <td ng-hide="groupedBy === 'lastModified'" ng-click="ctrl.selectRow(bug)">{{bug.lastModified}}</td>
                    <td ng-hide="groupedBy === 'status'" ng-click="ctrl.selectRow(bug)">{{bug.status}}</td>
                    <td class="row-controls">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                    id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                            <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                                <li><a ng-click="dashCtrl.go('bugs_edit_home', {'id': bug.id}, bug.ticketId)"><?php echo $this->getString('BUGS_EDIT') ?></a></li>
                                <li><a href="#" ng-click="ctrl.removeBug(bug)"><?php echo $this->getString('BUGS_REMOVE') ?></a></li>
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
            <button class="btn-link" ng-click="ctrl.closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>

        <div ng-if="searching">
            <h1><?php echo $this->getString('BUGS_ADVANCED_SEARCH'); ?></h1>
        </div>
        <div ng-if="ctrl.sidePanelLoading">
            <span>                             <loading-spinner class="table-spinner blue"></loading-spinner>                         </span>
        </div>
        <form ng-if="!ctrl.sidePanelLoading && ctrl.searching" ng-submit="ctrl.search(advancedSearch.query)">

            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('BUGS_SUBMIT') ?>">
                    <button class="btn-default" ng-click="ctrl.resetAdvancedSearch()"><?php echo $this->getString('BUGS_RESET') ?></button>
                </div>
            </div>
        </form>

        <div ng-if="!ctrl.sidePanelLoading && !ctrl.searching">


            <!--<div class="card" >-->
            <h1> <a ng-click="dashCtrl.go('bugs_edit_home', {'id': ctrl.selectedBug.id}, ctrl.selectedBug.ticketId)"><?php echo $this->getString('BUGS_TICKET'); ?> {{ctrl.selectedBug.ticketId}}</a></h1>


            <div ng-if="ctrl.loading">
                <span><loading-spinner class="table-spinner blue"></loading-spinner></span>
            </div>

            <div class="clearfix"></div>

            <ul class="sp-list">
                <!--                <li class="sp-list-item" ng-if="ctrl.selectedBug.ticketId">
                                    <div  class="sp-list-item-content">
                                        <span class="sp-list-title"><?php // echo $this->getString('BUGS_TICKET_ID');    ?></span>
                                        <span class="sp-list-secondary">{{ctrl.selectedBug.ticketId}}</span>
                                    </div>
                                </li>-->
                <li class="sp-list-item" ng-if="ctrl.selectedBug.subject">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_SUBJECT'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.subject}}</span>
                    </div>
                </li>
                <li class="sp-list-item">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_STAFF'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.staff}}</span>
                    </div>
                </li>
                <li class="sp-list-item" ng-if="ctrl.selectedBug.comments">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_COMMENTS'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.comments}}</span>
                    </div>
                </li>
                <li class="sp-list-item" ng-if="ctrl.selectedBug.message">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_ERROR_MESSAGE'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.message}}</span>
                    </div>
                </li>
                <li class="sp-list-item" ng-if="ctrl.selectedBug.currentURL">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_CURRENT_URL'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.currentURL}}</span>
                    </div>
                </li>
                <li class="sp-list-item" ng-if="ctrl.selectedBug.refererURL">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_REFERER_URL'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.refererURL}}</span>
                    </div>
                </li>
                <li class="sp-list-item" ng-if="ctrl.selectedBug.notes">
                    <div  class="sp-list-item-content">
                        <span class="sp-list-title"><?php echo $this->getString('BUGS_NOTES'); ?></span>
                        <span class="sp-list-secondary">{{ctrl.selectedBug.notes}}</span>
                    </div>
                </li>
            </ul>

            <div class="clearfix"></div>
            <!--</div>-->
        </div>
    </div>
    <div class="clearfix"></div>
    <form class="hidden"></form>
</div>
