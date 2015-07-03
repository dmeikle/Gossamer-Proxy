<!--- javascript start --->
    
    @components/staff/includes/js/admin-staff-list-ng.js

<!--- javascript end --->

<div class="col-md-6">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Staff Employment Information
            </div>
            <div class="block-controls">
                <span class="icon icon-cross icon-size-medium block-control-remove" aria-hidden="true"></span>
                <span class="icon icon-arrow-down icon-size-medium block-control-collapse" aria-hidden="true"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">
                <table class="table">
                    <tr>
                        <td>
                            <p class="selectable">
                                <?php foreach ($StaffRoles as $role) { ?>
                                 <div class="checkbox">
                                    <label class="">
                                            <div class="icheckbox_square-blue <?php echo (in_array($role['role'], $roles))?"checked":"";?>" style="position: relative;">
                                                <input id="StaffAuthorization_<?php echo $role['role'];?>" <?php echo (in_array($role['role'], $roles))?"checked":"";?> type="checkbox" name="userAuthorizations[<?php echo $role['role'];?>]" value="1"  style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);">
                                                <ins class="iCheck-helper" style="position: absolute; top: -20%; left: -20%; display: block; width: 140%; height: 140%; margin: 0px; padding: 0px; border: 0px; opacity: 0; background: rgb(255, 255, 255);"></ins>
                                            </div>
                                            <?php echo $role['title'];?>
                                    </label>
                                </div>    
                                
                                
                                <?php } ?>
                            </p>
                        </td>
                    </tr>
                    <tr>
                      
                        <td>
                            <button class="btn btn-primary" id="cancel-permissions" type="button">Cancel</button>
                            <button class="btn btn-primary" id="save-permissions" type="button">Save</button> 
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>




