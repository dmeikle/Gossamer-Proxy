
<script language="javascript">
    $(function () {
        $("#tabs").tabs();
    });
</script>

<div style="width:1000px">

    <div id="tabs">
        <ul>
            <li><a href="#tabs-1">Removed Items</a></li>
            <li><a href="#tabs-2">Non-Restorables</a></li>
            <li><a href="#tabs-3">Processed Items</a></li>
            <li><a href="#tabs-4">Vaulted Items</a></li>
        </ul>
        <div id="tabs-1">
            <p>
            <table class="table">
                <thead>
                    <tr>
                        <th>Tag #</th>
                        <th>Type</th>
                        <th>Room</th>
                        <th>Outcome</th>
                        <th>Status</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tr class="success">
                    <td>
                        123
                    </td>
                    <td>
                        Couch
                    </td>
                    <td>
                        102
                    </td>
                    <td>
                        processed
                    </td>
                    <td>
                        vaulted
                    </td>
                    <td>
                        No issues found
                    </td>
                </tr>
                <tr class="success">
                    <td>
                        124
                    </td>
                    <td>
                        mattress
                    </td>
                    <td>
                        103
                    </td>
                    <td>
                        processed
                    </td>
                    <td>
                        vaulted
                    </td>
                    <td>
                        No issues found
                    </td>
                </tr>
                <tr>
                    <td>
                        125
                    </td>
                    <td>
                        12" x 18" box
                    </td>
                    <td>
                        102
                    </td>
                    <td>
                        waiting cleaning
                    </td>
                    <td>
                        un-processed
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td>
                        126
                    </td>
                    <td>
                        Clear Plastic Bag
                    </td>
                    <td>
                        102
                    </td>
                    <td>
                        waiting laundry
                    </td>
                    <td>
                        un-processed
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
            </p>
        </div>
        <div id="tabs-2">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tag #</th>
                        <th>Item</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tr>
                    <td>123</td>
                    <td>computer</td>
                    <td>serial: asd3123, model: toshiba satellite C50</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>computer mouse</td>
                    <td>blue tooth</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>keyboard</td>
                    <td>black microsoft</td>
                </tr>
                <tr>
                    <td>124</td>
                    <td>book</td>
                    <td>PHP for Dummies</td>
                </tr>
                <tr>
                    <td>124</td>
                    <td>book</td>
                    <td>MYSQL tips</td>
                </tr>
            </table>

        </div>
        <div id="tabs-3">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Original Tag #</th>
                        <th>Item</th>
                        <th>Current Tag #</th>
                    </tr>
                </thead>
                <tr>
                    <td>123</td>
                    <td>computer</td>
                    <td>123 & 102</td>
                </tr>
                <tr>
                    <td>123</td>
                    <td>monitor</td>
                    <td>123 & 102</td>
                </tr>
                <tr>
                    <td>102</td>
                    <td>book</td>
                    <td>123 & 102</td>
                </tr>
            </table>
        </div>
        <div id="tabs-4">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tag #</th>
                        <th>Package Type</th>
                        <th>Location</th>
                        <th># Days</th>
                    </tr>
                </thead>
                <tr>
                    <td>123</td>
                    <td>18" x 24"</td>
                    <td>Bin 2</td>
                    <td>24</td>
                </tr>
                <tr>
                    <td>124</td>
                    <td>mattress</td>
                    <td>Shelf 25a</td>
                    <td>24</td>
                </tr>
                <tr>
                    <td>102</td>
                    <td>18" x 24"</td>
                    <td>Bin 2</td>
                    <td>24</td>
                </tr>
            </table>
        </div>
    </div>
</div>