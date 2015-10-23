<!--- javascript start --->
@components/claims/includes/js/selectable-ui.js

<!--- javascript end --->


<form class="form-standard" role="form">
    <h2 class="form-signin-heading">new claim form - sub-trades called</h2>
    <table class="table"><tr>
            <td>Technicians Dispatched:</td>
            <td>
                <p class="selectable">
                    <label><input type="checkbox" name="variant[1][1]" value="1">Michael Jordan</label>
                    <label><input type="checkbox" name="variant[1][2]" value="1">Danny Rather</label>
                    <label><input type="checkbox" name="variant[1][3]" value="1">Mohammed Ali</label>
                    <label><input type="checkbox" name="variant[2][4]" value="1">David Beckham</label>
                    <label><input type="checkbox" name="variant[2][5]" value="1">Sergeant Dan</label>
                </p>
            </td>
        </tr>
        <tr>
            <td>Electrician:</td>
            <td>
                <select class="form-control" name="electrician">
                    <option>select one</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Plumber:</td>
            <td>
                <select class="form-control" name="plumber">
                    <option>select one</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Other:</td>
            <td><input type="text" class="form-control" name="subtrade_other" /></td>
        </tr>
    </table>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Next</button>
</form>