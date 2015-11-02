

<!--- javascript start --->

@components/cssmenu/includes/js/script.js

<!--- javascript end --->


<!--- css start --->

@components/cssmenu/includes/css/styles.css

<!--- css end --->
<div id="ceilingbar">
    <div id='cssmenu'>
        <ul>
            <?php
            foreach ($NAVIGATION as $navItem) {
                if (array_key_exists('children', $navItem)) {
                    ?>
                    <li class='has-sub'><a href='<?php echo $navItem['pattern']; ?>'><span><?php echo $this->getString($navItem['text_key']); ?></span></a>
                        <ul>
                            <?php foreach ($navItem['children'] as $subnavItem) { ?>
                                <li><a href='<?php echo $subnavItem['pattern']; ?>'><span><?php echo $subnavItem['text_key']; ?></span></a></li>
                            <?php } ?>
                        </ul>
                    </li>

                <?php } else { ?>
                    <li class='active'><a href='<?php echo $navItem['pattern']; ?>'><span><?php echo $this->getString($navItem['text_key']); ?></span></a></li>
                                <?php
                            }
                        }
                        ?>

        </ul>
    </div>
</div>