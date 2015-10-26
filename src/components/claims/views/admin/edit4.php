<!--- javascript start --->
@components/claims/includes/js/selectable-ui.js

<!--- javascript end --->


<script language="javascript">

    $(document).ready(function () {

        $('#previous-4').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit3').toggle(true);
            $('#left-feature-slider-edit4').toggle(false);

        });

        $('#next-4').click(function () {
            //first, you need to save the data and get anew id number

            $('#left-feature-slider-edit4').toggle(false);
            alert('do a save here');
        });

        $('#cancel-4').click(function () {
            $('#left-feature-slider-edit4').toggle(false);
        });
    });

</script>

<div class="panel panel-default">
    <div class="panel-heading">
        New Claim Form - Technicians Dispatched
    </div>
    <form class="form-standard" role="form">


        <div class="slider-nav" id="previous-4"><span class="fa fa-arrow-circle-o-left"></span></div>
        <div class="slider-nav cancel-slider" id="cancel-4"><span class="fa fa-times-circle-o"></span></div>
        <div class="slider-nav" id="next-4"><span class="fa fa-arrow-circle-o-right"></span></div>
    </form>
</div>