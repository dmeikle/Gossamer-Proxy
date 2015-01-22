<script language="javascript">
$(document).ready(function() {
    
     $('.selectable-rows tr').click(function() {
        if($(this).data('type') == 'instance') {
            $( this ).next().slideToggle();
        }
    });
});

</script>
<div id="blogs" >
    <?php foreach($Blogs as $blog) {?>
    <div class="blog">
<?php pr($blog); 
$date = date_create($blog['dateEntered']);
?>
<a href="/blogs/<?php echo $blog['id'];?>/<?php echo date_format($date,"Ymd");?>/<?php echo $blog['permalink'];?>" title="<?php echo $blog['subject'];?>"><?php echo $blog['subject'];?></a>
    </div>
   <?php } ?>

</div>
