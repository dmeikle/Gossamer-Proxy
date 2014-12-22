

<script language="javascript">

$(document).ready(function() {
    $('.edit').click(function() {
        window.location = '/admin/surveys/answers/' + $(this).data('id');
    })

});

</script>


<a href="/admin/surveys/answers/0">Add New Answer</a>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Answer</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php
    foreach($Answers as $answer) {
      if(count($answer) == 0) {
          continue;
      }
    ?>
    <tr>
        <td><?php echo $answer['answer'];?></td>      
        <td><?php echo (($answer['isActive'] == '1') ? '<span class="glyphicon glyphicon-ok"></span>' : ''); ?></td>    
        <td><button class="btn btn-primary edit" data-id="<?php echo $answer['id'];?>">Edit</button> 
        <button class="btn btn-primary remove" data-id="<?php echo $answer['id'];?>">Delete</button>
       
    <?php
    }
    ?>
</table>


<?php echo $pagination; ?>