<ul class="subnav">
    <li><a href="/admin/messaging/0/20">List All Messages</a></li>
    <?php
    if(isset($claimId) && $claimId > 0) {?>
        <li><a href="/admin/messaging/create/<?php echo $claimId;?>/<?php echo $locationId;?>/0" id="create">Send New Message</a></li>
    <?php } ?>
</ul>
