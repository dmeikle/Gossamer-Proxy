

<script language="javascript">

$(document).ready(function() {
    $('.edit').click(function() {
        window.location = '/admin/surveys/questions/' + $(this).data('typeid') + '/' + $(this).data('id');
    })
});

</script>
<!-- 4 is the textbox id -->
<a href="/admin/surveys/questions/4/0">Add New Question</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Question</th>
            <th>Type</th>
            <th>Active</th>
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
        <td><?php echo $question['question'];?></td>
        <td><?php echo $QuestionTypes[$question['QuestionTypes_id']];?></td>
        <td><?php echo (($question['isActive'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : ''); ?></td>    
        <td><button class="btn btn-primary edit" data-typeid="<?php echo $question['QuestionTypes_id'];?>" data-id="<?php echo $question['id'];?>">Edit</button> 
        <button class="btn btn-primary remove" data-id="<?php echo $question['id'];?>">Delete</button>
        <?php if($question['QuestionTypes_id'] < 4) {?>
            <button class="btn btn-primary answers" data-id="<?php echo $question['id'];?>">Answers</button></td>
        <?php } ?>
    <?php
    }
    ?>

</table>