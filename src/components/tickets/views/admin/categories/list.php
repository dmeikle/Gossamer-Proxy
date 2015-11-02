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

@components/tickets/includes/js/admin-categories-list.js

<!--- javascript end --->

<h3>Ticket Categories</h3>
<button id="create-new" data-id="0" class="btn btn-primary btn-xs">Add New Category</button><br>
<table class="table" id="table1">
    <tr>
        <td>Category</td>
        <td>Action</td>
    </tr>
    <?php
    foreach ($TicketCategorys as $item) {

        if (count($item) == 0) {
            continue;
        }
        ?>
        <tr id="row_<?php echo $item['id']; ?>">
            <td id="item_<?php echo $item['id']; ?>"><?php echo $item['category']; ?></td>
            <td>
                <button data-id="<?php echo $item['id']; ?>" class="btn btn-primary btn-xs edit">Edit</button>
                <button data-id="<?php echo $item['id']; ?>" class="btn btn-primary btn-xs remove">Remove</button>
            </td>
        </tr>
    <?php } ?>
</table>


<div id="dialog-form" title="Create new category type" style="display:none;">
    <p class="validateTips">All form fields are required.</p>

    <input type="hidden" id="itemId" value="0">
    <form id="form1" action="/super/tickets/categories/">
        <table class="table" id="table1">
            <tr>
                <td>
                    Ticket Category:
                </td>
                <td>
                    <div id="tabs">
                        <ul class="nav nav-tabs" role="tablist">
                            <?php
                            foreach ($locales as $locale) {
                                if ($locale['isDefault']) {
                                    echo "<li class=\"active\"><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                } else {
                                    echo "<li><a href=\"#{$locale['locale']}\" role=\"tab\" data-toggle=\"tab\">{$locale['languageName']}</a></li>\r\n";
                                }
                            }
                            ?>
                        </ul>

                        <div class="tab-content">
                            <?php foreach ($locales as $key => $locale) { ?>
                                <div class="tab-pane<?php echo ($locale['isDefault']) ? ' active' : ''; ?>" id="<?php echo $key; ?>">
                                    <?php echo $form['category']['locales'][$key]; ?><br>

                                </div>

                            <?php } ?>
                        </div>
                    </div>

                </td>
            </tr>
            <tr>
                <td>Prefix:</td>
                <td><?php echo $form['prefix']; ?></td>
            </tr>
        </table>
    </form>
</div>

<div id="dialog-confirm" title="Delete this category?"  style="display:none">
    <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>This item will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
