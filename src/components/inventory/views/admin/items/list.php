
<script language="javascript">

$(document).ready(function() {
    
    
   $('.locate').click(function() {
       document.location.href = '/admin/inventory/items/' + $(this).data('id');
   });
   
   $('.edit').click(function() {
       document.location.href = '/admin/inventory/locate/' + $(this).data('id');
   });
   
   
   
   
   
});

</script>


<a href="/admin/inventory/items/0">add new item</a>

<table class="table table-striped">
    <tr>
        <th>
            Name
        </th>
        <th>
            Code
        </th>
        <th>
            Min Qty
        </th>
        <th>
            Max Qty
        </th>
        <th>
            Package Type
        </th>
        <th>
            Type
        </th>
        <th>
            Action
        </th>
    </tr>
    <?php foreach($InventoryItems as $item) {?>
    <tr>
        <td>
            <?php echo $item['name'];?>
        </td>
        <td>
            <?php echo $item['productCode'];?>
        </td>
        <td>
            <?php echo $item['minOrderQuantity'];?>
        </td>
        <td>
            <?php echo $item['maxQuantity'];?>
        </td>
        <td>
            <?php echo $packageTypes[$item['PackageTypes_id']];?>
        </td>
        <td>
            <?php echo $inventoryTypes[$item['InventoryTypes_id']];?>
        </td>
        <td>
            <button data-id="<?php echo $item['id'];?>" class="btn btn-primary locate">Locate</button>
            <button data-id="<?php echo $item['id'];?>" class="btn btn-primary edit">Edit</button>
            <button data-id="<?php echo $item['id'];?>" class="btn btn-primary delete">Delete</button>
        </td>
    </tr>
    
    <?php }?>
</table>
<?php echo $pagination; ?>