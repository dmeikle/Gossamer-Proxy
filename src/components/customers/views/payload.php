this is payload
<ul>
<?php
foreach($Users as $user) {?>
    
    <li><?php echo $user['firstname'];?> | <?php echo $user['email'];?></li>
   
<?php
}
?>
</ul>