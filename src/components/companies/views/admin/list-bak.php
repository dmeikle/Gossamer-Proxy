<style>
    
.edit-nav {
    position: absolute;
    background-color: white;
    border: solid 1px grey;
    padding: 10px;
    border-radius: 5px;
    display: none;
    z-index: 1000
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

    var currentStatus = '';
    //$('body').bind('touchstart', function() {});
    document.addEventListener("touchstart", function(){}, true);
    
    $('.hover').bind('touchstart touchend', function(e) {
        e.preventDefault();
        $(this).toggleClass('hover_effect');
    });
    
    $('.permissions').click(function(e) {
        e.stopPropagation(); 
        window.location = '/admin/staff/permissions/' + $(this).data('id');       
    });
    
    $('.status').click(function(e) {
         e.stopPropagation(); 
         $(this).prev('.staffStatus').toggle();
         if($(this).text() == 'cancel') {
            $(this).text(currentStatus);
         } else {
            currentStatus = $(this).prev('.staffStatus').val();
            $(this).text('cancel');
         }
         
    });
    
//    $('.staffStatus').click(function(e) {
//         e.stopPropagation();        
//         $(this).prev().toggle();
//         $(this).toggle();
//    });
//    
    $('.staffStatus').change(function() {
        
         if($(this).val() != currentStatus && confirm("are you sure you want to change the status of this employee?")) {
            alert('this will eventually perform a save'); //save();
            $(this).next().text($(this).val());
         } else {
            $(this).next().text(currentStatus); 
         } 
                 
         $(this).toggle();
    });
    
    $('.edit').click(function() {
       $('#company-form').trigger('reset');
       $.get('/admin/companies/view/' + $(this).data('id'), function(data) {
           $('#left-feature-slider-edit').toggle('true');
           $.each(data, function(key, value) {
               $('#Company_'+key).val(value);
           });
           $('#Company_companyId').val(data.id);
       })               
    });
    
    $('.editCompany').click(function(e) {
        e.stopPropagation();        
        window.location = '/admin/companies/' + $(this).data('id');                
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
<a style="float: right;" href="#" data-id="0" class="edit">Create New Company</a>
     Company List
     </div>
        <table class="table table-striped table-hover selectable-rows">
            <tr>
                <th align="center">Company</th> 
                <th width="11%" align="center">Type</th>              
                <th width="11%" align="center">Address</th>
                <th align="center">Telephone</th>
                <th  align="center">Fax</th>
                <th  align="center">Url</th>
                <th  align="center"></th>
            </tr>
              <?php foreach($Companys as $company) {
                  
                  ?>
            <tr data-type="editable" valign="top" data-id="<?php echo $company['id'];?>">
                <td><?php echo $company['name'];?></td>
                <td><?php echo $company['CompanyTypes_id'];?></td>
                <td><?php echo $company['address1'] . (strlen($company['address2']) > 0) ? $company['address2'] : '' . ', ' . $company['city'] . ', ' . $company['postalCode'];?></td>
                <td><?php echo $company['telephone'];?></td>
                <td><?php echo $company['fax'];?></td>
                <td><?php echo $company['url'];?></td>
                <td>
                    <div class="edit-container"><span class="glyphicon glyphicon-cog"></span>
                        <ul class="edit-nav">
                            <li><a href="#" data-id="<?php echo $company['id'];?>" class="edit">Edit</a></li>
                            <li><a href="#" data-id="<?php echo $company['id'];?>" class="permissions">Permissions</a</li> 
                            <li><a href="#" data-id="<?php echo $company['id'];?>" class="deleteCompany">Company</a</li> 
                        </ul>
                    </div>
                </td>
            </tr>
           
          <?php 
              }
              ?>
        </table>
</div>
<?php echo $pagination; ?>
      

       