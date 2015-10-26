
<script language="javascript">

    $(document).ready(function () {

        $('#previous-3').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit2').toggle(true);
            $('#left-feature-slider-edit3').toggle(false);

        });

        $('#next-3').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit3').toggle(false);
            $('#left-feature-slider-edit4').toggle(true);

        });

        $('#cancel-3').click(function () {
            $('#left-feature-slider-edit3').toggle(false);
        });
    });

</script>

<style>
    .button {
        width: 30%;
        float: left;
    }
    #asbestos-test {
        clear: both;
    }
    .button input[type="radio"] {
        display: none;
    }

    input[type="radio"]:checked + label {
        border: 1px solid grey;
    }
</style>
<div class="panel panel-default">
    <div class="panel-heading">
        New Claim - Claim Type
    </div>
    <div id="claim-type">
        <?php foreach ($ClaimTypes as $type) { ?>

            <div class="button">

                <input type="radio" name="ClaimTypes_id" value="<?php echo $type['id']; ?>" id="<?php echo $type['icon']; ?>" />
                <label for="<?php echo $type['icon']; ?>"><div class="type <?php echo $type['icon']; ?>"><img src="//images.phoenixrestorations.com/nav-icons/<?php echo $type['icon']; ?>.png" /></div></label>
            </div>




        <?php } ?>
    </div>
    <div id="asbestos-test">Asbestos Test Required: yes no</div>
    <div class="slider-nav" id="previous-3"><span class="fa fa-arrow-circle-o-left"></span></div> <div class="slider-nav cancel-slider" id="cancel-3"><span class="fa fa-times-circle-o"></span></div> <div class="slider-nav" id="next-3"><span class="fa fa-arrow-circle-o-right"></span></div>
</div>