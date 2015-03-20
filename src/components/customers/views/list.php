<style>
    .friend {
        border: solid 1px black;
        width: 40%;
    }
</style>

<h3>Customer List</h3>
<?php foreach($CustomerFriends as $friend) {
    echo '<div class="friend">available info for styling:';
    
    pr($friend);
    echo '</div>';
}
?>