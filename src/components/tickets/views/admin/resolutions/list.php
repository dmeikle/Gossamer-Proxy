<?php

/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

?>


<!--- javascript start --->

    @components/tickets/includes/js/admin-resolutions-list.js

<!--- javascript end --->

<h3>Ticket Resolutions</h3>
<button id="create-new" data-id="0" class="btn btn-primary btn-xs">Add New Resolution</button><br>
<table class="table" id="table1">
    <tr>
        <td>Resolution</td>
        <td>Action</td>
    </tr>
    <?php foreach($TicketResolutions as $item) {
     
        if(count($item) == 0) {
            continue;
        }
?>
    <tr id="row_<?php echo $item['id'];?>">
        <td id="item_<?php echo $item['id'];?>"><?php echo $item['resolution']; ?></td>
        <td>
            <button data-id="<?php echo $item['id'];?>" class="btn btn-primary btn-xs edit">Edit</button> 
            <button data-id="<?php echo $item['id'];?>" class="btn btn-primary btn-xs remove">Remove</button> 
        </td>
    </tr>
    <?php } ?>
</table>


<div id="dialog-form" title="Create new resolution type" style="display:none;">
  <p class="validateTips">All form fields are required.</p>
 
      <input type="hidden" id="itemId" value="0">
  <form id="form1" action="/super/tickets/resolutions/">
    <table class="table" id="table1">
        <tr>
            <td>
                Ticket Resolution:
            </td>
            <td>
                <div id="tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php

                        foreach($locales as $locale) {                    
                            if($locale['isDefault']) {
                                echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                            } else {
                                echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                            }
                        }
                        ?>
                    </ul>

                    <div class="tab-content">
                        <?php 

                        foreach($locales as $key => $locale) { ?>
                        <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active':'';?>" id="<?php echo $key;?>">
                            <?php echo $form['resolution']['locales'][$key]; ?>
                                
                        </div>
                       
                        <?php } ?>
                    </div>  
                </div>
                       
            </td>
        </tr>
    </table>
  </form>
</div>

<div id="dialog-confirm" title="Delete this resolution?"  style="display:none">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
 