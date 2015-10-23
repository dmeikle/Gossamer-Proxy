<style>
    .friend {
        border: solid 1px black;
        width: 40%;
    }
</style>

<h3>Contact List</h3>
<?php
foreach ($ContactFriends as $friend) {
    echo '<div class="friend">available info for styling:';

    pr($friend);
    echo '</div>';
}
?>