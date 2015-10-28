<div class="widget" ng-controller="variantOptionsCtrl">
    <div class="widgetheader">
        <h1 class="pull-left"><?php echo $this->getString('INVENTORY_VARIANT_VARIANTOPTIONS') ?></h1>
        <div class="toolbar form-inline">
            <i ng-show="loadingTypeahead" class="glyphicon glyphicon-refresh"></i>

            <form ng-submit="search(basicSearch.query)" class="input-group">
                <input class="form-control" type="text" list="autocomplete-list" ng-model="basicSearch.query.name"
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
            <a href="/admin/inventory/items/0" class="btn btn-primary"><?php echo $this->getString('INVENTORY_NEW'); ?></a>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th column-sortable data-column="locale"></th>
                <th column-sortable data-column="option"></th>
                <th column-sortable data-column="code"></th>
                <th column-sortable data-column="surcharge"></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr ng-repeat="variant in variantList">
                <td>{{variant.locale}}</td>
                <td>{{variant.option}}</td>
                <td>{{variant.code}}</td>
                <td>{{variant.surcharge}}</td>
                <td class="row-controls">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button"
                                id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                            <li><a href="" ng-click="openEditVariantModal(variant)"><?php echo $this->getString('EDIT') ?></a></li>
                            <li><a href="" ng-click="delete(item)"><?php echo $this->getString('DELETE') ?></a></li>
                        </ul>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>
