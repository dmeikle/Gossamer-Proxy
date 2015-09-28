<script language="javascript">
$(document).ready(function() {
    
     $('.selectable-rows tr').click(function() {
        if($(this).data('type') == 'instance') {
            $( this ).next().slideToggle();
        }
    });
});

</script>
<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th width="100">Date</th>
            <th>Number of Calls</th>
        </tr>
    </thead>
    <?php foreach($OnCallInstances as $key => $instance) {?>
    <tr data-type="instance">
        <td>
            <?php echo $key;?>
        </td>
        <td>
            <?php echo count($instance);?>
        </td>
    </tr>
    <tr style="display:none;">
        <td></td>
        <td>
            <table class="table">
                <thead>
                    <tr>
                        <th>Call Time</th>
                        <th>Tech Responded</th>
                        <th>Tech Arrived Promptly</th>
                        <th>PM Returned Call</th>
                        <th>Comments</th>
                        <th>Subcontractor <br />Response Time</th>
                        <th>Subcontractor <br />Arrival Time</th>
                    </tr>
                </thead>
                <?php foreach($instance as $row) {?>
                <tr>
                    <td>
                        <?php echo $row['callTime'];?>
                    </td>
                    <td>
                        <?php echo $row['techResponded'];?>
                    </td>
                    <td>
                        <?php echo $row['techArrivedOntime'];?>
                    </td>
                    <td>
                        <?php echo $row['pmReturnedCallTimely'];?>
                    </td>
                    <td>
                        <?php echo $row['comments'];?>
                    </td>
                    <td>
                        <?php echo $row['subcontractorResponseTime'];?>
                    </td>
                    <td>
                        <?php echo $row['subcontractorArrivalTime'];?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </td>
    </tr>
    <?php }?>
</table>
