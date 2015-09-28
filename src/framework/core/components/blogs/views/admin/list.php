<h3>Blogs</h3>


<script language="javascript">
$(document).ready(function() {

    $("tr").not(':first').hover(function() {
        $(this).find("div.pagenav").show();
    }, function() {
        $(this).find("div.pagenav").hide();
    });
});

</script>


<table class="table table-striped table-hover">
    <tr>
        <th width="50%">Subject</th>
        <th>Author</th>
        <th>Comments</th>
        <th>Last Modified</th>
    </tr>
    <?php foreach ($Blogs as $page) {
        $date = date_create($page['dateEntered']);
        ?>
        <tr>
            <td><?php echo $page['subject'];?><br />
                <div class="pagenav" style="display:none"><a href="/admin/blogs/<?php echo $page['id'];?>">Edit</a> | <a href="#">Trash</a> | <a target="_new" href="/blogs/<?php echo $page['id'];?>/<?php echo date_format($date,"Ymd");?>/<?php echo $page['permalink'];?>">View</a></div>
            </td>           
            <td>Dave M</td>
            <td>0</td>
            <td>2014-10-12<br />
                
            </td>
        </tr>
    <?php } ?>
    
</table>

<?php echo $pagination; ?>