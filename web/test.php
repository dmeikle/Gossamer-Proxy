
<!DOCTYPE html>
<html lang="en">
    <!-- admin-2cols -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>|title|</title>



        <!-- css import for page -->
        <link rel="stylesheet" href="/css/core.min.css">

        <!-- css start -->
        <link href="/css/components/claims/dist/css/claims.min.css" rel="stylesheet">
        <link href="/css/extensions/angular/dist/bower_components/dropzone/dist/dropzone.css" rel="stylesheet">

        <!-- css end -->

        <!-- head start -->
        <script language="javascript" src="/js/components/claims/dist/bower_components/angular/angular.min.js"></script>
        <script language="javascript" src="/js/components/claims/dist/bower_components/jquery/dist/jquery.min.js"></script>
        <script language="javascript" src="/js/components/claims/dist/bower_components/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
        <script language="javascript" src="/js/components/claims/dist/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
        <script language="javascript" src="/js/extensions/angular/dist/bower_components/dropzone/dist/min/dropzone.min.js"></script>

        <!-- head end -->


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
              <![endif]-->
    </head>

    <body cz-shortcut-listen="true">

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
                        <li class="dropdown" id="messages">
                            <span class="glyphicon glyphicon-envelope-over"></span>
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
                                <li><a ng-click="setTabbedView('tabbed')">Toggle View</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="tab-container" ng-controller="sideNavCtrl" ng-class="{'sideNavClosed': sideNavOpen == false}">
            <div id="tabs" ng-controller="tabsCtrl" ng-cloak class="hide">
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

        <nav id="side-nav" ng-controller="sideNavCtrl" ng-class="{'closed': sideNavOpen == false}">

            <ul class="nav-list" ng-show="sideNavOpen == true" ng-controller="tabsCtrl">
                <li class="nav-item"><span><a href="/restoration/services">Services</a></span></li>
                <li class="nav-item"><span><a href="/portal/entrance">Login</a></span></li>
                <li class="nav-item"><span><a href="/blogs/0/20">Blog</a></span></li>
                <li class="nav-item"><span><a href="/contact/contactus">Contact</a></span></li>
                <li class="nav-item"><span><a href="/restoration/frequently-asked-restoration-questions">FAQ</a></span></li>
                <li class="nav-item"><span><a href="/restoration/about-phoenix-restorations">About Us</a></span></li>
            </ul>
            <div class="nav-toggle" ng-click="toggleSidenav()">
                <span ng-if="!sideNavOpen" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span ng-if="sideNavOpen" class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            </div>
        </nav>
        <div class="notification-area" role="alert" id="notificationArea" ng-controller="toastsCtrl">
            <div ng-repeat="alert in alerts" class="alert clearfix"
                 ng-class="{'alert-success':alert.type === 'success', 'alert-info':alert.type === 'info',
            'alert-warning':alert.type === 'warning', 'alert-danger':alert.type === 'error',
            'alert-closed':!alert.message}">
                <p class="pull-left">{{alert.message}}</p>
                <button class="pull-right close" ng-click="dismissAlert($index)"><span class="glyphicon glyphicon-remove"></span></button>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">

                <div class="cards">

                    claim type: Water Damage<br>

                    <div class="cardleft">
                        <h1>building name here</h1>
                        strata number here<br>
                        1233 main st<br>
                        Vancouver, BC<br>
                        v3v 3v3<br>
                        here are some notes about the building
                    </div>
                    <div class="cardright">
                        called in by steve martin<br>
                        604-123-1233<br>
                        alternate: martin short<br>
                        123-123-1233<br>
                    </div>
                    <div class="clearfix"></div>


                    <div class="clearfix"></div>


                    <h3>Units within the claim</h3>
                    1204<br>
                    1205<br>
                    1104<br>
                    1105<br>
                    1004<br>
                    1005<br>





                </div>

            </div>
        </div>
        <div class="clearfix"></div>
        <footer ng-controller="sideNavCtrl" ng-class="{'sideNavClosed': sideNavOpen == false}">
            <div class="wrapper">
                <div id="footerNav">
                    <ul>
                        <li><a href="terms.htm">terms of service</a></li> |
                        <li><a href="privacy.htm">privacy policy</a></li>
                    </ul>
                </div>
                Copyright (c) 2015 phoenixrestorations.com.
                All Rights Reserved. |
                Powered By GossamerCMS framework
            </div>
        </footer>

    </body>

    <script language="javascript" src="/js/extensions/angular/dist/js/angular-extension.concat.js"></script>
    <script language="javascript" src="/js/components/claims/dist/js/claims.concat.js"></script>


    <script language="javascript">
            (function () {
                angular.bootstrap(document, ['rootApp', 'claimsAdmin']);
            })();
    </script>

</html>
