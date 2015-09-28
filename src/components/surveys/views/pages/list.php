
<script language="javascript">

    $(document).ready(function() {
        $('.edit').click(function() {
           document.location = '/admin/surveys/pages/' + $(this).data('id');
        });
        
        $('.panes').click(function() {
           document.location = '/admin/surveys/pages/panes/' + $(this).data('id') + '/0/20';
        });
        
        
    $("#dialog-confirm").dialog({
      autoOpen: false,
      modal: true
    });
    
    $('.remove').click(function() {        
        
        var url = '/admin/surveys/pages/remove/' + $(this).data('id');
        
        $("#dialog-confirm").dialog({
          buttons : {
            "Confirm" : function() {
              window.location = url;
            },
            "Cancel" : function() {
              $(this).dialog("close");
            }
          }
        });

        $("#dialog-confirm").dialog("open");

    });
    
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height:140,
      modal: true,
      buttons: {
        "Delete selected item": function() {
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
});
</script>

<style>
    #dialog-confirm {
        display: none;
    }
</style>
<div id="dialog-confirm" title="Delete this page?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These page will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>
<a href="/admin/surveys/pages/0">Add New Page</a>

<table class="table">
    <tr>
        <td>
            Name
        </td>
        <td>
            Action
        </td>
    </tr>
    <?php foreach($SurveyPages as $page) {
        if(count($page) == 0) {
            continue;
        }
?>
    <tr>
        <td>
            <?php echo $page['name'];?>
        </td>
        <td>
            <button class="btn btn-small btn-primary edit" data-id="<?php echo $page['id'];?>">Edit</button> 
            <button class="btn btn-small btn-primary remove" data-id="<?php echo $page['id'];?>">Delete</button> 
            <button class="btn btn-small btn-primary panes" data-id="<?php echo $page['id'];?>">List Panes</button> 
        </td>
    </tr>
    <?php }?>
</table>