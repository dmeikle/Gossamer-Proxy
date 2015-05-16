<style>
    
.edit-nav {
    position: absolute;
    background-color: white;
    border: solid 1px grey;
    padding: 10px;
    border-radius: 5px;
    display: none;
    z-index: 1000;
    width: 100px;
}
.edit-nav li {
    list-style: none;
}
.hover, .hover_effect {
    position: absolute;
    background-color: white;
    border: solid 1px grey;
    padding: 10px;
    border-radius: 5px;
    display:block;
    z-index: 1000
}

element:hover, element:active {
-webkit-tap-highlight-color: rgba(0,0,0,0);
-webkit-user-select: none;
-webkit-touch-callout: none
}

</style>

<script language="javascript">
$(document).ready(function() {
//    $('.edit').click(function() {
//        window.location = '/admin/projects/' + $(this).data('id');
//    });

    $('.floorplans').click(function() {
        window.location = '/admin/projects/floorplans/' + $(this).data('id');
    });
    
    $('#ProjectAddress_cancel').click(function() {
        $('#left-feature-slider-edit').toggle('false');
    });
    
    $('.edit').click(function() {
       $('#building-form').trigger('reset');
       $.get('/admin/projects/view/' + $(this).data('id'), function(data) {
           $('#left-feature-slider-edit').toggle('true');
           $.each(data, function(key, value) {
               $('#ProjectAddress_'+key).val(value);
           });
           $('#ProjectAddress_projectAddressId').val(data.id);
       })               
    });
    
    $('#ProjectAddress_save').click(function(e) {
        e.stopPropagation();
        var id = $('#ProjectAddress_projectAddressId').val();

        $.ajax({
             url: '/admin/projects/' + id,
             type: "post",
             data: $('#building-form').serialize()
         });

       $('#left-feature-slider-edit').toggle(false);
    });
   
    $('.edit-container').hover(
        function() {
            $(this).children('.edit-nav').toggleClass('hover_effect', true);
        },
        function() {
            $(this).children('.edit-nav').toggleClass('hover_effect', false);
        }
    );
    $('.edit-container').click(
        function() {
            $(this).children('.edit-nav').toggleClass('hover_effect');
        },
        function() {
            $(this).children('.edit-nav').toggleClass('hover-effect');
        }
    );
});
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        <a href="#" style="float: right;" class="edit" data-id="0">Add New Building</a>
        Building List
     </div>

<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Building Name</th>
            <th>Address</th>
            <th>City</th>
            <th>Province</th>
            <th>Postal Code</th>
            <th>Claim History Count</th>
            <th>Active Claim Count</th>
            <th></th>
        </tr>
    </thead>
    <?php
    foreach($ProjectAddresss as $address) { ?>
    <tr>
        <td>
            <?php echo $address['buildingName'];?>
        </td>
        <td>
            <?php echo $address['address1'];?>
        </td>        
        <td>
            <?php echo $address['city'];?>
        </td>
        <td>
            <?php //echo $address['buildingName'];?>
        </td>
        <td>
            <?php echo $address['postalCode'];?>
        </td>
        <td>
            <?php echo $address['claimsHistoryCount'];?><br>
            clickable to other page
        </td>
        <td>
            <?php echo $address['activeClaimsCount'];?><br>
            clickable to other page
        </td>
        <td>
            <div class="edit-container"><span class="glyphicon glyphicon-cog"></span>
                <ul class="edit-nav">
                    <li><a href="#" data-id="<?php echo $address['id'];?>" class="edit">Edit</a></li>
                    <li><a href="#" data-id="<?php echo $address['id'];?>" class="floorplans">Floor Plans</a</li> 
                </ul>
            </div>
        </td>
    </tr>
    <?php } ?>
</table>
  
</div>

<?php echo $pagination; ?>