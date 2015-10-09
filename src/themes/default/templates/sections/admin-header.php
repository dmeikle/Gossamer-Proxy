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
        <!--
                <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">
                    <ul class="navbar-left">
                        <li><a href="/admin/dashboard" class="active">Home</a></li>
                        <li class="dropdown">
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">Claims <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="/admin/claims">Claims List</a></li>
                                <li><a href="#">Your Claims</a></li>
                                <li><a href="#">New Claim</a></li>
                            </ul>
                        </li>
                        <li><a href="">Accounting</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Directory <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="">Clients</a></li>
                                <li><a href="">Customers</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="/admin/staff">Staff</a>
                        </li>
                    </ul>
        -->


        <div id="bs-example-navbar-collapse" class="collapse navbar-collapse">
            <ul class="navbar-left">
                <?php
                foreach ($NAVIGATION as $key => $item) {
                    //first check for top parent nav items
                    if (array_key_exists('active', $item) && $item['active'] == false) {
                        //it's not active (do not display) but during development let's see everything
                        //we can remove this line when we are ready to hide them from the real users
                        ?>
                        <li title="disabled on this release"><?php echo $this->getString($item['text_key']); ?></li>
                        <?php
                        continue;
                    }

                    //before drawing the link, determine if we need a caret or not
                    $hasChildren = array_key_exists('children', $item);
                    $caret = $hasChildren ? ' <span class="caret"></span>' : '';

                    //now, let's display the link for the top parent item nav
                    if (!$hasChildren) {
                        if(array_key_exists('ng-click', $item)) {?>
                            <li><a ng-click="<?php echo $item['ng-click']; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a></li>
                        <?php 
                        } else {
                        ?>
                        <li><a href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a></li>
                        <?php 
                        } 
                        ?>
                        <?php } else { ?>
                        <li class='dropdown'><a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a>
                            <ul class="dropdown-menu">
                                <?php
                                foreach ($item['children'] as $childKey => $childItem) {
                                    if (array_key_exists('active', $childItem) && $childItem['active'] == false) {
                                        //it's not active (do not display) but during development let's see everything
                                        //we can remove this line when we are ready to hide them from the real users
                                        ?>
                                        <li title="disabled on this release"><?php echo $this->getString($childItem['text_key']); ?></li>
                                        <?php
                                        continue;
                                    }
                                    if(array_key_exists('ng-click', $item)) {?>
                                        <li><a ng-click="<?php echo $childItem['ng-click']; ?>"><?php echo $this->getString($childItem['text_key']) . $caret; ?></a></li>
                                    <?php 
                                    } else {
                                    ?>
                                    <li><a href="<?php echo $childItem['pattern']; ?>"><?php echo $this->getString($childItem['text_key']); ?></a></li>
                                    <?php 
                                    } 
                                    ?>
                                        
                                    <?php }
                                    ?>  
                            </ul><!--- close child ul -->
                        </li>
                        <?php }
                        ?>



                    <?php
                }
                ?>
            </ul>

            <ul class="navbar-right">
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
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<div id="tabs" ng-controller="tabsCtrl" ng-cloak>
    <tabset>
        <tab ng-repeat="tab in tabs track by $index" active="tab.active" disable="tab.disabled">
            <tab-heading>{{tab.title}}<span ng-click="closeTab($index)" class='close-tab glyphicon glyphicon-remove'></span></tab-heading>
            <div ng-if="tab.loading" class="tab-loader"><span class="spinner-loader"></span></div>
            <div ng-include="tab.template" onload="hideSpinner(tab)"></div>
        </tab>
    </tabset>
</div>