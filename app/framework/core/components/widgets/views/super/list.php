<!--- javascript start --->

@/components/widgets/widgets.concat.js

<!--- javascript end --->

<!--- css start --->

@/assets/css/widgets.min.css

<!--- css end --->

<div class="widget" ng-controller="widgetsCtrl">
    <h1 class="pull-left"><?php echo $this->getString('WIDGET_TITLE'); ?></h1>

    <button class="pull-right" ng-click="addNewWidget()">
        <?php echo $this->getString('WIDGET_NEW'); ?>
    </button>
    <div class="col-xs-12">
        <div class="table-container">
            <table class="table" id="widgetAdminList">
                <thead>
                    <tr>
                        <th><?php echo $this->getString('WIDGET_NAME'); ?></th>
                        <th><?php echo $this->getString('WIDGET_COMPONENT'); ?></th>
                        <th><?php echo $this->getString('WIDGET_MODULE'); ?></th>
                        <th><?php echo $this->getString('WIDGET_DESCRIPTION'); ?></th>
                        <th><?php echo $this->getString('WIDGET_HTMLKEY'); ?></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="widget in widgetList" id="{{widget.id}}">
                        <td>
                            <a ng-click="editWidget(widget)">{{widget.name}}</a>
                        </td>
                        <td>
                            {{widget.component}}
                        </td>
                        <td>
                            {{widget.module}}
                        </td>
                        <td>
                            {{widget.description}}
                        <td>
                            {{widget.htmlKey}}
                        </td>
                        <td>
                            <div class="btn-group" dropdown>
                                <button type="button" class="btn" ng-click="editWidget(widget)">
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
                                        <a href="#" ng-click="deleteWidget(widget)">
                                            <?php echo $this->getString('WIDGET_DELETE'); ?>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <pagination total-items="widgetCount" ng-model="currentPage" max-size="widgetsPerPage"
                        class="pagination" boundary-links="true" rotate="false">
            </pagination>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
