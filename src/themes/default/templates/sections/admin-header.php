<header ng-controller="tabsCtrl">
    <nav>
        <div class="navbar-header" ng-controller="StateCtrl as vm">
            <button type="button" class="navbar-toggle collapsed primary" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="/" class="navbar-brand">
                <img class="default-logo" src="/images/logo.png" alt="Logo">
            </a>
            <loading-spinner ng-if="vm.loading"></loading-spinner>
        </div>


        <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">


            <ul class="navbar-right">
                <li class="dropdown" id="reminders">

                </li>
                <li class="dropdown" id="messages" style="margin-right: 15px;" ngcontroller="messagingSocketCtrl">
                    <input type="hidden" id="MESSAGING_TOKEN" value="<?php echo $MESSAGING_TOKEN; ?>" />
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-envelope" style="color:antiquewhite"></span>
                    </a>
                    <span style="float: right; margin-top: -25px;">4</span>
                    <ul class="dropdown-menu">
                        <li class="message-count"><p>You have 4 new messages</li>
                        <li role="separator" class="divider"></li>
                        <li class="message-alert">
                            <a href="#">
                                <div class="sender">Samantha Carter</div>
                                <div class="subject">re: Approved proposal</div>
                                <div class="receiveTime">just now</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="message-alert">
                            <a href="#">
                                <div class="sender">Samantha Carter</div>
                                <div class="subject">re: Approved proposal</div>
                                <div class="receiveTime">just now</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="message-alert">
                            <a href="#">
                                <div class="sender">Samantha Carter</div>
                                <div class="subject">re: Approved proposal</div>
                                <div class="receiveTime">just now</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="view-all">
                            <p>
                                <a gcms="{uri='admin_messaging_home'}">See all messages
                                    <i class="glyphicon glyphicon-circle-arrow-right icon-size-small"></i>
                                </a>
                            </p>
                        </li>
                    </ul>
                </li>
                <li class="dropdown" id="notifications">

                </li>
                <li class="dropdown" id="context-button">
                    <!---context-button--->
                </li>
                <li ng-controller="bugsEditCtrl as bugCtrl" class="dropdown" id="bugs">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span><img src="/images/web-icons/bug-report-24.png" /></span>
                        <!--<i class="glyphicon glyphicon-bug icon-size-small"></i>-->
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ng-click="bugCtrl.displayForm()">submit a bug report</a></li>
                        <li><a ng-click="dashCtrl.go('bugs_list_home', null, 'View Bugs')">view bugs</a></li>

                    </ul>
                    <form></form>
                    <div id="bugform" ng-show="bugCtrl.display" class="whiteframe-z2">
                        <div>
                            <!--<img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/1/000/12b/1f4/1636c7e.jpg">-->
                            <button class="btn-link pull-right" ng-click="bugCtrl.cancel()"><span class="glyphicon glyphicon-remove"></span></button>
                            <h3>Submit a Bug Report</h3>
                        </div>
                        <div class="clearfix"></div>
                        <input type="hidden" ng-model="bug.BugTypes_id" ng-init="bug.BugTypes_id = 1" />
                        <!--<div class="prompt">Subject</div>-->
                        <!--<div class="field"><input class="form-control" type="text" ng-model="bug.subject" /></div>-->
                        <div class="form-group">
                            <label for="bugSubject">Subject</label>
                            <input class="form-control" type="text" ng-model="bug.subject" placeholder="Subject"/>
                        </div>

                        <div class="form-group">
                            <label for="bugDetails">Details</label>
                            <textarea class="form-control" ng-model="bug.comments" id="bugDetails" placeholder="Describe what happened"></textarea>
                        </div>
                        <!--                        <div class="prompt">Error Message</div>
                                                <div class="field"><textarea class="form-control" ng-model="bug.errorMessage"></textarea></div>-->
                        <div class="form-group">
                            <label for="errorMessage">Error Message</label>
                            <textarea type="text" class="form-control" id="errorMessage" placeholder="Paste or describe the error message"></textarea>
                        </div>
                        <div class="pull-right">
                            <div class="field">
                                <button class="btn-default" ng-click="bugCtrl.cancel()">Cancel</button>
                                <button class="btn-primary" ng-click="bugCtrl.save(bug)">Submit</button>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="userimage" src="http://placehold.it/25x25" alt=""> User Name <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="#">Your Tickets</a></li>
                        <li><a ng-click="setTabbedView('<?php echo $this->getViewType() == 'tabbed' ? 'html' : 'tabbed'; ?>')">Toggle View</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <input type="hidden" id="viewType" value="<?php echo $this->getViewType(); ?>">
</header>

<div class="tab-container" ng-controller="sideNavCtrl" ng-class="{'sideNavClosed': sideNavOpen == false}">
    <div>
        <div id="tabs" ng-controller="tabsCtrl" ng-cloak class="<?php
        if ($this->getViewType() == 'html') {
            echo 'hide';
        }
        ?>">
            <tabset>
                <tab sortable-tab ng-repeat="tab in tabs track by tab.title" active="tab.active" disable="tab.disabled">
                    <tab-heading>{{tab.title}}<span ng-click="closeTab($index)" class='close-tab glyphicon glyphicon-remove'></span></tab-heading>

                    <!--                    <div ng-if="tab.loading" class="tab-loader">
                                            <span><loading-spinner class="table-spinner blue"></loading-spinner></span>
                                        </div>

                                        <div ng-include="tab.template" onload="hideSpinner(tab)" class="tab-include"></div>-->

                    <div ng-if="dashCtrl.tabsLoading[tab.title] === true" class="tab-loader">
                        <span><loading-spinner class="table-spinner blue"></loading-spinner></span>
                    </div>

                    <div ng-include="tab.template" onload="dashCtrl.tabLoaded(tab.title)" class="tab-include"></div>
                    <div>{{tab.content}} {{tab.template}}</div>
                </tab>
            </tabset>
        </div>
    </div>
</div>