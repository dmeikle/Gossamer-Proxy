<!--- javascript start --->
@components/scoping/includes/js/admin-scoping-add.js
<!--- javascript end --->

<style>
    .ui-helper-hidden-accessible { display:none; }
</style>




<h2 class="form-signin-heading">Scope Request</h2>
<form class="form-standard" role="form" method="post">

    <table class="table">
        <tr valign="top">
            <td width="18%">Job Number:</td>
            <td width="82%"><input type="text" name="ScopeRequest[jobNumber]" id="jobNumber"  class="form-control"/></td>
        </tr>
        <tr valign="top">
            <td>Notes:</td>
            <td><textarea class="form-control" name="ScopeRequest[notes]"></textarea></td>
        </tr>
        <tr valign="top">
            <td>Request Date:</td>
            <td><input type="text" name="ScopeRequest[requestDate]" id="requestDate"  class="form-control"/></td>
        </tr>

        <tr valign="top">
            <td>Scope Date:</td>
            <td><input type="text" name="ScopeRequest[scopeDate]" id="scopeDate"  class="form-control"/></td>
        </tr>
        <tr valign="top">
            <td>Source:</td>
            <td><input type="text" name="ScopeRequest[source]" id="source"  class="form-control"/></td>
        </tr>
        <tr valign="top">
            <td><button id='enterAddress'>Address:</button></td>
            <td>


                <input id="projectAddress_input" class="form-control" />

                <div id="projectAddress"></div>
                <input type="hidden" name="ScopeRequest[ProjectAddresses_id]" id="projectAddressId" />

            </td>
        </tr>
        <tr valign="top">
            <td>Assigned To:</td>
            <td>
                <select class="form-control" name="ScopeRequest[Staff_id]" id="select">
                </select></td>
        </tr>
        <tr valign="top">
            <td>&nbsp;</td>
            <td><button class="btn btn-primary" type="submit">Next</button> <button class="btn btn-primary" >Cancel</button></td>
        </tr>
    </table>

</form>
