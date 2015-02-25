

<script language="javascript">

$(document).ready(function() {
    $("#dialog-confirm").dialog({
      autoOpen: false,
      modal: true
    });
    $('.edit').click(function() {
        window.location = '/admin/surveys/questions/' + $(this).data('typeid') + '/' + $(this).data('id');
    })
    
    $('.remove').click(function() {        
        
        var url = '/admin/surveys/questions/remove/' + $(this).data('id');
        
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
//        if(confirm('Are you sure you want to delete this answer?') == false) {
//            return;
//        }
        
        //window.location = '/admin/surveys/answers/remove/' + $(this).data('id');
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
<div id="dialog-confirm" title="Delete this question?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>These question will be permanently deleted and cannot be recovered. Are you sure?</p>
</div>

<!-- 4 is the textbox id -->
<a href="/admin/surveys/questions/4/0">Add New Question</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Question</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach($Questions as $question) {
      if(count($question) == 0) {
          continue;
      }
    ?>
    <tr>
        <td><?php echo $question['name'];?></td>
        <td><?php echo $question['question'];?></td>
        <td><?php echo $QuestionTypesList[$question['QuestionTypes_id']];?></td>   
        <td><button class="btn btn-primary edit" data-typeid="<?php echo $question['QuestionTypes_id'];?>" data-id="<?php echo $question['id'];?>">Edit</button> 
        <button class="btn btn-primary remove" data-id="<?php echo $question['id'];?>">Delete</button>
    <?php
    }
    ?>

</table>


<?php echo $pagination; ?>