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

            <!--<ul class="navbar-right" ng-controller="messagingSocketCtrl as msgCtrl">-->
            <ul class="navbar-right">
                <li class="dropdown notification-dropdown" id="messages" ngcontroller="messagingSocketCtrl">
                    <input type="hidden" id="MESSAGING_TOKEN" value="<?php echo $MESSAGING_TOKEN; ?>" />
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-envelope notification-icon"></span>
                    </a>
                    <span class="badge notification-badge">{{msgCtrl.newMessages.length}}</span>
                    <ul class="dropdown-menu">
                        <li class="message-count"><p class="text-primary"><strong>Messages</strong></p></li>
                        <li class="message-alert" ng-repeat="message in msgCtrl.newMessages">
                            <a href="#">
                                <div class="sender"><strong>{{message.sender}}</strong></div>
                                <div class="subject">{{message.subject}}</div>
                                <div class="receiveTime text-muted">{{message.timeSent}}</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="view-all text-center">
                            <a gcms="{uri='admin_messaging_home'}"><p>See all messages <i class="glyphicon glyphicon-chevron-right icon-size-small"></i></p></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown notification-dropdown" id="reminders">
                    <input type="hidden" id="MESSAGING_TOKEN" value="<?php echo $MESSAGING_TOKEN; ?>" />
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon glyphicon-time"></span>
                    </a>
                    <span class="badge notification-badge">{{msgCtrl.newReminders.length}}</span>
                    <ul class="dropdown-menu">
                        <li class="message-count"><p class="text-primary"><strong>Reminders</strong></p></li>
                        <li class="message-alert" ng-repeat="reminder in msgCtrl.newReminders">
                            <a href="#">
                                <div class="subject"><strong>{{reminder.subject}}</strong></div>
                                <div class="receiveTime text-muted">{{reminder.timeSent}}</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="view-all text-center">
                            <a gcms="{uri='admin_messaging_home'}"><p>See all reminders <i class="glyphicon glyphicon-chevron-right icon-size-small"></i></p></i>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown notification-dropdown" id="notifications">
                    <input type="hidden" id="MESSAGING_TOKEN" value="<?php echo $MESSAGING_TOKEN; ?>" />
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-bell"></span>
                    </a>
                    <span class="badge notification-badge">{{msgCtrl.newNotifications.length}}</span>
                    <ul class="dropdown-menu">
                        <li class="message-count"><p class="text-primary"><strong>Notifications</strong></p></li>
                        <li class="message-alert" ng-repeat="notification in msgCtrl.newNotifications">
                            <a href="#">
                                <div class="subject"><strong>{{notification.subject}}</strong></div>
                                <div class="receiveTime text-muted">{{notification.timeSent}}</div>
                                <div class="clearfix"></div>
                            </a>
                        </li>
                        <li class="view-all text-center">
                            <a gcms="{uri='admin_messaging_home'}"><p>See all notifications <i class="glyphicon glyphicon-chevron-right icon-size-small"></i></p></i>
                            </a>
                        </li>
                    </ul>
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
                        <li><a ng-click="bugCtrl.displayForm()">Submit a Bug Report</a></li>
                        <li><a ng-click="dashCtrl.go('bugs_list_home', null, 'Bugs List')">Bugs List</a></li>

                    </ul>
                    <form></form>
                    <div id="bugform" ng-show="bugCtrl.display" class="whiteframe-z2" ng-cloak>
                        <div>
                            <button class="btn-link pull-right" ng-click="bugCtrl.cancel()"><span class="glyphicon glyphicon-remove"></span></button>
                            <h3>Submit a Bug Report</h3>
                        </div>
                        <div class="divider"></div>
                        <div>
                            <img src="https://media.licdn.com/mpr/mpr/shrinknp_400_400/p/1/000/12b/1f4/1636c7e.jpg">
                            <span>Hi! Welcome to live chat. Please enter your bug details here. Phoenix Retina Scan™ coming soon.</span>
                        </div>
                        <div class="divider"></div>
                        <div class="clearfix"></div>
                        <div class="form-group">
                            <label for="bugSubject">Subject</label>
                            <input class="form-control" type="text" ng-model="bugCtrl.newBug.subject" placeholder="Subject"/>
                        </div>

                        <div class="form-group">
                            <label for="bugDetails">Bug Details</label>
                            <textarea class="form-control" ng-model="bugCtrl.newBug.comments" id="bugDetails" placeholder="Describe what happened"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="errorMessage">Error Message</label>
                            <textarea type="text" class="form-control" id="errorMessage" placeholder="Paste or describe the error message" ng-model="bugCtrl.newBug.errorMessage"></textarea>
                        </div>
<!--                        <span class="text-success pull-left" ng-if="!bugCtrl.bugSubmitted">
                            Bug Submitted <i class="glyphicon glyphicon-ok"></i>
                        </span>-->
                        <div class="pull-right">
                            <div class="field">
                                <span >
                                    <loading-spinner class="action-spinner blue align-middle" ng-if="bugCtrl.savingNew"></loading-spinner>
                                    <i class="text-success glyphicon glyphicon-ok submit-icon" ng-if="bugCtrl.bugSubmitted"></i>
                                </span>
                                <button class="btn-default" ng-click="bugCtrl.cancel()"><?php echo $this->getString('CANCEL'); ?></button>
                                <button class="btn-primary" ng-click="bugCtrl.saveNew(bugCtrl.newBug)"><?php echo $this->getString('SUBMIT'); ?></button>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img class="userimage" src="http://placehold.it/25x25" alt=""> {{dashCtrl.client.username}} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a ng-click="dashCtrl.go('admin_staff_edit_home', {'id': dashCtrl.client.Client_id}, dashCtrl.client.username)"><?php echo $this->getString('EDIT_PROFILE'); ?></a></li>
                        <li  permission-key="developer"><a href="#"><?php echo $this->getString('LIST_YOUR_TICKETS'); ?></a></li>
                        <li  permission-key="developer"><a ng-click="setTabbedView('<?php echo $this->getViewType() == 'tabbed' ? 'html' : 'tabbed'; ?>')"><?php echo $this->getString('TOGGLE_VIEW'); ?></a></li>
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
            <uib-tabset>
                <uib-tab sortable-tab ng-repeat="tab in tabs track by tab.title" active="tab.active" disable="tab.disabled">
                    <uib-tab-heading>{{tab.title}}<span ng-click="closeTab($index)" class='close-tab glyphicon glyphicon-remove'></span></uib-tab-heading>

                    <div ng-if="dashCtrl.tabsLoading[tab.title] === true" class="tab-loader">
                        <span><loading-spinner class="table-spinner blue"></loading-spinner></span>
                    </div>

                    <div ng-include="tab.template" onload="dashCtrl.tabLoaded(tab.title)" class="tab-include"></div>
                    <div>{{tab.content}} {{tab.template}}</div>
                </uib-tab>
            </uib-tabset>
        </div>
    </div>
</div>
