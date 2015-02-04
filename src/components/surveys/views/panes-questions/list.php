<?php  ?>
<h3>Questions</h3>
<table class="table">    
<tr>
    <th>
        Question
    </th>
    <th>
       Type
    </th>
    <th>
        Order
    </th>
    
</tr>
<?php
foreach($SurveyPaneQuestions as $question) {
?>
<tr>
    <td>
        <?php echo $question['question'];?>
    </td>
    <td>
        <?php echo $question['QuestionTypes_id'];?>
    </td>
    <td>
        <?php echo $question['priority'];?>
    </td>
    
</tr>
<?php } ?>
<tr>
    <td>
        This is for adding more questions - needs interface determined
        <?php pr($QuestionsList);?>
    </td>
</tr>
</table>
