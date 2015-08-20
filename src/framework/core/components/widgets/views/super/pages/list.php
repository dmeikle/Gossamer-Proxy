<!--- javascript start --->

@/components/widgets/widgets.concat.js

<!--- javascript end --->

<!--- css start --->

@/assets/css/widgets.min.css

<!--- css end --->

<div class="widget" ng-controller="pageTemplatesCtrl">
  <div class="row">
    <h1 class="pull-left"><?php echo $this->getString('WIDGET_PAGE_TITLE'); ?></h1>
    <button class="pull-right" ng-click="addNewPageTemplate()">
      <?php echo $this->getString('WIDGET_PAGE_NEW'); ?>
    </button>
  </div>

  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th><?php echo $this->getString('WIDGET_PAGE_NAME'); ?></th>
        <th><?php echo $this->getString('WIDGET_PAGE_DESCRIPTION'); ?></th>
        <th><?php echo $this->getString('WIDGET_PAGE_YAML_KEY'); ?></th>
        <th><?php echo $this->getString('WIDGET_PAGE_IS_SYSTEM'); ?></th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="template in pageTemplatesList">
        <td>
          <a href="#" ng-click="editTemplate(template)">
            {{template.name}}
          </a>
        </td>
        <td>
          {{template.description}}
        </td>
        <td>
          {{template.ymlKey}}
        </td>
        <td>
          <input type="checkbox" ng-model="template.isSystemPage" ng-true-value="'1'" disabled="">
        </td>
        <td>
          <div class="btn-group" dropdown>
            <button type="button" class="btn" ng-click="editPageTemplate(template)"><?php echo $this->getString('WIDGET_PAGE_EDIT'); ?></button>
            <button type="button" class="btn" dropdown-toggle>
              <span class="caret"></span>
              <span class="sr-only"><?php echo $this->getString('WIDGET_PAGE_MORE'); ?></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="split-button">
              <li role="menuitem"><a href="#" ng-click="deletePageTemplate(template)"><?php echo $this->getString('WIDGET_PAGE_DELETE'); ?></a></li>
            </ul>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
  <pagination total-items="totalItems" ng-model="currentPage" max-size="itemsPerPage"
    class="pagination" boundary-links="true" rotate="false">
  </pagination>
  <form class="hidden"></form>
</div>
