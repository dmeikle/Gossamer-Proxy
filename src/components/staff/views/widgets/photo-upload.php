<!--- javascript start --->

@components/staff/includes/js/dropzone.js
@components/staff/includes/js/form-file-upload.js

<!--- javascript end --->

<div class="col-md-6">
    <div class="block">
        <div class="block-heading">
            <div class="main-text h2">
                Staff Photo Upload
            </div>
            <div class="block-controls">
                <span aria-hidden="true" class="icon icon-cross icon-size-medium block-control-remove"></span>
                <span aria-hidden="true" class="icon icon-arrow-down icon-size-medium block-control-collapse"></span>
            </div>
        </div>
        <div class="block-content-outer">
            <div class="block-content-inner">
                <div class="row">
                    <div class="col-md-6">
                        <form action="/admin/staff/photo/upload/<?php echo $Staff_id;?>" class="dropzone dz-clickable" id="customized-dropzone">
                            <div class="dz-message">
                                <span class="icon icon-download-selection icon-size-large"></span>
                                <span class="main-text">Drop Your File Here</span>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-6">
                        <div id="customized-dropzone-results">
                            <h3>Upload Results</h3>
                            <p>The results of your uploads will be displayed here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>