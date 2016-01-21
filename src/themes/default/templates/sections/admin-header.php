
<header ng-controller="tabsCtrl">
    <nav>
        <div class="navbar-header">
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
        </div>


        <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">


            <ul class="navbar-right">
                <li class="dropdown" id="reminders">

                </li>
                <li class="dropdown" id="messages" style="margin-right: 15px;">
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
</header>
<div class="tab-container" ng-controller="sideNavCtrl" ng-class="{'sideNavClosed': sideNavOpen == false}">
    <div id="tabs" ng-controller="tabsCtrl" ng-cloak class="<?php
    if ($this->getViewType() == 'html') {
        echo 'hide';
    }
    ?>">
        <tabset>
            <tab sortable-tab ng-repeat="tab in tabs track by tab.title" active="tab.active" disable="tab.disabled">
                <tab-heading>{{tab.title}}<span ng-click="closeTab($index)" class='close-tab glyphicon glyphicon-remove'></span></tab-heading>
                <div ng-if="tab.loading" class="tab-loader"><span class="spinner-loader"></span></div>
                <div ng-include="tab.template" onload="hideSpinner(tab)" class="tab-include"></div>
                <div>{{tab.content}} {{tab.template}}</div>
            </tab>
        </tabset>
    </div>
</div>
