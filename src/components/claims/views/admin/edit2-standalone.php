<form class="form-standard" role="form">
    <h2 class="form-signin-heading">new claim form - on-site contact</h2>
    <table class="table">
        <tr>
            <td>Contact Name:</td>
            <td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
        </tr>
        <tr>
            <td>Contact Phone:</td>
            <td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <td>Call Received From:</td>
            <td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
        </tr>
        <tr>
            <td>Caller Phone:</td>
            <td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
        </tr>
    </table>
    <h2 class="form-signin-heading">new claim form - type of claim</h2>
    <table class="table">
        <tr>
            <td>Water</td>
            <td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
        </tr>
        <tr>
            <td>Fire</td>
            <td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
        </tr>
        <tr>
            <td>Sewer Back-UP</td>
            <td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
        </tr>
        <tr>
            <td>Vehicle Impact</td>
            <td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
        </tr>
        <tr>
            <td>Contents</td>
            <td><input class="form-control" placeholder="Username" name="ClaimTypes_id" type="radio" value="1" /></td>
        </tr>
        <tr>
            <td>Other</td>
            <td><input class="form-control" placeholder="Username" name="dateReceived" type="text" /></td>
        </tr>
        <tr>
            <td>Asbestos Test Required:</td>
            <td><input placeholder="Username" name="ClaimTypes_id" type="radio" value="1" />
                Yes<br /><input placeholder="Username" name="ClaimTypes_id" type="radio" value="1" />
                No</td>
        </tr>

    </table>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Next</button>
    <input type="hidden" name="claim[id]" />
</form>