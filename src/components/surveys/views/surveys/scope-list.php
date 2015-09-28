
<script language="javascript">

$(document).ready(function() {
   $('.view').click(function() {
       window.location = '/admin/surveys/scopeforms/' + $(this).data('id');
   })
});

</script>


<table class="table table-striped">
    <thead>
        <tr>
            <th>
                Form Name
            </th>
            <th>
                Active
            </th>
            <th>
                Date Modified
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>
    <tr>
        <td>
            Form 1
        </td>
        <td>
            <span class="glyphicon glyphicon-ok-circle"></span>
        </td>
        <td>
            2014-10-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="1">View</button>
        </td>
    </tr>
    <tr>
        <td>
            Form 2
        </td>
        <td>
            
        </td>
        <td>
            2014-05-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="2">View</button>
        </td>
    </tr>
    <tr>
        <td>
            Form 3
        </td>
        <td>
            
        </td>
        <td>
            2014-01-01
        </td>
        <td>
            <button class="btn btn-primary view" data-id="3">View</button>
        </td>
    </tr>
</table>


<div>
    <select id="resultsPerPage">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>    
    </select>
    <ul class="pagination">
        <?php $firstPagination = current($pagination);?>
        <?php $lastPagination = end($pagination);?>
        <li><a class="pagination <?php echo $firstPagination['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $firstPagination['data-offset'];?>" data-limit="<?php echo $firstPagination['data-limit'];?>">&laquo;</a></li>
        <?php foreach($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $page['data-offset'];?>" data-limit="<?php echo $page['data-limit'];?>" ><?php echo $index+1; ?></a></li>
        <?php } ?>
      <li><a class="pagination <?php echo $lastPagination['current'];?>" data-url="/admin/incidents/type" data-offset="<?php echo $lastPagination['data-offset'];?>" data-limit="<?php echo $lastPagination['data-limit'];?>" >&raquo;</a></li>
    </ul>
</div>
