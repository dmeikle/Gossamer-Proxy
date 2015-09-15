<script language="javascript">
$( document ).ready(function() {
   
   $('.selectable-rows tr').click(function() {

        if($(this).data('type') == 'subcontractor') {
            $( this ).next().slideToggle();
        }
        
        
        
        
    });

    $('.view').click(function(e) {
        e.preventDefault();
        window.location = '/admin/subcontractors/contact/' + $(this).data('id');
    })

   

   
   
   
});
</script>

<h2 class="form-signin-heading">Subcontractor Contacts List</h2>
     
        <table class="table table-striped table-hover selectable-rows">
            <tr>
              <th width="7%">Name</th>
                <th width="4%" align="center">Email</th>               
                <th width="4%" align="center">Mobile</th>
                <th width="4%" align="center">Telephone</th>
                <th width="4%" align="center">Hours</th>
                <th width="4%" align="center">Rating</th>
                <th width="4%" align="center">Notes</th>
                <th width="4%" align="center">Action</th>
            </tr>
<?php

foreach($SubcontractorContacts as $contractor) {
    ?>
            <tr title="click to view current jobs" data-type="subcontractor" valign="top" data-id="<?php echo $contractor['id'];?>">
                <td><?php echo $contractor['name'];?></td>
                <td><?php echo $contractor['email'];?></td>
                <td><?php echo $contractor['mobile'];?></td>
                <td><?php echo $contractor['telephone'];?></td>
                <td><?php echo $contractor['hours'];?></td>
                <td><?php echo $contractor['rating'];?></td>
                <td><?php echo $contractor['notes'];?></td>
                <td><button class="view" data-id="<?php echo $contractor['id'];?>">View</button>
                    <button class="delete">Delete</button></td>
            </tr>
            
          <?php 
              }
              ?>
        </table>
       &lt;&lt; 1 2 3 4 5 &gt;&gt;

