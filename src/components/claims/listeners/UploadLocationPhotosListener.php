<?php

namespace components\claims\listeners;


use core\eventlisteners\AbstractListener;


/**
 * Description of UploadLocationPhotosListener
 *
 * @author davem
 */
class UploadLocationPhotosListener extends AbstractListener{
    
    public function on_request_start($params = array()) {
        
        $filenames = array();
        $requestParams = $this->httpRequest->getParameters();
        $locationId = $requestParams[0] . '/' . $requestParams[1];
        
        $filepath = __SITE_PATH . "/../locationImages/$locationId";
        $this->prepareDirectory($filepath);
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $filepath . "/" . $_FILES['file']['name'])) {
           $filenames[] = $filepath . "/" . $_FILES['file']['name'];           
        }
       
        $this->httpRequest->setAttribute('uploadedFiles', $filenames);
    }
   
    private function prepareDirectory($filepath) {
        
        if (!file_exists($filepath)) {
            if(!mkdir($filepath, 0777, true)) {
                die("failed to create " . $filepath);
            }
        } 
    }
}
