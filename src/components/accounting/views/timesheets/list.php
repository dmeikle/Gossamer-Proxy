<div class="widget" ng-controller="timesheetListCtrl">
    <div class="widget-content" ng-class="{'panel-open': sidePanelOpen}">
    <h1 class="pull-left">Timesheet List</h1>
    <div class="clearfix"></div>
    <div class="alert alert-danger" role="alert" ng-if="error.showError" ng-cloak><?php echo $this->getString('ACCOUNTING_TIMESHEET_DB_ERROR') ?></div>
    <div class="pull-left">
        <button class="primary" ng-click="openTimesheetModal('')"><?php echo $this->getString('ACCOUNTING_NEW_TIMESHEET') ?></button><span ng-cloak ng-if="modalLoading" class="modal-spinner spinner-loader"></span>
    </div>
<!--    <div class="pull-right">-->
    <div class="toolbar form-inline">
        <button class="btn-link" ng-click="openTimesheetAdvancedSearch()">
            <?php echo $this->getString('ACCOUNTING_ADVANCED_SEARCH') ?>
        </button>
        
        <form ng-submit="search(basicSearch.query)" class="input-group">
            <input type="text" ng-model="basicSearch.query.name" ng-model-options="{debounce:500}"
                   typeahead="value for value in fetchAutocomplete($viewValue, 'claims')"
                   typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control"
                   typeahead-on-select="staffSearch(basicSearch.query)" typeahead-min-length='3'>
            <div class="resultspane" ng-show="noResults">
                <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('STAFF_NORESULTS') ?>
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
        
      <select class="form-control" name="basicSearchCol" id="basic-search-col" ng-model="basicSearch.col[0]"
        ng-init="basicSearch.col[0] = 'name'">
        <option value="name" ng-selected="true"><?php echo $this->getString('STAFF_NAME');?></option>
        <option value="ext"><?php echo $this->getString('STAFF_EXT');?></option>
        <option value="phone"><?php echo $this->getString('STAFF_PHONE');?></option>
      </select>
        <button class="primary" ng-click="search(basicSearch.query)">
        <?php echo $this->getString('ACCOUNTING_SEARCH') ?>
      </button>
    </div>
    <div class="clearfix"></div>
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th><?php echo $this->getString('ACCOUNTING_LABORER'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_CLAIM'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_HOURLY_RATE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_REG'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_OT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_DOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SREG'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_SDOT'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_DATE'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_EXPORTED'); ?></th>
                <th><?php echo $this->getString('ACCOUNTING_TOTAL'); ?></th>
                <th class="cog-col">&nbsp;</th>
            </tr>
        </thead>
        <tbody>
          <tr ng-if="loading">
            <td></td>
            <td></td>
            <td></td>
            <td></td>  
            <td></td>  
            <td></td>
            <td>
              <span class="spinner-loader"></span>
            </td>
            <td></td>  
            <td></td>  
            <td></td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
            <tr ng-if="!loading" ng-repeat="timesheet in timesheetList" ng-class="{'selected': timesheet === previouslyClickedObject}">
              <td ng-click="selectRow(timesheet)">{{timesheet.lastname}}, {{timesheet.firstname}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.numJobs}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.hourlyRate | currency}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.regularHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.overtimeHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.doubleOTHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.statRegularHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.statOTHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.statDoubleOTHours}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.workDate}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.isExported}}</td>
              <td ng-click="selectRow(timesheet)">{{timesheet.totalHours}}</td>
              <td class="row-controls">
                <div class="dropdown">
                  <button class="btn btn-default dropdown-toggle glyphicon glyphicon-cog" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"></button>
                  <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                    <li><a ng-click="openTimesheetModal(timesheet)">Edit</a></li>
                  </ul>
                </div>
              </td>
          </tr>
        </tbody>
    </table>

    <pagination total-items="totalItems" ng-model="currentPage" items-per-page="itemsPerPage" class="pagination" boundary-links="true" rotate="false"></pagination>
    </div>
    
    <div class="widget-side-panel">
        <div class="pull-right">
            <button class="btn-link" ng-click="closeSidePanel()"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div ng-if="sidePanelLoading">
            <span class="spinner-loader"></span>
        </div>

        <form ng-if="!sidePanelLoading && searching" ng-submit="search(advancedSearch.query)">
            <h1><?php echo $this->getString('ACCOUNTING_ADVANCED_SEARCH');?></h1>
            <div id="advancedSearch">
                Advanced Search!
            </div>
            
            <form ng-submit="advancedSearch(advancedSearch.query)" class="input-group">
                <input type="text" ng-model="advancedSearch.query.name" ng-model-options="{debounce:500}"
                       typeahead="value for value in fetchAutocomplete($viewValue)"
                       typeahead-loading="loadingTypeahead" typeahead-no-results="noResults" class="form-control"
                       typeahead-on-select="staffSearch(basicSearch.query)" typeahead-min-length='3'>
                <div class="resultspane" ng-show="noResults">
                    <i class="glyphicon glyphicon-remove"></i> <?php echo $this->getString('STAFF_NORESULTS') ?>
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
            
            <select class="form-control" name="advancedFilters" id="advanced-search-col" ng-model="advSearch"
                    ng-init="advSearch = 'name'">
                <option value="name" ng-selected="true"><?php echo $this->getString('ACCOUNTING_NAME');?></option>
                <option value="date"><?php echo $this->getString('ACCOUNTING_DATE');?></option>
                <option value="claim"><?php echo $this->getString('ACCOUNTING_CLAIM');?></option>
                <option value="phase"><?php echo $this->getString('ACCOUNTING_PHASE');?></option>
            </select>
            
            <div class="cardfooter">
                <div class="btn-group pull-right">
                    <input type="submit" class="btn btn-primary" value="<?php echo $this->getString('ACCOUNTING_SUBMIT')?>">
                    <button class="btn-default" ng-click="resetAdvancedSearch()"><?php echo $this->getString('ACCOUNTING_RESET')?></button>
                </div>
            </div>
        </form>

        <div ng-if="!sidePanelLoading && !searching">
            <div class="breakdown-title">
                <div class="pull-left">
                    <h3><?php echo $this->getString('ACCOUNTING_NAME')?></h3>
                    <p>{{selectedTimesheet.firstname}} {{selectedTimesheet.lastname}}</p>
                </div>
                <div class="pull-right">
                    <h3><?php echo $this->getString('ACCOUNTING_DATE')?></h3>
                    <p>{{selectedTimesheet.workDate}}</p>
                </div>
            </div>
            
            <div class="breakdown-headings">
                <span><strong><?php echo $this->getString('ACCOUNTING_JOB_NUMBER')?></strong></span>
                <span><strong><?php echo $this->getString('ACCOUNTING_HOURLY_RATE')?></strong></span>
                <span><strong><?php echo $this->getString('ACCOUNTING_HOURS')?></strong></span>
            </div>
            <div ng-repeat="claim in timesheetBreakdown">
                <div class="card">
                    <span>{{claim.jobNumber}}</span>
                    <span>{{claim.hourlyRate | currency}}</span>
                    <span>{{claim.totalHours}}</span>
                </div>
            </div>
            <div class="breakdown-hours">
                <span><strong><?php echo $this->getString('ACCOUNTING_TIMESHEET_TOTAL_HOURS')?>:</strong></span>
                <span>{{selectedTimesheet.totalHours}}</span>
            </div>
        </div>
    </div>
    
<div class="clearfix"></div>
</div>
