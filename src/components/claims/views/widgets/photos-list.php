<!--- javascript start --->

@components/claims/includes/js/admin-claims-list-ng.js

<!--- javascript end --->

<style>
    .photo {
        margin-top: 20px;
    }
    .photo img{
        max-height: 250px;
    }
</style>

<div class="col-md-12">
    <!-- START Block: Start Here -->
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Claim Photos
            </div>
            <div class="block-controls">
                <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div id="photo-list"></div>
            <div class="block-content-inner" ng-controller="ClaimPhotosController as cpCtrl" >
                <?php //foreach($photos as $photo) {?>

                <div class="photo col-md-2" ng-repeat="photo in cpCtrl.items">

                    <img src="/images/claims/<?php echo $claim['jobNumber']; ?>/{{photo.photo}}" />
                    <div class="description">
                        {{photo.description}}
                    </div>

                </div>
                <?php //} ?>
                <div style="clear: both; overflow: hidden"></div>
            </div>
        </div>
    </div>
    <!-- END Block -->
</div>

<script language="javascript">

            $(document).ready(function() {
    // $("#photo-list").append('<img src="/image.php?imagepath=claims/MV15-EMERG101/2.jpg" alt="" />');
    })();

</script>