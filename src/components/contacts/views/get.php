this is payload
<ul>
    <?php
    pr($this->data);
    foreach ($Users as $user) {
        ?>

        <li><?php echo $user['firstname']; ?> | <?php echo $user['email']; ?></li>

        <?php
    }
    ?>
</ul>