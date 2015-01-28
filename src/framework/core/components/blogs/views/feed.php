
    
<?php 
    foreach($Blogs as $blog) {
        $date = date_create($blog['dateEntered']);
?>
<div style="margin-bottom: 10px;" class="feedItem"><a href="/blogs/<?php echo $blog['id'];?>/<?php echo date_format($date,"Ymd");?>/<?php echo $blog['permalink'];?>" title="<?php echo $blog['subject'];?>"><?php echo $blog['subject'];?></a></div>
<?php } ?>
