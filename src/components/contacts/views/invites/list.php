<style>
    .invitee {
        border: solid 1px black;
        width: 40%;
    }
</style>

<h3>Invites List</h3>
<a href="/portal/contacts/invites/0">send new invite</a>
<?php
foreach ($ContactInvites as $invitee) {
    echo '<div class="invitee">available info for styling:';

    pr($invitee);
    echo '</div>';
}
?>