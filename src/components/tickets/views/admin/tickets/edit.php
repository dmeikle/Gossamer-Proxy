<?php

/* 
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
?>
 <style type="text/css">
#ticket {
	width: 98%;
        border: solid 1px grey;
        border-radius: 5px;
        padding: 10px;
}
#ticket div {
    margin: 2px 0px;
}
#ticket #subject {
	width: 100%;
}
#ticket #priority {
	width: 50%;
        float: left;
}
#ticket #type {
	width: 50%;
        float: left;
}
#ticket #category {
	width: 50%;
        float: left;
}
#ticket #jobNumber {
	width: 50%;
        float: left
}
#ticket #phase {
	width: 50%;
	float: left;
}
#ticket #code {
	width: 50%;
	float: left;
}
#ticket #department {
	clear: both;
        float:left;
	width: 50%;
}
#ticket #assigned {
    float: left;
    width: 50%;
}
#ticket #icon {
	float: right;
	width: 20%;
}
#ticket #labels {
	clear: both;
	width: 100%;
}
.halfpage {
    width: 50%;
    float: left;
}
#confirm-change-assignee {
    display: none;
}
#location {
    display: none;
}
//.box-wrapper{border:1px solid #000; position:relative;}
//.box-wrapper:after{content:"x";position:absolute; right:-10px; top:-10px;}

</style>
<!--- css start --->
    @components/tickets/includes/css/editable.css
<!--- css end --->

<!--- javascript start --->
    @components/tickets/includes/js/admin-tickets-edit.js
    @components/tickets/includes/js/editable.js
<!--- javascript end --->



Ticket
<form method="post" id="ticket-info" >
    <?php echo $form['id'];?>
    <fieldset disabled="disabled" class="editable-fieldset">
    <div id="ticket">
	<div id="icon">
            <a href="#" onclick="editpage('ticket-info')">edit</a>
            1 icon
        </div>
	<div id="subject">
            Ticket Name: <?php echo $form['subject'];?>
        </div>
	<div id="jobNumber">
            Job #: <?php echo $form['jobNumber'];?>
                <?php echo $form['Claims_id'];?>
            <div id="jobNumberResults"></div>
        </div>
	<div id="assigned">
            Assigned To:<br> <?php echo $form['assignedStaff'];?>
            <?php echo $form['Staff_id'];?>
            <div id="staffResults"></div>
        </div>
	<div id="type">
            Type:<br> <?php echo $form['TicketTypes_id'];?>           
        </div>
	<div id="category">
            Category:<br> <?php echo $form['TicketCategories_id'];?>           
        </div>
	<div id="location">
            Location:<br> <?php echo $form['ClaimsLocations_id'];?>           
        </div>
        
	<div id="department">
            Department: <?php echo $form['Departments_id'];?>
        </div>
	<div id="phase">
            Phase: <?php echo $form['ClaimPhases_id'];?>
        </div>
	<div id="priority">
            Priority: <?php echo $form['TicketPriorities_id'];?>
        </div>
       
	<div id="code">
            Code: <?php echo $form['TicketCategories_id'];?>
        </div>
	<div id="labels">
            Labels: 
            <?php echo $form['labels'];?>
        </div>
	<div id="description">
            Description: <?php echo $form['description'];?>
        </div>
        <div id="lowertabs">
            <ul>
              <li><a href="#actions">Work Actions</a></li>
              <li><a href="#attachments">Attachments</a></li>
              <li><a href="#notes">Notes</a></li>
            </ul>
            <div id="actions">
              <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
            </div>
            <div id="attachments">
              <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
            </div>
            <div id="notes">
              <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
              <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>

            </div>
        </div>
    </div>
    </fieldset>
</form>


<div id="editnav" style="display: none">
    <input type="button" class="btn btn-small" value="Save" id="save" />
    <input type="button" class="btn btn-small" value="Cancel" onclick="unedit()" />
</div>