

<form method="post">

    <table class="table">
        <tr>
            <td>Claim Number:</td>
            <td><h4><?php echo $claimId; ?> -- this is the row ID - need to get the Claim Number</h4></td>
        </tr>
        <tr>
            <td>Location:</td>
            <td><h4>need unit number here</h4></td>
        </tr>
        <tr>
            <td>Message Type:</td>
            <td><select class="form-control" name="discussion[DiscussionTypes_id]" id="discussion_discussionTypesId">
                    <option value="1">Request For Access</option>
                    <option value="2">Request For Authorization</option>
                    <option value="2">Request For Documentation</option>
                </select></td>
        </tr>
        <tr>
            <td>Send Method:</td>
            <td>
                <select class="form-control" name="message[MessageTypes_id]">
                    <option value="1">In-App Message</option>
                    <option value="2">SMS Message</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><p>To:</p></td>
            <td>
                <select class="form-control" name="message[toContacts_id]">
                    <option value="1">Auto Load based on claim/location selection</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Subject:</td>
            <td><input type="text" class="form-control" name="message[subject]"  /></td>
        </tr>
        <tr>
            <td>Message:</td>
            <td><textarea class="form-control" name="message[message]"></textarea></td>
        </tr>
        <tr>
            <td>Priority:</td>
            <td>
                <select class="form-control" name="message[priority]">
                    <option value="1">normal</option>
                    <option value="2">important</option>
                    <option value="3">urgent</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <button class="btn btn-primary">Save</button>
                <input class="btn btn-primary" type="button" value="Cancel" id="cancel" />
            </td>
        </tr>
    </table>
    <input type="hidden" name="message[MessagingDiscussions_id]" value="<?php echo $discussionId; ?>" />
    <input type="hidden" name="discussion[Claims_id]" value="<?php echo $claimId; ?>" />
    <input type="hidden" name="discussion[ClaimsLocations_id]" value="<?php echo $locationId; ?>" />
</form>