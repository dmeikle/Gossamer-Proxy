<header ng-controller="tabsCtrl">

    <nav>
        <div class="navbar-header" >
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

            <!--<ul class="navbar-right" ng-controller="messagingSocketCtrl as msgCtrl">-->
            <ul class="navbar-right">


                <li class="dropdown" id="context-button">
                    <!---context-button--->
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
