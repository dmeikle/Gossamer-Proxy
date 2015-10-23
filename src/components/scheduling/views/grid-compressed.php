<!--- javascript start --->
@components/claims/includes/js/selectable-ui.js

<!--- javascript end --->

<script language="javascript">


    $(document).ready(function e() {

        $('.add-job').click(function (e) {
            $('.exampleoverlay').toggle();
            $('.examplemodal').toggle();
        });

        $('.cancel').click(function (e) {
            $('.exampleoverlay').toggle();
            $('.examplemodal').toggle();
        });

        $('.selectable input:checkbox:checked').each(function () {

            $("label[for='" + this.id + "']").addClass('ui-selected');
        });

        $('.selectable').on('mouseup', 'label', function () {
            var el = $(this);
            console.info(el);
            if (el.hasClass('ui-selected')) {
                el.removeClass('ui-selected');
            } else {
                el.addClass('ui-selected');
            }
        });

        $('#save-job').click(function (e) {
            alert('this will save and close');
            $('.add-job').click();

        })
        $('#date').datepicker();

    });


</script>

<style>
    #inputForm {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;

        z-index: 10;
        text-align: center;
        padding: 200px 0px 0px 100px;
    }


    .exampleoverlay {
        display: none;
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        /* background-color: rgba(0,0,0,0.5);*/
        z-index: 10;
    }

    .examplemodal {
        display: none;
        padding: 10px;
        width: 480px;
        height: 560px;
        line-height: 200px;
        position: fixed;
        top: 30%;
        left: 50%;
        margin-top: -100px;
        margin-left: -150px;
        background-color: #fafafa;
        border-radius: 5px;
        text-align: center;
        z-index: 11; /* 1px higher than the overlay layer */
        border: solid 1px #101010;
    }

</style>

<br />
<div class="exampleoverlay" id="inputForm"></div>
<div class="examplemodal">
    <table>
        <tr>
            <td width="90"> </td>
            <td align="right"> &nbsp;<a href="#" class="cancel">x</a></td>
        </tr>
        <tr>
            <td>Job Number</td>
            <td>
                <input type="text" class="form-control" name="textfield" id="textfield"></td>
        </tr>
        <tr>
            <td>Date</td>
            <td>
                <input type="text" class="form-control" name="textfield" id="date">
            </td>
        </tr>
        <tr>
            <td>Phase</td>
            <td>
                <select class="form-control" name="worktype">
                    <option value="1">Emergency</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Work Type</td>
            <td>
                <select class="form-control" name="worktype">
                    <option value="1">Listing Non-Restrictions</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Units</td>
            <td>
                <select class="form-control" name="units" multiple="">
                    <option value="1">302</option>
                    <option value="1">301</option>
                    <option value="1">402</option>
                    <option value="1">401</option>
                    <option value="1">502</option>
                    <option value="1">601</option>
                    <option value="1">602</option>
                    <option value="1">701</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Employees</td>
            <td>


                <table width="100%">
                    <tr>
                        <td width="50%"><p class="selectable">
                                <label><input type="checkbox" name="variant[1][1]" value="1">Michael Jordan</label>
                                <label><input type="checkbox" name="variant[1][2]" value="1">Danny Rather</label>
                                <label><input type="checkbox" name="variant[1][3]" value="1">Mohammed Ali</label>
                                <label><input type="checkbox" name="variant[2][4]" value="1">David Beckham</label>
                                <label><input type="checkbox" name="variant[2][5]" value="1">Sergeant Dan</label>            </p>

                        </td>
                        <td><p class="selectable">
                                <label><input type="checkbox" name="variant[1][1]" value="1">Michael Jordan</label>
                                <label><input type="checkbox" name="variant[1][2]" value="1">Danny Rather</label>
                                <label><input type="checkbox" name="variant[1][3]" value="1">Mohammed Ali</label>
                                <label><input type="checkbox" name="variant[2][4]" value="1">David Beckham</label>
                                <label><input type="checkbox" name="variant[2][5]" value="1">Sergeant Dan</label>            </p>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>Notes</td>
            <td>
                <textarea name="textarea" class="form-control" id="textarea" cols="45" rows="5"></textarea></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><button class="btn btn-primary" id="save-job">Add</button>
                <button class="btn btn-primary cancel">Cancel</button> </td>
        </tr>
    </table>
</div>


<table class="table table-striped">
    <thead>
        <tr>
            <th width="100">Job Number</th>
            <th width="100">Phase</th>
            <th width="100">Work Type</th>
            <th width="100">Units</th>
            <th width="300">Employees On Site</th>
            <th width="50%">Notes</th>
            <th>Action</th>
        </tr>
    </thead>
    <tr class="success">
        <td colspan="6" align="center">
            <b>Wed Sept 18</b>
        </td>
        <td>
            <button  class="btn btn-sm btn-primary add-job">Add Job</button>
        </td>
    </tr>
    <tr>
        <td width="146">MV13 JY    130</td>
        <td>VP</td>
        <td>RE/FC</td>
        <td>301, 302, 201</td>
        <td>Nancy, Sandra, (Laura LU)</td>
        <td>remove carpet and bring to ozone room</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>EM</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>&nbsp;</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>&nbsp;</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
    <tr class="success">
        <td colspan="7" align="center">
            <b>Thur Sept 19</b>
        </td>
    </tr>
    <tr>
        <td width="146">MV13 JY    130</td>
        <td>&nbsp;</td>
        <td>RE/FC</td>
        <td>301, 302, 201</td>
        <td>Nancy, Sandra, (Laura LU)</td>
        <td>remove carpet and bring to ozone room</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>&nbsp;</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>&nbsp;</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td width="146">MV13 JY 132</td>
        <td>&nbsp;</td>
        <td>CO/CM</td>
        <td>304</td>
        <td>Barb, Mike</td>
        <td>CP - 1ST Job</td>
        <td>&nbsp;</td>
    </tr>
</table>
