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
                        if(array_key_exists('ng-click', $item)) {
                            $tmp = str_replace('text_key', $this->getString($item['text_key']),  $item['ng-click']);
                            $ngLink = str_replace('template', $this->getString($item['template']),  $tmp);
                            ?>
                            <li><a ng-click="<?php echo $ngLink; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a></li>
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
                                    if(array_key_exists('ng-click', $childItem)) {
                                         $tmp = str_replace('text_key', $this->getString($childItem['text_key']),  $childItem['ng-click']);
                                        $ngLink = str_replace('template', $this->getString($childItem['template']),  $tmp);
                                        ?>
                                        <li><a ng-click="<?php echo $ngLink; ?>"><?php echo $this->getString($childItem['text_key']) . $caret; ?></a></li>
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
        <tab sortable-tab ng-repeat="tab in tabs track by $index" active="tab.active" disable="tab.disabled">
            <tab-heading>{{tab.title}}<span ng-click="closeTab($index)" class='close-tab glyphicon glyphicon-remove'></span></tab-heading>
            <div ng-if="tab.loading" class="tab-loader"><span class="spinner-loader"></span></div>
            <div ng-include="tab.template" onload="hideSpinner(tab)"></div>
        </tab>
    </tabset>
</div>