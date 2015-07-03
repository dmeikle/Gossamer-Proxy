


<?php

$keys = array_keys($claim);

foreach($keys as $key) {?>
    <input type="hidden" id="claim_<?php echo $key;?>" value="<?php echo $claim[$key];?>" />

<?php
}

?>