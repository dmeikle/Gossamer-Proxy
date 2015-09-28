
<h2>Contacts List</h2>
<a href="/admin/events/eventcontacts/0">Add New Contact</a>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Telephone</th>
            <th>Email</th>
            <th>Company</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php foreach($EventContacts as $contact) {
        if(!is_array($contact) || count($contact) < 1) {
            continue;
        } ?>    
        <tr>
            <td>
                <?php echo $contact['name']; ?>
            </td>
            <td>
                <?php echo $contact['telephone']; ?>
            </td>
            <td>
                <?php echo $contact['email']; ?>
            </td>
            <td>
                <?php echo $contact['company']; ?>
            </td>
            <td>
                <button data-id="<?php echo $contact['id']; ?>" class="btn btn-primary edit">Edit</button> 
                <button data-id="<?php echo $contact['id']; ?>" class="btn btn-primary remove">Delete</button> 
                
            </td>
        </tr>
    <?php } ?>
</table>

<?php echo $pagination; ?>