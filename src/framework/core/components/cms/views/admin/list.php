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
        <th width="50%">Title</th>
        <th>Author</th>
        <th>Comments</th>
        <th>Date Published</th>
    </tr>
    <?php foreach ($CmsPages as $page) {?>
        <tr>
            <td><?php echo $page['name'];?><br />
                <div class="pagenav" style="display:none"><a href="/admin/cms/pages/<?php echo $page['id'];?>">Edit</a> | <a href="#">Trash</a> | <a href="#">View</a></div>
            </td>
            <td>Dave M</td>
            <td>0</td>
            <td>2014-10-12<br />
                
            </td>
        </tr>
    <?php } ?>
    
</table>

<?php echo $pagination; ?>