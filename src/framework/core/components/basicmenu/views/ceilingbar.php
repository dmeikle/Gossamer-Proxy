

<!--- javascript start --->

@core/components/basicmenu/includes/js/script.js

<!--- javascript end --->


<!--- css start --->

@core/components/basicmenu/includes/css/styles.css

<!--- css end --->


    <div id='basicmenu'>
        <?php
    foreach ($navigation as $key => $item) {
       
        if(array_key_exists('active', $item) && $item['active'] == false) {
            ?>
            <li title="disabled on this release"><?php echo $this->getString($item['text_key']);?></li>
            <?php
            continue;
        }
?>
        <li><a href="<?php echo $item['pattern'];?>"><?php echo $this->getString($item['text_key']);?></a></li>
        
    <?php
    }?>
    </div>
<div id="basicmenu-bottom"></div>
