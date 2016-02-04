<nav id="side-nav" ng-controller="sideNavCtrl" ng-class="{'closed': sideNavOpen == false}" ng-cloak>

    <ul class="nav-list" ng-show="sideNavOpen == true" ng-controller="tabsCtrl">
        <?php
        foreach ($NAVIGATION as $key => $item) {
            //first check for top parent nav items
            if (array_key_exists('active', $item) && $item['active'] == false) {
                //it's not active (do not display) but during development let's see everything
                //we can remove this line when we are ready to hide them from the real users

                continue;
            }

            //before drawing the link, determine if we need a caret or not
            $hasChildren = array_key_exists('children', $item);
            $caret = $hasChildren ? ' <span class="caret"></span>' : '';

            //now, let's display the link for the top parent item nav
            if (!$hasChildren) {
                if (array_key_exists('ng-click', $item)) {
                    $tmp = str_replace('text_key', $this->getString($item['text_key']), $item['ng-click']);
                    $ngLink = str_replace('template', $this->getString($item['template']), $tmp);

                    //no children, has ng-click
                    ?>
                    <li class="nav-item">
                        <a ng-click="<?php echo $ngLink; ?>"><?php echo $this->getString($item['text_key']) ?></a></li>
                    <?php
                } else {
                    //no children, no ng-click
                    ?>
                    <li class="nav-item"><span><a href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']) ?></a></span></li>
                    <?php
                }
                ?>
            <?php } else { ?>
                <li class="nav-item has-sub-items"><span ng-click="toggleSubnav($event)"><?php echo $this->getString($item['text_key']) ?></span>
                    <ul class="sub-item">
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
                            if (array_key_exists('ng-click', $childItem) && $this->getViewType() == 'tabbed') {
                                $tmp = str_replace('text_key', $this->getString($childItem['text_key']), $childItem['ng-click']);
                                $ngLink = str_replace('template', $this->getString($childItem['template']), $tmp);
                                //is a child, has ng-click
                                ?>
                                <li><span><a ng-click="<?php echo $ngLink; ?>"><?php echo $this->getString($childItem['text_key']) ?></a></span></li>
                                <?php
                            } else {
                                //is a child, no ng-click
                                if (array_key_exists('state', $childItem)) {
                                    ?>
                                    <li><a ui-sref="<?php echo $childItem['state']; ?>"><?php echo $this->getString($childItem['text_key']); ?></a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?php echo $childItem['pattern']; ?>"><?php echo $this->getString($childItem['text_key']); ?></a></li>
                                    <?php
                                }
                            }
                            ?>

                        <?php }
                        ?>
                    </ul><!--- close child ul -->
                </li>
                <?php
            }
        }
        ?>
    </ul>
    <div class="nav-toggle" ng-click="toggleSidenav()">
        <span ng-if="!sideNavOpen" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span ng-if="sideNavOpen" class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    </div>
</nav>