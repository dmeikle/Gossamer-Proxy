
<ul id="nav">here
    <?php
    if(!is_null($NAVIGATION)) {
        foreach ($NAVIGATION as $key => $item) {

            if(array_key_exists('active', $item) && $item['active'] == false) {
                ?>
                <li title="disabled on this release"><?php echo $this->getString($item['text_key']);?></li>
                <?php
                continue;
            }
    ?>
            <li><a href="<?php echo $item['pattern'];?>"><?php echo $this->getString($item['text_key']);?></a></li>

        <?php
        }
    }?>
        there
</ul>