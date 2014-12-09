<?php
namespace components\fileuploads\listeners;

use core\eventlisteners\AbstractListener;

class UploadFilesListener extends AbstractListener
{
 
    public function on_request_start($params = array()) {
        $filenames = array();
       
        if(move_uploaded_file($_FILES['file']['tmp_name'], __SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . "/uploads/".$_FILES['file']['name'])) {
            $filenames[] = __SITE_PATH . '/src/components/' . __COMPONENT_FOLDER . "/uploads/".$_FILES['file']['name'];           
        }
       
        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }


}
