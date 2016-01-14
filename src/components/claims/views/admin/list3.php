

<script language="javascript">

    $(document).ready(function () {

        $('.selectable-rows tr').click(function () {

            if ($(this).data('type') == 'request') {
                $(this).next().slideToggle();
            }
            if ($(this).data('type') == 'unit') {
                window.location = "/admin/claimlocations/" + $(this).data('claimId') + '/' + $(this).data('id');
            }

        });

        $('.view').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/claim/' + $(this).data('id');
        })

        $('.add-contact').click(function (e) {
            window.location = '/admin/scoping/requests/contact/' + $(this).data('id');
        });

        $('.add-unit').click(function (e) {
            window.location = '/admin/scoping/requests/contact/' + $(this).data('id');
        });

        $('.work').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/claimlocations/work/' + $(this).data('claimId') + '/' + $(this).data('id') + '/0';
        })
        $('.work-history').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/claimlocations/work/' + $(this).data('claimId') + '/' + $(this).data('id');
        })
        $('.scheduling').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/claims/scheduling/' + $(this).data('departmentId') + '/' + $(this).data('id');
        })

        $('.samples').click(function (e) {
            e.stopPropagation();
            window.location = '/admin/samples/edit/' + $(this).data('id');
        });

        $('.message').click(function (e) {
            e.stopPropagation();
            var locationId = 0;
            if ($(this).data('locationid') > 0) {
                locationId = $(this).data('locationid');
            }

            window.location = '/admin/messaging/claim/' + $(this).data('claimid') + '/' + locationId;
        });
    });
</script>

<input type="hidden" id="departmentId" value="STAFF_DEPARTMENT" />

<table class="table table-striped table-hover selectable-rows">
    <thead>
        <tr>
            <th>
                Claim ID
            </th>
            <th>
                Name
            </th>
            <th>
                Loss Type
            </th>
            <th>
                Loss Date
            </th>
            <th>ECD</th>
            <th>
                Status
            </th>
            <th>
                Project Manager
            </th>
            <th>
                Adjuster
            </th>
            <th>
                Property Manager
            </th>
            <th>
                Management Co
            </th>
            <th>
                Address
            </th>
            <th>
                Action
            </th>
        </tr>
    </thead>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>2014-10-05</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="btn btn-primary btn-xs view" data-id="1" title="click to view the details of this request">View</button>
            <button class="btn btn-primary btn-xs add-unit" data-id="0" >Add Unit</button>
            <button class="btn btn-primary btn-xs samples" data-id="0" >Samples</button>
            <button class="btn btn-primary btn-xs message" data-claimid="1" title="send a message">Messages</button>
            <button class="btn btn-primary btn-xs complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button>
            <button class="btn btn-primary btn-xs remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Adjuster</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tr class="success" data-claimid="1" data-id="123" data-type="unit">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>Personal Adjuster</td>
                    <td>2:30PM</td>
                    <td>complete</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td>
                        <button class="btn btn-primary btn-xs work" data-claimid="1" data-id="locationId">Add Work</button>
                        <button class="btn btn-primary btn-xs work-history" data-claimid="1" data-id="locationId">Work History</button>
                        <button class="btn btn-primary btn-xs message" data-claimid="1" data-locationid="2" title="send a message">Messages</button>
                    </td>
                </tr>
                <tr data-claimid="1"  data-id="124" data-type="unit">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>Personal Adjuster</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td><button class="btn btn-primary btn-xs work" data-id="locationId" >Work Performed</button></td>
                </tr>
                <tr data-claimid="1"  data-id="124" data-type="unit">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>Personal Adjuster</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td><button class="btn btn-primary btn-xs work" data-id="locationId" data-claimid="1" >Work Performed</button></td>
                </tr>
                <tr class="warning" data-claimid="1" data-id="124" data-type="unit">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>Personal Adjuster</td>
                    <td>2:00PM</td>
                    <td>on-hold</td>
                    <td></td>
                    <td><button class="btn btn-primary btn-xs work" data-id="locationId" data-claimid="1" >Work Performed</button></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>2014-10-01</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="btn btn-primary btn-xs view" data-id="1" title="click to view the details of this request">View</button>
            <button class="btn btn-primary btn-xs complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button>
            <button class="btn btn-primary btn-xs remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Adjuster</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th><button class="btn btn-primary btn-xs add-contact" data-id="" >Add Contact</button></th>
                    </tr>
                </thead>
                <tr data-type="unit" data-id="123">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>Personal Adjuster</td>
                    <td>2:30PM</td>
                    <td>in-progress</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td></td>
                </tr>
                <tr data-type="unit" data-id="124">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>Personal Adjuster</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>&nbsp;</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="view" data-id="1" title="click to view the details of this request">View</button> <button class="complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Adjuster</th>
                        <th>Time</th>

                        <th>Status</th>
                        <th>Notes</th>
                        <th><button class="add-contact" data-id="" >Add Contact</button></th>
                    </tr>
                </thead>
                <tr data-type="unit" data-id="123">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>Personal Adjuster</td>
                    <td>2:30PM</td>
                    <td>in-progress</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td></td>
                </tr>
                <tr data-type="unit" data-id="124">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>Personal Adjuster</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>2014-10-01</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="view" data-id="1" title="click to view the details of this request">View</button> <button class="complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th><button class="add-contact" data-id="" >Add Contact</button></th>
                    </tr>
                </thead>
                <tr data-type="unit" data-id="123">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>2:30PM</td>
                    <td>in-progress</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td></td>
                </tr>
                <tr data-type="unit" data-id="124">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>&nbsp;</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="view" data-id="1" title="click to view the details of this request">View</button> <button class="complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th><button class="add-contact" data-id="" >Add Contact</button></th>
                    </tr>
                </thead>
                <tr data-type="unit" data-id="123">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>2:30PM</td>
                    <td>in-progress</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td></td>
                </tr>
                <tr data-type="unit" data-id="124">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>

    <tr data-type="request">
        <td>
            <a href="/admin/claims/view/123">MV-14JS123</a>
        </td>
        <td>
            project name
        </td>
        <td>
            flooding
        </td>
        <td>
            2014-09-12
        </td>
        <td>&nbsp;</td>
        <td>
            In Progress
        </td>
        <td>
            Trevor Klann
        </td>
        <td>
            adjust name
        </td>
        <td>
            manager name
        </td>
        <td>
            mgmnt co
        </td>
        <td>
            1234 University Drive, Surrey, BC, V6Z 3B3
        </td>
        <td>
            <button class="view" data-id="1" title="click to view the details of this request">View</button> <button class="complete" data-id="1" title="this scope will display in completed scopes list">Set Complete</button> <button class="remove" data-id="1" title="this will completely remove the scope request from record">Delete</button>
        </td>
    </tr>
    <tr style="display:none;" id="row_<?php //echo $row['id'];        ?>">
        <td></td>
        <td colspan="11">
            <table class="table">
                <thead>
                    <tr>
                        <th>Unit</th>
                        <th>Name</th>
                        <th>Telephone</th>
                        <th>Area</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Notes</th>
                        <th><button class="add-contact" data-id="" >Add Contact</button></th>
                    </tr>
                </thead>
                <tr data-type="unit" data-id="123">
                    <td>302</td>
                    <td>Alicia Jones</td>
                    <td>604-123-1233</td>
                    <td>Kitchen, Living Room</td>
                    <td>2:30PM</td>
                    <td>in-progress</td>
                    <td>dishwasher leak - affecting 202. Need to also check unit 301 on adjoining wall</td>
                    <td></td>
                </tr>
                <tr data-type="unit" data-id="124">
                    <td>202</td>
                    <td>Alvin Smith</td>
                    <td>604-123-1233</td>
                    <td>Kitchen</td>
                    <td>2:00PM</td>
                    <td>in-progress</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>

</table>