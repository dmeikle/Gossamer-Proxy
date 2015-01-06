
<h3>List Contacts - needs idea for add/remove from list. highlight with ajax to add/remove?</h3>
<p>**put filter here**</p>
<table class="table table-striped table-hover">
    <thead>
    <th>
        Name
    </th>
    <th>
        Email
    </th>
    <th>
        Mobile
    </th>
    <th>
        Office
    </th>
    <th>
        On List**
    </th>
    </thead>
<?php foreach($ListContacts as $contact) {?>
<tr>
    <td>
        <?php echo $contact['lastname'];?>, <?php echo $contact['firstname'];?>
    </td>
    <td>
        <?php echo $contact['email'];?>
    </td>
    <td>
        <?php echo $contact['mobile'];?>
    </td>
    <td>
        <?php echo $contact['office'];?>
    </td>
    <td>
        <?php echo $contact['isMember'];?>
    </td>
</tr>

<?php } ?>
</table>

<?php
echo $pagination;
?>
