<style>
.event{
    border: solid 1px black;
    width: 200px;
    float: left;
    margin-right: 30;
}
</style>

<?php

foreach($Events as $event){?>

<div class="event">
    <a href="../<?php echo $event['id'];?>">view</a>
    <?php pr($event); ?>
    
</div>
<?php } ?>