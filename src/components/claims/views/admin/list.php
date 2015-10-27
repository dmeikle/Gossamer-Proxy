<!--- javascript start --->
<!--@components/claims/includes/js/jquery.ptTimeSelect.js-->

<!--- javascript end --->

<!--- css start --->
<!--@components/claims/includes/css/jquery.ptTimeSelect.css-->

<!--- css end --->

<script language="javascript">
    $(document).ready(function () {
        var featureOpen = false;


        $('.edit').click(function () {
            $('#left-feature-slider-edit1').toggle(true);
        });

        $('.claim-view').click(function () {

            if (featureOpen) {
                featureOpen = false;
                $('#left-feature-slider').toggle(false);
            } else {
                featureOpen = true;
                $('#left-feature-slider').toggle();
                $.get('/admin/claims/view/' + $(this).data('jobnumber'), function (data) {
                    //console.log(data);
                    populateSummary(data);
                });
            }
        });

        function populateSummary(data) {
            console.log(data);

            populateAddress(data.building);
            populateClaimLocation(data.locations);
            populateStatus(data.status);
        }

        function populateClaim(data) {

            $.each(data[0], function (key, value) {
                if (value != '') {
                    $('#claim-summary #' + key).html(value);
                }
            });
        }

        function populateStatus(data) {
            $.each(data[0], function (key, value) {
                if (value != '') {
                    $('#current-status #' + key).html(value);
                }
            });
        }
        function populateAddress(data) {

            $.each(data[0], function (key, value) {
                if (value != '') {
                    $('#project #' + key).html(value);
                }
            });
        }

        function populateClaimLocation(data) {
            $('#locations').empty();
            $.each(data, function (key, value) {
                if (value) {
                    jQuery('<div/>', {
                        class: 'location',
                        text: value.unitNumber
                    }).appendTo('#locations');

                }
            });
        }

        $('#summary-close').click(function () {
            $('#left-feature-slider').toggle('false');
        })


    });

</script>
<style>
    .slider-nav {
        float: left;
        margin-right: 5px;
    }
</style>
<a href="#" data-id="0" class="edit">create new claim</a>

<table class="table table-striped">
    <tr>
        <th>Claim ID</th>
        <th>Project Name</th>
        <th>Phase/Type/TI/Status</th>
        <th>Address</th>
        <th>Loss Date</th>
        <th></th>
    </tr>

    <?php
    foreach ($Claims as $claim) {
        if (count($claim) == 0) {
            continue;
        }
        ?>
        <tr>
            <td>
                <?php echo $claim['jobNumber']; ?>
            </td>
            <td>
                <?php echo $claim['strataNumber']; ?> <?php echo $claim['buildingName']; ?>
            </td>
            <td>
                <span class="fa fa-<?php echo $claim['icon']; ?>"></span> <?php echo $claim['parentClaims_id']; ?> <?php echo $claim['ClaimTypes_id']; ?>
            </td>
            <td>
                <?php echo $claim['address']; ?>
            </td>
            <td>
                <?php echo $claim['callInDate']; ?>
            </td>
            <td>
                <a href="#" class="claim-view" data-jobnumber="<?php echo $claim['jobNumber']; ?>" data-id="<?php echo $claim['Claims_id']; ?>"><span class="glyphicon glyphicon-chevron-right"></span></a>
            </td>
        </tr>

    <?php } ?>
</table>

<?php echo $pagination; ?>

