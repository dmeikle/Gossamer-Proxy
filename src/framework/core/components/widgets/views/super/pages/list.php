<!--- javascript start --->

@core/components/widgets/includes/js/admin-widgets-pages-ng.js

<!--- javascript end --->


<table class="class table-striped table-hover">
    <tr>
        <td>Name</td>
        <td>Description</td>    
        <td>YML Key</td>
        <td>Active</td>
        <td>System</td>
        <td>Action</td>
    </tr>
    <?php foreach($WidgetPages as $page) {?>    
        <tr>
            <td><?php echo $page['name'];?></td>
            <td><?php echo $page['description'];?></td>
            <td><?php echo $page['ymlKey'];?></td>
            <td><?php echo $page['isActive'];?></td>
            <td><?php echo $page['isSystemPage'];?></td>
            <td><a href="../<?php echo $page['id'];?>">edit</a></td>
        </tr>    
    <?php }?>
</table>


