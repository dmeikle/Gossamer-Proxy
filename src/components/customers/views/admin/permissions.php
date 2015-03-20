
  <script language="javascript">
  $(function() {
        $('.selectable input:checkbox:checked').each(function(){
          
            $("label[for='" + this.id + "']").addClass('ui-selected');
        });
        
         $('.selectable').on('mouseup','label',function(){
            var el = $(this);
            console.info(el);
            if(el.hasClass('ui-selected')){
                el.removeClass('ui-selected');
            }else{
                el.addClass('ui-selected');
            }          
        })
    });
  </script>


<h2 class="form-signin-heading">Customer Permissions - NameGoesHere</h2>
<form class="form-standard" method="post" role="form" action="/admin/Customer/permissions/save/<?php echo $Customer['id'];?>">
     
         <table class="table">
             
             <tr>
                     <td colspan="2">
               <h3>Authorizations</h3>                    
                 </td>
             </tr>
             <tr>
               <td valign="top">
                Roles: </td>
               <td>
                   <p class="selectable">
                     <label for="manager"><input id="manager" <?php echo (in_array('IS_PORTAL_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_MANAGER]" value="1">
                     Claims Examiner</label>
                    <label for="client"><input id="client" <?php echo (in_array('IS_PORTAL_CLIENT', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_CLIENT]" value="1">
                    Client/Landlord</label>
                    <label for="customer"><input id="customer" <?php echo (in_array('IS_PORTAL_CUSTOMER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_CUSTOMER]" value="1">
                    Customer/Tenant</label>
                    <label for="dataentry"><input id="dataentry" <?php echo (in_array('IS_PORTAL_PROPERTY_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_PROPERTY_MANAGER]" value="1">
                    Property Manager</label>
                    <label for="departmentmgr"><input id="departmentmgr" <?php echo (in_array('IS_PORTAL_STRATA', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_STRATA]" value="1">
                    Strata Manager</label>
                    <label for="estimator"><input id="estimator" <?php echo (in_array('IS_PORTAL_CONCIERGE', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PORTAL_CONCIERGE]" value="1">
                    Concierge</label>
                   </p>
               </td>
             </tr>
             <tr>
                 <td>
                     
                 </td>
                 <td>
                     <button class="btn btn-primary" type="submit">Next</button>
                 </td>
             </tr>
     </table>
    
</form>
