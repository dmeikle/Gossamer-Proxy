
<script language="javascript">

  $(document).ready(function() {

    var currentStatus = '';
    
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
    
    $('.edit').click(function(e) {
        e.stopPropagation();        
        window.location = '/admin/contacts/' + $(this).data('id');                
    });
    
    $('.editCompany').click(function(e) {
        e.stopPropagation();        
        window.location = '/admin/companies/' + $(this).data('id');                
    });
    
    
});
</script>


      <h2 class="form-signin-heading">Company List</h2>
     
        <table class="table table-striped table-hover selectable-rows">
            <tr>
                <th align="center">Company</th> 
                <th width="11%" align="center">Type</th>              
                <th width="11%" align="center">Address</th>
                <th align="center">Telephone</th>
                <th  align="center">Fax</th>
                <th  align="center">Url</th>
                <th  align="center">Action</th>
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
                    <button data-id="<?php echo $company['id'];?>" class="editCompany">Edit</button> 
                    <button class="permissions" data-id="<?php echo $company['id'];?>">Permissions</button> 
                    <button data-id="<?php echo $company['id'];?>" class="deleteCopmany">Delete</button> 
                </td>
            </tr>
            <tr style="display: none">
                <td colspan="7"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="5">
                    <table class="table">
                        <thead>
                        <tr>
                          <th width="20%">Name</th>         
                            <th width="11%" align="center">Email</th>
                            <th align="center">Telephone</th>
                            <th align="center">Mobile</th>
                            <th align="center">Active</th>
                            <th align="center">Action</th>
                        </tr>
                        </thead>
                        <tr>
                          <td widtd="20%">joe blow</td>         
                            <td widtd="11%" align="center">email address here</td>
                            <td align="center">123-123-1233</td>
                            <td  align="center">778-123-1233</td>
                            <td  align="center">1</td>
                            <td  align="center">
                                <button class="edit" data-id="1">Edit</button> 
                                <button class="edit" data-id="1">Delete</button> 
                                <button class="edit" data-id="1">View Claims</button> 
                            </td>
                        </tr>
                          <?php 
                          /*
                          foreach($Contacts as $contact) {
                              ?>
                        <tr data-type="editable" valign="top" data-id="<?php echo $contact['id'];?>">
                            <td><?php echo $contact['lastname'];?>, <?php echo $contact['firstname'];?></td>
                            <td><?php echo $contact['email'];?></td>
                            <td><?php echo $contact['office'] . ' ' . $contact['extension'];?></td>
                            <td><?php echo $contact['mobile'];?></td>
                            <td>
                               <select class="staffStatus" style="display: none">
                                    <option>active</option>
                                    <option>suspended</option>
                                    <option>locked</option>
                                </select>
                                <a data-type="status" onclick="return false;" class="status"><?php echo $contact['isActive'];?></a>
                            </td>
                            <td>
                                <button data-id="<?php echo $contact['id'];?>" class="edit">Edit</button> 
                                <button class="permissions" data-id="<?php echo $contact['id'];?>">Permissions</button> 
                                <button data-id="<?php echo $contact['id'];?>" class="delete">Delete</button> 
                            </td>
                        </tr>
                      <?php 
                          }
                           * 
                           */
                          ?>
                        
                    </table>
                </td>
                <td></td>
            </tr>
          <?php 
              }
              ?>
        </table>

<select id="resultsPerPage">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>    
    </select>
    <ul class="pagination">
        <?php $firstPagination = current($pagination);?>
        <?php $lastPagination = end($pagination);?>
        <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
        <?php foreach($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
        <?php } ?>
      <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/contacts" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
    </ul>
</div>
      
       