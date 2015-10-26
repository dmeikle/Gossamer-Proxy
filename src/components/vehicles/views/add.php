

<h2 class="form-signin-heading">Add/Edit Subcontractor</h2>
<form class="form-standard" role="form" method="post">
    <table class="table">
        <tr>
            <td>Name</td>
            <td><input type="text" class="form-control" name="Company[name]" id="company_id" /></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="text" class="form-control" name="Company[email]" id="company_email" /></td>
        </tr>
        <tr>
            <td>URL</td>
            <td><input type="text" class="form-control" name="Company[url]" id="company_url" /></td>
        </tr>
        <tr>
            <td>Telephone</td>
            <td><input type="text" class="form-control" name="Company[telephone]" id="company_telephone" /></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><input type="text" class="form-control" name="Company[address1]" id="company_address1" /><br />
                <input type="text" class="form-control" name="Company[address2]" id="company_address2" />
            </td>
        </tr>
        <tr>
            <td>City</td>
            <td><input type="text" class="form-control" name="Company[city]" id="company_city" />
            </td>
        </tr>
        <tr>
            <td>Postal Code</td>
            <td><input type="text" class="form-control" name="Company[postalCode]" id="company_postalCode" />
            </td>
        </tr>
        <tr>
            <td>Notes</td>
            <td><input type="text" class="form-control" name="Company[notes]" id="company_notes" />
            </td>
        </tr>
        <tr>
            <td>Type</td>
            <td><input type="text" class="form-control" name="Company[city]" id="company_city" />
            </td>
        </tr>
        <tr>
            <td>Rating</td>
            <td><button class="addRating">Add Rating</button>
            </td>
        </tr>
        <tr>
            <td>Is Preferred</td>
            <td><input type="checkbox" name="Company[isPreferred]" id="company_ispreferred" />
            </td>
        </tr>
    </table>
</form>