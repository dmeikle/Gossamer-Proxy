<header>
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
          if (!array_key_exists('section', $item)) {
            //first check for top parent nav items
            if (array_key_exists('active', $item) && $item['active'] == false) {
              //it's not active (do not display) but during development let's see everything
              //we can remove this line when we are ready to hide them from the real users
              ?>
              <li title="disabled on this release">
                <a class="disabled">
                  <?php echo $this->getString($item['text_key']); ?>
                </a>
              </li>
              <?php
              continue;
            }

            //before drawing the link, determine if we need a caret or not
            $hasChildren = array_key_exists('children', $item);
            $caret = $hasChildren ? ' <span class="caret"></span>' : '';

            //now, let's display the link for the top parent item nav
            if (!$hasChildren) { ?>
              <li><a href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a></li>

            <?php } else { ?>
              <li class='dropdown'>
                <?php if (array_key_exists('pattern', $item) && strlen($item['pattern']) > 0) { ?>
                  <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo $item['pattern']; ?>">
                    <?php echo $this->getString($item['text_key']) . $caret; ?>
                  </a>
                <?php } else { ?>
                  <a class="dropdown-toggle" data-toggle="dropdown">
                    <?php echo $this->getString($item['text_key']) . $caret; ?>
                  </a>
                <?php } ?>
                <ul class="dropdown-menu">
                    <?php
                      foreach ($item['children'] as $childKey => $childItem) {
                        if (array_key_exists('active', $childItem) && $childItem['active'] == false) {
                            //it's not active (do not display) but during development let's see everything
                            //we can remove this line when we are ready to hide them from the real users
                            ?>
                            <li title="disabled on this release"><?php echo $this->getString($childItem['text_key']); ?></li>
                            <li class="divider" role="separator"></li>
                            <?php
                            continue;
                        } elseif (array_key_exists('children', $childItem)) {
                          ?>
                          <li class="dropdown-header">
                            <?php echo $this->getString($childItem['text_key']); ?>
                            <li>
                              <a href="<?php echo $childItem['pattern']; ?>">
                                <?php echo $this->getString($childItem['text_key']); ?>
                              </a>
                            </li>
                            <?php
                              foreach ($childItem['children'] as $subChildKey => $subChildItem) {
                                ?>
                                <li>
                                  <a href="<?php echo $subChildItem['pattern']; ?>">
                                    <?php echo $this->getString($subChildItem['text_key']); ?>
                                  </a>
                                </li>
                                <?php
                              }
                             ?>
                            <li class="divider" role="separator"></li>
                          </li>
                          <?php
                          continue;
                        }?>
                        <li>
                          <a href="<?php echo $childItem['pattern']; ?>">
                            <?php echo $this->getString($childItem['text_key']); ?>
                          </a>
                        </li>
                      <?php } ?>
                </ul><!--- close child ul -->
              </li>
            <?php } ?>
          <?php } ?>
        <?php } ?>
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
            <?php
            foreach ($NAVIGATION as $key => $item) {
              if (array_key_exists('section', $item) && $item['section'] == 'usermenu') {
                //first check for top parent nav items
                if (array_key_exists('active', $item) && $item['active'] == false) {
                  //it's not active (do not display) but during development let's see everything
                  //we can remove this line when we are ready to hide them from the real users
                  ?>
                  <li title="disabled on this release">
                    <a class="disabled">
                      <?php echo $this->getString($item['text_key']); ?>
                    </a>
                  </li>
                  <?php
                  continue;
                }

                //before drawing the link, determine if we need a caret or not
                $hasChildren = array_key_exists('children', $item);
                $caret = $hasChildren ? ' <span class="caret"></span>' : '';

                //now, let's display the link for the top parent item nav
                if (!$hasChildren) { ?>
                  <li><a href="<?php echo $item['pattern']; ?>"><?php echo $this->getString($item['text_key']) . $caret; ?></a></li>
                  <li class="divider" role="separator"></li>
                <?php } elseif ($hasChildren) {
                  ?>
                  <li class="dropdown-header">
                    <?php echo $this->getString($item['text_key']); ?>
                    <li>
                      <a href="<?php echo $item['pattern']; ?>">
                        <?php echo $this->getString($item['text_key']); ?>
                      </a>
                    </li>
                    <?php
                    foreach ($item['children'] as $childKey => $childItem) {
                    ?>
                    <li>
                      <a href="<?php echo $childItem['pattern']; ?>">
                        <?php echo $this->getString($childItem['text_key']); ?>
                      </a>
                    </li>
                  <?php } ?>
                  <li class="divider" role="separator"></li>
                </li>
              <?php } ?>
            <?php } ?>
            <?php } ?>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>
