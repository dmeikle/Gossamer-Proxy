
<h3>Panes inside of Page</h3>
<table class="table table-hover table-striped">
<tr>
    <td>Name</td>
    <td>CSS Class</td>
    <td>Priority</td>
</tr>
<?php
foreach($SurveyPagePanes as $pagepane) {
    if(count($pagepane) == 0) {
        continue;
    }
?>
<tr>
    <td><?php echo $pagepane['name'];?></td>
    <td><?php echo $pagepane['cssClass'];?></td>
    <td><?php echo $pagepane['priority'];?></td>
</tr>

<?php } ?>
<tr>
    <td>Add New Pane</td>
    <td colspan="2">
        this section is waiting for design for adding new panes
        <?php pr($SurveyPanes); ?></td>
</tr>
</table>