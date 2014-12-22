
<script language="javascript">

  $(document).ready(function() {

    var currentStatus = '';
    
    $('.permissions').click(function(e) {
        e.stopPropagation(); 
        window.location = '/admin/contacts/permissions/' + $(this).data('id');       
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
    
    $('.credentials').click(function(e) {
       e.stopPropagation();
       window.location = '/admin/contacts/credentials/' + $(this).data('id'); 
    });
});
</script>


      <h2 class="form-signin-heading">Contact List</h2>
     
        <table class="table table-striped table-hover selectable-rows">
            <tr>
              <th width="20%">Name</th>
                <th width="11%" align="center">Type</th> 
                <th width="11%" align="center">Company</th>              
                <th width="11%" align="center">Email</th>
                <th align="center">Telephone</th>
                <th  align="center">Mobile</th>
                <th  align="center">Active</th>
                <th  align="center">Action</th>
            </tr>
              <?php foreach($Contacts as $contact) {
                  if(count($contact) < 1) {
                      continue;
                  }
                  ?>
            <tr data-type="editable" valign="top" data-id="<?php echo $contact['id'];?>">
                <td><?php echo $contact['lastname'];?>, <?php echo $contact['firstname'];?></td>
                <td><?php echo $contact['ContactTypes_id'];?></td>
                <td><?php //echo $contact['title'];?></td>
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
                    <button class="credentials" data-id="<?php echo $contact['id'];?>">Credentials</button> 
                    <button data-id="<?php echo $contact['id'];?>" class="status">Status</button> 
                    <button data-id="<?php echo $contact['id'];?>" class="delete">Delete</button> 
                </td>
            </tr>
          <?php 
              }
              ?>
        </table>

      <?php echo $pagination; ?>
