<!--- javascript start --->

@components/claims/includes/js/dropzone.js
@components/claims/includes/js/fileupload.js

<!--- javascript end --->

<div class="col-md-12">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Upload Images - <?php echo $claim['jobNumber']; ?>
            </div>
            <div class="block-controls">
                <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">
                <div class="row">
                    <div class="col-md-12">
                        <form action="/admin/claims/photos/upload/<?php echo $claim['jobNumber']; ?>" class="dropzone dz-clickable" id="customized-dropzone-2">
                            <div class="dz-message">
                                <span class="main-text">Drop Your File Here (or click)</span>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="customized-dropzone-results-2">
                            <h3>Upload Results</h3>
                            <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>File Name</th>
                                        <th>Size</th>
                                        <th>Progress</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="no-files">
                                        <td colspan="5">
                                            <p class="text-center">The results of your uploads will be displayed here.</p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>