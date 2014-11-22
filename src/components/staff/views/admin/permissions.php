
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
        });
        
        $('.cancel').click(function() {
            window.location = '/admin/staff/0/20';
        });
        
    });
  </script>

 
<h2 class="form-signin-heading">Staff Permissions - NameGoesHere</h2>
<form class="form-standard" method="post" role="form" >
     
         <h3>Department</h3>

         <table class="table">
             <tr>
               <td width="14%">Department:</td>
               <td width="86%">
                   <select class="form-control" name="staff[Departments_id]">
                       <?php foreach($Departments as $department) {?>
                       <option value="<?php echo $department['id'];?>"><?php echo $department['name'];?></option>
                       
                       <?php }?>
                    </select>
                </td>
             </tr>
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
                    <label for="accounting"><input id="accounting" <?php echo (in_array('IS_ACCOUNTING', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_ACCOUNTING]" value="1">Accounting</label>
                    <label for="accounts"><input id="accounts" <?php echo (in_array('IS_ACOUNTS_PAYABLE', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_ACOUNTS_PAYABLE]" value="1">Accounts Payable</label>
                    <label for="administrator"><input id="administrator" <?php echo (in_array('IS_ADMINISTRATOR', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_ADMINISTRATOR]" value="1">Administrator</label>
                    <label for="manager"><input id="manager" <?php echo (in_array('IS_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_MANAGER]" value="1">Manager</label>
                    <label for="client"><input id="client" <?php echo (in_array('IS_CLIENT', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_CLIENT]" value="1">Client</label>
                    <label for="customer"><input id="customer" <?php echo (in_array('IS_CUSTOMER_SERVICE', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_CUSTOMER_SERVICE]" value="1">Customer Service</label>
                    <label for="dataentry"><input id="dataentry" <?php echo (in_array('IS_DATA_ENTRY', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_DATA_ENTRY]" value="1">Data Entry Clerk</label>
                    <label for="departmentmgr"><input id="departmentmgr" <?php echo (in_array('IS_DEPT_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_DEPT_MANAGER]" value="1">Department Manager</label>
                    <label for="estimator"><input id="estimator" <?php echo (in_array('IS_ESTIMATOR', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_ESTIMATOR]" value="1">Estimator</label>
                    <label for="poweruser"><input id="poweruser" <?php echo (in_array('IS_POWER_USER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_POWER_USER]" value="1">Power User</label>
                    <label for="pmc"><input id="pmc" <?php echo (in_array('IS_PROJECT_COORDINATOR', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PROJECT_COORDINATOR]" value="1">Project Coordinator</label>
                    <label for="pm"><input id="pm" <?php echo (in_array('IS_PROJECT_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PROJECT_MANAGER]" value="1">Project Manager</label>
                    <label for="pma"><input id="pma" <?php echo (in_array('IS_PM_ASSISTANT', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_PM_ASSISTANT]" value="1">Project Manager Assistant</label>
                    <label for="qc"><input id="qc" <?php echo (in_array('IS_QUALITY_CONTROL', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_QUALITY_CONTROL]" value="1">Quality Control</label>
                    <label for="reception"><input id="reception" <?php echo (in_array('IS_RECEPTION', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_RECEPTION]" value="1">Receptionist</label>
                    <label for="marketing"><input id="marketing" <?php echo (in_array('IS_MARKETING', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_MARKETING]" value="1">Sales and Marketing</label>
                    <label for="mu"><input id="mu" <?php echo (in_array('IS_MARKETING_UNIT', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_MARKETING_UNIT]" value="1">Sales Marketing Unit</label>
                    <label for="tca"><input id="tca" <?php echo (in_array('IS_TECH_ASSISTANT', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_TECH_ASSISTANT]" value="1">Technical Assistant</label>
                    <label for="ta"><input id="ta" <?php echo (in_array('IS_TRADE_ACCESS', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_TRADE_ACCESS]" value="1">Trade Access</label>
                    <label for="wm"><input id="wm" <?php echo (in_array('IS_WAREHOUSE_MANAGER', $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[IS_WAREHOUSE_MANAGER]" value="1">Warehouse Manager</label>
                </p>
               </td>
             </tr>
       <tr>
         <td></td>
         <td>
            <button class="btn btn-primary cancel" type="button">cancel</button>
            <button class="btn btn-primary" type="submit">Next</button> 
         </td>
       </tr>
         </table>
    
</form>
