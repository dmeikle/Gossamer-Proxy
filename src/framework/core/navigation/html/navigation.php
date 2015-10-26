


<div>
    <select id="resultsPerPage">
        <option>10</option>
        <option>25</option>
        <option>50</option>
        <option>100</option>
    </select>
    <ul class="pagination">
        <?php $firstPagination = current($pagination); ?>
        <?php $lastPagination = end($pagination); ?>
        <li><a class="pagination <?php echo $firstPagination['current']; ?>" data-url="<?php echo $uriPrefix; ?>" data-offset="<?php echo $firstPagination['data-offset']; ?>" data-limit="<?php echo $firstPagination['data-limit']; ?>">&laquo;</a></li>
        <?php foreach ($pagination as $index => $page) { ?>
            <li><a class="pagination <?php echo $page['current']; ?>" data-url="<?php echo $uriPrefix; ?>" data-offset="<?php echo $page['data-offset']; ?>" data-limit="<?php echo $page['data-limit']; ?>" ><?php echo $index + 1; ?></a></li>
        <?php } ?>
        <li><a class="pagination <?php echo $lastPagination['current']; ?>" data-url="<?php echo $uriPrefix; ?>" data-offset="<?php echo $lastPagination['data-offset']; ?>" data-limit="<?php echo $lastPagination['data-limit']; ?>" >&raquo;</a></li>
    </ul>
</div>