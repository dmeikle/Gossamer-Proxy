
<!-- head start 
        src/framework/core/components/widgets/dist/bower_components/angular/angular.min.js
        - src/framework/core/components/widgets/dist/bower_components/jquery/dist/jquery.min.js
        - src/framework/core/components/widgets/dist/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js
        - src/framework/core/components/widgets/dist/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js--->
<!-- head end --->

<!--- javascript start --->

@components/accounting/dist/js/accounting.concat.js

<!--- javascript end --->




<div class="container-fluid" ng-controller="costCardItemTypeCtrl">
  <h1><?php echo $this->getString('WIDGET_TITLE'); ?></h1>
  <div class="row">
    <div class="col-xs-12 col-md-2 col-md-offset-5">
      <button ng-click="addNew()">
        <?php echo $this->getString('WIDGET_NEW'); ?>
      </button>
    </div>
  </div>
  <div class="col-xs-12">
      <div class="table-container">
        <table class="table" id="widgetAdminList">
          <thead>
            <tr>
              <th><?php echo $this->getString('WIDGET_NAME'); ?></th>
              <th>&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="row in costcardItemTypesList" id="{{row.id}}">
              <td>
                <a ng-click="edit(row)">{{row.itemType}}</a>
              </td>
              <td>
                <div class="btn-group" dropdown>
                  <button type="button" class="btn" ng-click="edit(row)">
                    <?php echo $this->getString('WIDGET_EDIT'); ?>
                  </button>
                  <button type="button" class="btn" dropdown-toggle>
                    <span class="caret"></span>
                    <span class="sr-only">
                      <?php echo $this->getString('PAGE_MORE'); ?>
                    </span>
                  </button>
                  <ul class="dropdown-menu" role="menu" aria-labelledby="split-button">
                    <li role="menuitem">
                      <a href="#" ng-click="delete(row)">
                        <?php echo $this->getString('WIDGET_DELETE'); ?>
                      </a>
                    </li>
                  </ul>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <pagination total-items="costcardItemTypesCount" ng-model="currentPage" max-size="rowsPerPage"
          class="pagination" boundary-links="true" rotate="false">
        </pagination>
      </div>
  </div>
</div>
