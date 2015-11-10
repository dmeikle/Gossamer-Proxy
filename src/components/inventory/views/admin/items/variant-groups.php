<div class="widget" ng-controller="variantGroupsListCtrl">
    <div class="widgetheader">
        <h1 class="pull-left"><?php echo $this->getString('INVENTORY_VARIANT_VARIANTGROUPS') ?></h1>
        <div class="toolbar form-inline">
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input class="form-control" type="text" ng-model="basicSearch.query.name"
                   ng-model-options="{debounce:500}" ng-change="search(basicSearch.query)">
                <div class="resultspane" ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('INVENTORY_NORESULTS') ?>
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
            <a href="" ng-click="openVariantModal()" class="btn btn-primary"><?php echo $this->getString('INVENTORY_NEW'); ?></a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="locale">
                    <?php echo $this->getString('INVENTORY_VARIANT_LOCALE') ?>
                </th>
                <th column-sortable data-column="name">
                    <?php echo $this->getString('INVENTORY_VARIANT_NAME') ?>
                </th>
                <th column-sortable data-column="code">
                    <?php echo $this->getString('INVENTORY_VARIANT_CODE') ?>
                </th>
                <th class="cog-col"></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-if="loading">
                <td></td>
                <td colspan="2"><span class="spinner-loader"></span></td>
                <td></td>
            </tr>
            <tr ng-if="!loading" ng-repeat="item in groupList">
                <td ng-click="selectRow(item)">{{item.locale}}</td>
                <td ng-click="selectRow(item)">{{item.name}}</td>
                <td ng-click="selectRow(item)">{{item.groupCode}}</td>
                <td class="row-controls">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li><a href="" ng-click="openVariantModal(item)"><?php echo $this->getString('EDIT') ?></a></li>
                            <li><a href="" ng-click="delete(item)"><?php echo $this->getString('DELETE') ?></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>

    <pagination class="pull-left pagination" total-items="totalItems" ng-model="currentPage"
        items-per-page="itemsPerPage" boundary-links="true" rotate="false">
    </pagination>

    <div class="pull-right">
        <p class="pull-left"><?php echo $this->getString('ITEMS_PER_PAGE'); ?></p>
        <ul class="btn-group pull-right">
            <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 10}" ng-click="setItemsPerPage(10)">10</button>
            <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 20}" ng-click="setItemsPerPage(20)">20</button>
            <button type="button" class="btn-link" ng-class="{'active':itemsPerPage === 50}" ng-click="setItemsPerPage(50)">50</button>
        </ul>
    </div>

    <div class="clearfix"></div>
</div>
